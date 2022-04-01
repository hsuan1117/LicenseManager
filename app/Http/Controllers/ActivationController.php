<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\Token;
use Illuminate\Http\Request;

class ActivationController extends Controller {
    public function activate(Request $request) {
        $token = Token::where('content', $request->input('token'))->firstOrFail();
        $currentActivation = $token->activations()
            ->where('activated_ip', $request->ip())
            ->where('activated_uname', $request->input('activated_uname'))
            ->where('activated_cpu', $request->input('activated_cpu'))
            ->first();

        if (is_null($currentActivation)) {
            if (
                $token->activations()->count()
                >=
                $token->activated_limit
            ) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'token usage exceeded limit'
                ], 403);
            } else {
                $token->activations()->create(array_merge($request->except(['token']), [
                    'activated_ip' => $request->ip()
                ]));
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => ''
        ]);

    }

    public function code(Request $request) {
        $req_token = $request->input('token');
        $token = Token::where('content', $req_token)->first();

        if (is_null($token)) {
            \Log::debug("[TokenNotFound] {$req_token}");
            return response()->json([
                'status' => 'fail',
                'message' => 'cannot find token using provided data'
            ], 404);
        } else if (is_null($token->activations()
            ->where('activated_ip', $request->ip())
            ->where('activated_uname', $request->input('activated_uname'))
            ->where('activated_cpu', $request->input('activated_cpu'))
            ->first()
        )) {
            return response()->json([
                'status' => 'fail',
                'message' => 'the device is not registered'
            ], 403);
        } else {
            $title = $request->input('title');
            $code = $token->project->codes()->where('title', $title)->first;

            if (is_null($code)) {
                \Log::debug("[CodeNotFound] {$title}");
                return response()->json([
                    'status' => 'fail',
                    'message' => 'cannot find code using provided title'
                ], 404);
            } else {
                return $code;
            }
        }
    }
}

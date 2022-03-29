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
        $token = Token::where('content', $request->input('token'))->firstOrFail();

        if (is_null($token->activations()
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
            // TODO: 可以
            return $token->project->codes()->where('title', $request->input('title'))->firstOrFail();
        }
    }
}

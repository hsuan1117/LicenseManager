<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\Token;
use Illuminate\Http\Request;

class ActivationController extends Controller {
    public function activate(Request $request) {
        $request->input('uname');
        $token = $request->input('token');

        if (is_null(Activation::where('token', $token)
            ->where('activated_ip', $request->ip())
            ->where('activated_uname', $request->input('activated_uname'))
            ->where('activated_cpu', $request->input('activated_cpu'))
            ->first()
        )) {

            if (
                Activation::where('token', $token)->count()
                >
                Token::where('content', $token)->first()->activated_limit
            ) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'token usage exceeded limit'
                ], 403);
            }

            Activation::create(array_merge($request->all(), [
                'activated_ip' => $request->ip()
            ]));
        }

        return response()->json([
            'status' => 'success',
            'message' => ''
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\Token;
use Illuminate\Http\Request;

class ActivationController extends Controller {
    public function activate(Request $request) {
        $request->input('uname');
        $token = $request->input('token');

        if (
            Activation::where('token', $token)->count()
            >=
            Token::where('content', $token)->first()->activated_limit
        ) {
            return response()->json([
                'status' => 'fail',
                'message' => 'token usage exceeded limit'
            ], 403);
        }

        Activation::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => ''
        ]);

    }
}

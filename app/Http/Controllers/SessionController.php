<?php

namespace App\Http\Controllers;

use App\Dto\LoginRequest;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function login(LoginRequest $body)
    {
        $success =  Auth::attempt(
            $body->only('username', 'password')->toArray(),
            $body->remember
        );
        if (!$success) {
            return to_route('login')->withErrors([
                'general' => 'Wrong username or password'
            ]);
        }
        return redirect('/');
    }
}

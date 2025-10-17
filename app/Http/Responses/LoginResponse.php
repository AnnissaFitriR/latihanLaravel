<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponses as LoginResponseContract;

 class LoginResponse implements LoginResponseContract
 {
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('ekyc.step1');
    }
 }
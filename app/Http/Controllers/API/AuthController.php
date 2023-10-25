<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        $user = User::where($field, $request->email_or_phone)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email_or_phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('login-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function user(): array
    {
        $user = Auth::user();
        return ["user" =>  $user];
    }
}

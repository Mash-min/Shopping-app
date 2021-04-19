<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    public function create(UserCreateValidation $request) 
    {
        $user = User::create($request->except('password') + [
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'));
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user()->update($request->all());
        return response()->json($user);
    }

    public function checkPassword(Request $request)
    {
        if (Hash::check($request->password, auth()->user()->password)) {
            return response()->json($request->all());
        } else {
            abort(403);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);
    }

}

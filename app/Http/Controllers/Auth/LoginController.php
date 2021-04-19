<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return response()->json(['message' => 'Invalid Login Credentials'],403);
        }
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('index');
    }

}

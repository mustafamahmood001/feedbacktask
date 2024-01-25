<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->role === 'admin') {
            return redirect()->route('home'); // Change 'home' to your admin dashboard route
        } elseif ($user->role === 'user') {
            return redirect('/');
        }

        return redirect($this->redirectTo);
    }
}

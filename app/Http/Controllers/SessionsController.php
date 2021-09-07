<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        session()->flash('success', '欢迎回来！');
        $fallback = route('users.show', Auth::user());
        return redirect()->intended($fallback);
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }

    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
}

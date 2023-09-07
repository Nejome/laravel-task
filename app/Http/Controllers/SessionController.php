<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    public function store(SessionRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return redirect()->back()->with('danger', 'يرجى التحقق من بيانات تسجيل الدخول الخاصة بك');
        }

        session()->regenerate();

        return redirect()->route('applications.pending');
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('sessions.create');
    }
}

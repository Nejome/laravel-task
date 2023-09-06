<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }
}

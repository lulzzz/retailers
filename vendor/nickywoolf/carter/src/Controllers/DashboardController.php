<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['carter.login', 'carter.paying']);
    }

    public function index()
    {
        return view('carter::app.dashboard', ['user' => auth()->user()]);
    }
}

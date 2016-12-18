<?php

namespace NickyWoolf\Carter\Laravel\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware(['carter.auth', 'carter.paying']);
    }

    public function index()
    {
        return view('carter::app.dashboard', ['user' => $this->auth->user()]);
    }
}
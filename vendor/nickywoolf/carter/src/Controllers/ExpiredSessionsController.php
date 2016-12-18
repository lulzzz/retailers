<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Routing\Controller;

class ExpiredSessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('carter.guest');
    }

    public function index()
    {
        return view('carter::app.expired_session');
    }
}
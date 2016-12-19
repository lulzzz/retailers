<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthorizedUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['carter.guest', 'carter.shopify_domain', 'carter.signed']);
    }

    public function create(Request $request)
    {

        $user = app('carter.user')->forShop($request->shop);        

        auth()->login($user);

        return redirect()->route('carter.dashboard');
    }
}

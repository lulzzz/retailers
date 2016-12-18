<?php

namespace NickyWoolf\Carter\Laravel\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use NickyWoolf\Carter\Shopify\Api\RecurringApplicationCharge;
use NickyWoolf\Carter\Shopify\Client;

class RecurringChargeController extends Controller
{
    protected $request;

    protected $auth;

    public function __construct(Request $request, Guard $auth)
    {
        $this->request = $request;
        $this->auth = $auth;

        $this->middleware('carter.auth');

        $this->middleware(['carter.charged'])->only('update');
    }

    public function index()
    {
        return view('carter::app.plans', ['plans' => config('carter.shopify.plans')]);
    }

    public function create(RecurringApplicationCharge $charge)
    {
        $plan = $charge->create(config('carter.shopify.plans.'.$this->request->get('plan')));

        return view('carter::redirect_escape_iframe', ['redirect' => $plan['confirmation_url']]);
    }

    public function update(RecurringApplicationCharge $charge)
    {
        $id = $this->request->charge_id;

        if ($charge->isAccepted($id)) {
            $charge->activate($id);
            $this->auth->user()->update(['charge_id' => $id]);
        }

        return redirect()->route('carter.dashboard');
    }
}
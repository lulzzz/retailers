<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use NickyWoolf\Carter\ShopifyResourceFactory;

class RecurringChargesController extends Controller
{
    protected $request;

    protected $resourceFactory;

    public function __construct(ShopifyResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
        $this->middleware('carter.login');
        $this->middleware(['carter.charged'])->only('update');
    }

    public function index()
    {
        return view('carter::app.plans', ['plans' => config('carter.shopify.plans')]);
    }

    public function create(Request $request)
    {
        $plan = config("carter.shopify.plans.{$request->plan}");
        $charge = $this->charge()->create($plan);

        return view('carter::redirect_escape_iframe', ['redirect' => $charge['confirmation_url']]);
    }

    public function update(Request $request)
    {
        $id = $request->charge_id;

        $charge = $this->charge();
        if ($charge->isAccepted($id)) {
            $charge->activate($id);
            auth()->user()->update(['charge_id' => $id]);
        }

        return redirect()->route('carter.dashboard');
    }

    protected function charge()
    {
        return $this->resourceFactory->setUser(auth()->user())->resource('RecurringApplicationCharge');
    }
}

<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use NickyWoolf\Carter\ShopifyResourceFactory;

class InstalledAppController extends Controller
{
    use ValidatesRequests;

    protected $resourceFactory;

    protected $rules = [
        'shop' => 'required|unique:users,domain|max:255',
    ];

    protected $messages = [
        'shop.unique' => 'Store has already been registered',
    ];

    public function __construct(ShopifyResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
        $this->middleware('carter.guest');
        $this->middleware('carter.shopify_domain')->only('create');
    }

    public function index()
    {
        return view('carter::auth.signup', ['plans' => config('carter.shopify.plans')]);
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $this->resourceFactory->setDomain($request->get('shop'));

        session(['plan' => $request->get('plan')]);

        return redirect($this->resourceFactory->oauth()->authorize(
            config('carter.shopify.client_id'),
            config('carter.shopify.scope'),
            route('carter.register'),
            $this->state()
        ));
    }

    protected function state()
    {
        session(['state' => Str::random(40)]);

        return session('state');
    }
}

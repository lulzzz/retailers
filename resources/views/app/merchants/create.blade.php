@extends('layouts.iframe')

@section('content')
<div class="container-fluid p-a-2"> 
  <div class="row">

    @foreach($merchant as $value)
    @foreach($value->merchants as $merchant)
    <div class="col-xs">
      <div class="card p-a-0">
        <div class="p-x-2 p-t-2">
          <img class="card-img-top img-fluid" src="/images/{{ucfirst(trans($merchant))}}-icon.png" alt="Card image cap" style="width: 100%; opacity: 0.2; margin:0 auto;">
        </div>
        <div class="card-block">
        <a class="btn btn-block btn-secondary" target="_parent" href="https://{{ Auth::user()->domain}}/admin/apps/{{ env('SHOPIFY_KEY')}}/retailers/create?type={{$merchant}}">{{ucfirst(trans($merchant))}}</a>
        </div>
      </div>
    </div>
    @endforeach
    @endforeach  
  </div>
</div>
@stop
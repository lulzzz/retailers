@extends('site.layout.skeleton')

@section('header')
   <div class="row">
      <div class="col-xs-12 px-sm-0 text-xs-right">
         <div class="pt-2 pr-2">
            <a href="{{env('APP_URL')}}/">
               <svg id="i-close" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8.25%">
                  <path d="M2 30 L30 2 M30 30 L2 2" />
               </svg>
            </a>
         </a>
      </div>
   </div>
@stop

@section('content')
   <div class="page-signup">
   <div class="vertical-align">

      <div class="signup-form">
         <i class="icon icon-shopify"></i>

         @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
               <div class="notification is-danger">
                  <p class="title">
                     Oh, No!
                  </p>
                  <p class="subtitle">
                     {{ $error }}
                  </p>
               </div>
            @endforeach
         @endif

         <form action="{{ route('carter.install') }}" method="post">
            {{ csrf_field() }}
            @if ($plans)
               <p class="mt-3">
                     <select name="plan">
                        @foreach ($plans as $key => $plan)
                           <option value="{{ $key }}">{{ trim(sprintf('%s: $%.02f %s', $plan['name'], $plan['price'], $plan['test'] ? '(TEST)' : '')) }}</option>
                        @endforeach
                     </select>
               </p>
            @endif
               <input type="text" class="input-signup" name="shop" placeholder="*.myshopify.com"/>

            <p class="pt-2 text-xs-right">
               <button class="btn btn-base">Install Application </button>
            </p>

         </form>
      </div>
   </div>
</div>
@stop

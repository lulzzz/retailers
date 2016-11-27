@extends('site.layout.skeleton')

@section('header')
   <div class="row">
      <div class="col-xs-12 px-sm-0">
         <button type="button" class="drawer-hamburger js-drawer-open-left" aria-controls="LeftDrawer" aria-expanded="false"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
         </button>
      </div>
   </div>
@stop

@section('content')
   <div class="page-index">
      <div class="vertical-align">
         <div class="logo">
            <h1 class="pb-0"><a href="#" class="mb-0">RETAILERS</a></h1>
            <div class="sub-header">
               An integrated Shopify application that enables users to create, manage and showcase the brick and mortor retail locations selling their products.
            </div>
            <div class="mt-3">
               <a href="/shopify/signup" class="btn btn-base mr-1">
                  Install Application
               </a>
               <a href="/shopify/signup" class="btn btn-base mr-1">
                  Shopify App Store
               </a>
               <a href="/shopify/signup" class="btn btn-base">
                  Documentation
               </a>
            </div>
         </div>
      </div>
   @stop

@extends('proxy.layout.skeleton')

@section('content')

  @if (is_null($geo['country']))

    <h1>Listing All Retailers</h1>

    @foreach ($retailers as $key => $value)
      //
    @endforeach

  @else
    @include('proxy.components.fullscreen')
  @endif

@stop

@section('js')
  @include('proxy.skriptz.index')
@stop

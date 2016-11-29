@extends('app.layout.skeleton')

@section('content')
<div class="container bg-transparent">

  @if ($errors->any())

  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-danger" role="alert">
        <strong>Submission Error!</strong>
        <ul class="pt-2">
          <li class="error">
            {{ implode('', $errors->all(':message')) }}
          </li>
        </ul>
      </div>
    </div>
  </div>

  @endif
<h1>Settings / todo</h1>
@stop


@section('js')

@stop

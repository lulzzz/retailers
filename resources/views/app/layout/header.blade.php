@if(Request::is('retailers'))
  @include('app.layout.menu')
@elseif(Request::is('templates'))
  @include('app.layout.menu')
@endif

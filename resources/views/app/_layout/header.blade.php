@if(Request::is('retailers'))
  @include('layouts._navs.main-nav')
@elseif(Request::is('templates'))
  @include('layouts._navs.main-nav')
@elseif(Request::is('dashboard/*'))
  @include('layouts._navs.main-nav')
@endif
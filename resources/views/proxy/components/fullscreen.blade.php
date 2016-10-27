<div class="retailers-container">
  <div class="row">
    <div class="col-xs-4 p-0">
      <div id="retailers-list" class="retailers-search">
        @if(Route::current()->getName() == 'proxy_index')
        <div class="no-retailers">
          We couldn't find any Retailers in your country!
        </div>
        @endif
        <div class="retailers-locator">
          <input type="search" name="search" class="search search--map" placeholder="Enter your City, State or Country">
        </div>
        @include('proxy.components._fullscreen.filter-locations')
        @include('proxy.components._fullscreen.retailers-list')
      </div>
    </div>
    <div class="col-xs-8 p-0">
      <div class="map" id="map-container" data-map></div>
    </div>
  </div>
</div>
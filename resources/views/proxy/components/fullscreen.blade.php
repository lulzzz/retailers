@if($error)
   <div class="alert">
      <h3>No Retailers in your loction!</h3>
   </div>
@endif

<div class="retailers-container">
  <div class="row">
    <div class="col-xs-4 p-0">
      <div id="retailers-list" class="retailers-search">
        <div class="retailers-locator">
          <input type="search" name="search" class="search search--map" placeholder="Enter your City, State or Country">
        </div>
        @include('proxy.components._fullscreen.filter-locations')
        @include('proxy.components._fullscreen.retailers-list')
      </div>
    </div>
    <div class="col-xs-8 p-0">
      <div id="locating">
            <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
      </div>
      <div class="map" id="map-container" data-map></div>
    </div>
  </div>
</div>

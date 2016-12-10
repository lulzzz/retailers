<div class="retailers-container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 pr-0">
      <div id="retailers-list" class="retailers--search">
        <div class="retailers-locator">
          <input type="search" name="search" class="search search--map" placeholder="Enter your City, State or Country">
        </div>
        @include('proxy.components._fullscreen.retailers-list')
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 pl-0">
      <div id="locating">
        <div class="spinner">
          <div class="double-bounce1"></div>
          <div class="double-bounce2"></div>
        </div>
      </div>
      <div class="map" id="locate-retailer-map" data-map></div>
    </div>
  </div>
</div>

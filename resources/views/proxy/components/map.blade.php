<div class="retailers-container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-left">
      <div id="retailers-list" class="retailers--search">
        <div class="retailers-locator">
          <div class="input-group">
            <input type="text" class="search form-control" placeholder="Locations">
            <span class="input-group-btn">
              <button data-locator="button" class="btn-locator" type="button" data-balloon-visible data-balloon="Geolocate" data-balloon-pos="left">
                <i data-locator="icon"  class="re-icon re-icon-locator"></i>
              </button>
            </span>
          </div>
        </div>
        <div class="alert" data-map="alert">
          <div>Retailers Found within <b>50km</b> of your location!</div>
        </div>
        @include('proxy.components._fullscreen.retailers-list')
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 p-right">
      <div id="locating">
        <div class="spinner">
          <div class="double-bounce1"></div>
          <div class="double-bounce2"></div>
        </div>
      </div>
      <div class="map" id="locate-retailer-map" data-map="map"></div>
    </div>
  </div>
</div>

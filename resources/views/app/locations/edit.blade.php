@extends('app.layout.iframe')

@section('content')
<div class="container-fluid">
  @include('app.locations._partials.upload-storefront')
</div>
@stop


@section('js')
<script>
 loadjs(["{{env('APP_URL')}}/assets/app/js/plugins/dropzone.min.js"],
  { success: function() {
    $(skriptz.init);
  }
});

 window.skriptz = window.skriptz || {};

 skriptz.cacheSelectors = function () {
  skriptz.cache = {
    $storefront_container   :   $('#storefront_container')
  };
};

skriptz.init = function () {
  skriptz.cacheSelectors();
  skriptz.dropzone();
  skriptz.storefront();
  skriptz.storefrontDelete();
};


skriptz.dropzone = function () {
  Dropzone.options.storefrontDropzone = false;
};

skriptz.storefront = function () {
  var storefrontDropzone = new Dropzone('#storefront_upload', {
    url: "{{env('APP_URL')}}/upload/image/{{$id}}",
    paramName: "storefront",
    thumbnailWidth: 600,
    complete: function () {
      skriptz.cache.$storefront_container.load('{{env('APP_URL')}}/locations/{{$location->id}}/edit #storefront_container  > *');
    }
  });
  return storefrontDropzone;
};

skriptz.storefrontDelete = function () {
  $('.storefront_delete').on('ajax:success', function(event, xhr, status, error) {
    skriptz.cache.$storefront_container.load('{{env('APP_URL')}}/locations/{{$location->id}}/edit #storefront_container > *');
    ShopifyApp.flashError("Deleted!");
  });
};


$(document).ajaxComplete(function() {
  skriptz.storefront();
  skriptz.storefrontDelete();
});
</script>
@stop

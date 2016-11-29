@extends('app.layout.skeleton')

@section('content')

  <div class="container b-0">
    <div class="card-box pb-0 mb-0">
      <div class="row">
        <div class="col-md-12 p-b-0">
          <div class="iframe-wrapper">
            <div class="macbook">
              <iframe class="iframe" id="live_iframe_preview" src="https://{{Auth::user()->domain}}/a/retailers" scrolling="no"></iframe>
              <div class="iphone">
                <iframe class="iframe" src="https://{{Auth::user()->domain}}/a/retailers" scrolling="no"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container m-t-0 bg-transparent">
    <div class="row  p-t-0">
      <div class="col-sm-4">
        <div class="card-box">
          <img src="/images/mapper-template-placeholder.png" class="img-fluid">

          <hr>
          <div class="row p-x-1">
            <div class="col-xs-6">
              <a href="#" class="btn btn-secondary">
                Customize
              </a>
            </div>
            <div class="col-xs-6">
              <a href="#" class="btn btn-primary">
                Publish Template
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container m-t-2">

  <div class="row">
    <div class="col-md-3 p-x-2">
      //
    </div>
    <div class="col-md-9 p-x-2">
      <p class="p-x-3">      <h6>Templates</h6>
        <small>Templates are pre-designed responsive layouts that that will intergrate into your Shopify Theme and inherit all existing css styling. For better optimisation, You can custom style elements of your selected template via the <a href="#">Customize</a> section of you Themes page.</small></p>
      </div>
    </div>
  </div>

  @endsection

  @section('js')
  <script>
    ShopifyApp.ready(function(){
      ShopifyApp.Bar.initialize({
        title: 'Templates',
        buttons: {
          primary: {
            label: "Save Retailer",
            message: 'save_retailer',
            loading: true,
            callback: function(messege){
              ShopifyApp.flashNotice("Retailer Saved!")
            }
          },
          secondary: {
            label: "Customize Template",
            href: "/a/retailers/",
            target: 'app'
          }
        }
      });

      window.newModal = function(path, title){
        ShopifyApp.Modal.open({
          src: path,
          title: title,
          height: 600,
          width: 'medium',
          buttons: {
            primary: {
              label: "OK",
              message: 'edit_location',
              callback: function(message){
                ShopifyApp.Modal.close("ok");
              }
            },
            secondary: {
              label: "Cancel",
              callback: function(message){
                ShopifyApp.Modal.close("cancel");
              }
            }
          },
        }, function(result){
          if (result == "ok")
            ShopifyApp.flashNotice("Retailer Location Saved!")
          else if (result == "cancel")
            ShopifyApp.flashNotice("'Cancel' button pressed")
        });
      }
    });

  </script>

  <script>
   loadjs([
    '/js/plugins/iframe.min.js'],
    { success: function() {
      skriptz.iframed();
    }
  });

   window.skriptz = window.skriptz || {};

   skriptz.iframed = function () {
    $('#live_iframe_preview').iFrameResize( [{
      autoResize: true
    }] );
  };

</script>
@endsection

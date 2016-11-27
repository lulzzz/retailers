@extends('layouts.app')

@section('content')
<div class="container bg-transparent">

  @if ($errors->any())

  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-danger" role="alert">
        <strong>Submission Error!</strong>
        <ul class="p-t-2">
          <li class="error">
            {{ implode('', $errors->all(':message')) }}
          </li>
        </ul>
      </div>
    </div>
  </div>

  @endif

  {{ Form::model($retailer, 
    array(
      'data-shopify-app-submit' => 'save_retailer', 
      'method' => 'PATCH',
      'route' => array(
        'retailers.update', $retailer->id
        )
      )
    ) 
  }}

  <div class="row">

    <div class="col-sm-8">
      <div class="card-box">
        @include('retailers.partials.retailer')
        @include('retailers.partials.contact')
      </div>
    </div>

    <div class="col-sm-4">
      <div class="left-card">
        <h3>Logo</h3>
        <hr>
        <div id="logo_container">

          <fieldset class="form-group">
            @if(is_null($retailer->logo_lg))
            <div class="row">
              <div class="col-xs-12">
                <div class="dropzone dz-clickable" id="logo_upload">
                  <img class="img-fluid" data-dz-thumbnail>
                  <div class="dz-default dz-message">
                    <span>Upload Logo</span>
                  </div>
                </div>
              </div> 
            </div>
            @else
            <div class="row">
              <div class="col-xs-12">
                <div class="delete">
                 <a id="logo-delete" class="delete-btn" data-remote="true" href="{{ route('delete-logo',array('id' => $retailer->id)) }}" rel="nofollow" data-method="delete">
                  <svg id="i-close" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
                    <path d="M2 30 L30 2 M30 30 L2 2" />
                  </svg>
                </a>
              </div>

              <img src="{{ Storage::url($retailer->logo_lg) }}" class="img-fluid logoPreview">
            </div>
          </div>
          @endif
        </fieldset>
      </div>
      <!-- End Dropzone Preview Template -->
    </div>
    <div class="left-card">
      @include('retailers.partials.merchants')
    </div>
    <div class="left-card">
      @include('retailers.partials.visibility')
    </div>
  </div>

</div>
{{ Form::close() }}

{{ Form::model($location, 
  array(
    'method' => 'PATCH',
    'id' => 'add_location',
    'route' => array(
      'locations.update', $id
      )
    )
  ) 
}}

@include('retailers.partials.locations')

{{ Form::close() }}

</div>
@stop


@section('js')
<script>
  ShopifyApp.ready(function(){
    ShopifyApp.Bar.initialize({
      title: "{{$retailer->name}}",
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
          label: "Preview",
          href: "/a/retailers/",
          target: 'app'
        }
      },
      pagination: {
        next: {
          href: "{{ URL::to('/retailers/' . $next . '/edit') }}"
        },
        previous: {
          href: "{{ URL::to('/retailers/' . $prev . '/edit') }}"
        }
      },
      breadcrumb: {
        label: "Retailers",
        href: "/retailers",
        target: 'app',
        loading: false
      }
    });

    window.addressModal = function(path, title){
      ShopifyApp.Modal.open({
        src: path,
        title: title,
        height: 200,
        width: 'small',
        buttons: {
          primary: {
            label: "Save",
            message: 'edit_address',
            callback: function(message){
              ShopifyApp.Modal.close("ok");
              $('#pjax-container').load('/retailers/{{$retailer->id}}/edit #pjax-container  > *');
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
          ShopifyApp.flashNotice("Address Updated!")
        else if (result == "cancel")
          ShopifyApp.flashNotice("Cancelled!")
      });
    }

    window.storefrontModal = function(path, title){
      ShopifyApp.Modal.open({
        src: path,
        title: title,
        width: 'medium',
        buttons: {
          primary: {
            label: "OK",
            message: 'edit_storefront',
            callback: function(message){
              ShopifyApp.Modal.close("ok");
              $('#pjax-container').load('/retailers/{{$retailer->id}}/edit #pjax-container  > *');
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
          ShopifyApp.flashNotice("Storefront Saved")
        else if (result == "cancel")
          ShopifyApp.flashNotice("Cancelled? Weak effort!")
      });
    }
  });

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script>
  loadjs([
    'https://retailers.dev/js/plugins/geocomplete.min.js',
    'https://retailers.dev/js/plugins/dropzone.min.js'],
    { success: function() {  
      $(skriptz.init);
    }
  });

  window.skriptz = window.skriptz || {};

  skriptz.cacheSelectors = function () {
    skriptz.cache = {
      $logo_container         :   $('#logo_container'),
      $location_container     :   $('#pjax-container'),
      $add_location           :   $('#add_location')
    };
  };

  skriptz.init = function () {
    skriptz.cacheSelectors();
    skriptz.dropzone();
    skriptz.logo();
    skriptz.location();
  };


  skriptz.dropzone = function () {
    Dropzone.options.logoDropzone = false;
    Dropzone.options.storefrontDropzone = false;
  };

  skriptz.logo = function () {
    var logoDropzone = new Dropzone('#logo_upload', { 
      url: "https://retailers.dev/upload/image/{{$id}}",
      paramName: "logo",
      thumbnailWidth: 300,
      complete: function () {
        skriptz.cache.$logo_container.load('/retailers/{{$retailer->id}}/edit #logo_container  > *');
      }
    });
    return logoDropzone;
  };

  skriptz.location = function () {
    var form = skriptz.cache.$add_location;

    form.submit(function (ev) {
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {
          skriptz.cache.$location_container.load('/retailers/{{$retailer->id}}/edit #pjax-container > *');
        }
      });
      ev.preventDefault();
    });
  };
</script>
@stop

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

  {{ Form::model($retailer,
    array(
      'id' => 'retailer-data',
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
        @include('app.retailers._partials.retailer')
        @include('app.retailers._partials.contact')
      </div>
    </div>

    <div class="col-sm-4">
      <div class="left-card">
        <div id="logo_container" class="logo-upload">
          <script>loadjs.ready();</Script>
            <fieldset class="form-group">
             @if($retailer->logo_lg == null)
             <div class="dropzone dz-clickable" id="logo_upload">
              <div class="dz-default dz-message">
              <div class="row">
                  <div class="col-xs text-xs-left">
                   <h3>Logo</h3>
                 </div>
                 <div class="col-xs text-xs-right">
                   <span class="upload-href">Add Logo</span>
                 </div>
               </div>
               <img class="img-fluid" data-dz-thumbnail>
               <div class="image-placeholder mt-0">
                 <svg id="i-photo" viewBox="0 0 32 32" width="42" height="42" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25%">
                  <path d="M20 24 L12 16 2 26 2 2 30 2 30 24 M16 20 L22 14 30 22 30 30 2 30 2 24" />
                  <circle cx="10" cy="9" r="3" />
                </svg>
                <p>Drop file to upload</p>
              </div>
            </div>
          </div>
          @else
          <div class="dropzone dz-clickable" id="logo_upload">
            <div class="dz-default dz-message">
            <div class="row">
                  <div class="col-xs text-xs-left">
                   <h3>Logo</h3>
                 </div>
                 <div class="col-xs text-xs-right">
                   <span class="upload-href">Replace Logo</span>
                 </div>
               </div>
             <div class="logo-preview">
               <img src="{{$retailer->logo_lg}}" class="img-fluid">

             </div>
           </div>
         </div>
         <div class="logo-delete">
          <a href="{{ route('delete-logo',array('id' => $retailer->id, 'type' => 'logo')) }}" class="btn image-delete" data-remote="true" data-method="delete">Remove
          </a>
        </div>
        @endif
      </fieldset>
    </div>
    <!-- End Dropzone Preview Template -->
  </div>
  <div class="left-card p-0">
    <div class="p-2">
      @include('app.retailers._partials.feature')
    </div>
    <hr>
    <div class="p-2">
      @include('app.retailers._partials.visibility')
    </div>
  </div>

</div>

</div>
{{ Form::close() }}

{{ Form::model($location,
  array(
    'method' => 'PATCH',
    'data-remote' => 'true',
    'class' => 'location_add',
    'id' => 'add_location',
    'route' => array(
      'locations.update', $id
      )
    )
  )
}}

@include('app.retailers._partials.locations')

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
          style: 'disabled',
        },
      },
      @if(is_null($retailer->name))
      breadcrumb: {
        label: "Retailers",
        loading: false,
        callback: function(message){
          dirtyConfirm();
        }
      },
      @else
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
      @endif
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
        height:300,
        buttons: {
          primary: {
            label: "Done",
            message: 'edit_storefront',
            callback: function(message){
              ShopifyApp.Modal.close("ok");
              $('#pjax-container').load('{{env('APP_URL')}}/retailers/{{$retailer->id}}/edit #pjax-container  > *');
            }
          }
        },
      }, function(result){
        if (result == "ok")
          ShopifyApp.flashNotice("Storefront Saved")
      });
    }
  });


</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script>
  loadjs([
    '{{env('APP_URL')}}/assets/app/js/plugins/geocomplete.min.js',
    '{{env('APP_URL')}}/assets/app/js/plugins/dropzone.min.js'],
    { success: function() {
      $(skriptz.init);
    }
  });

  window.skriptz = window.skriptz || {};

  skriptz.cacheSelectors = function () {
    skriptz.cache = {
      $logo_container         :   $('#logo_container'),
      $location_container     :   $('#pjax-container'),
      $add_location           :   $('#add_location'),
      $retailer_data          :   $('form#retailer-data')
    };
  };

  skriptz.init = function () {
    skriptz.cacheSelectors();
    skriptz.dropzone();
    skriptz.logo();
    skriptz.logoDelete();
    skriptz.location();
    skriptz.dirty();
    //skriptz.areyousure();
  };


  skriptz.dirty = function () {
    skriptz.cache.$retailer_data.areYouSure({'silent':true});
    skriptz.cache.$retailer_data.on('dirty.areYouSure', function() {
      skriptz.dirtyOn();
      skriptz.dirtyCheck();

    });
    skriptz.cache.$retailer_data.on('clean.areYouSure', function() {
      skriptz.dirtyOff();
    });
  };

  skriptz.dirtyCheck = function () {
   $('button').on('click', function(e) {
    e.preventDefault();
    if (skriptz.cache.$retailer_data.hasClass('dirty')) {
      ShopifyApp.Modal.confirm({
        title: "Delete your account?",
        message: "Do you want to delete your account? This can't be undone.",
        okButton: "Yes, delete my account",
        cancelButton: "No, keep my account",
        style: "danger"
      });
    }
  });
 };


 skriptz.dirtyOff = function () {
   ShopifyApp.Bar.initialize({
    title: "{{$retailer->name}}",
    buttons: {
      primary: {
        label: "Save Retailer",
        message: 'save_retailer',
        loading: true,
        style: 'disabled',
      },
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
 };



 skriptz.dirtyOn = function () {
   ShopifyApp.Bar.initialize({
    title: "{{$retailer->name}}",
    buttons: {
      primary: {
        label: "Save Retailer",
        message: 'save_retailer',
        loading: true
      },
    },
    breadcrumb: {
      label: "Retailers",
      loading: false,
      callback: function(message){
        dirtyConfirm();
      }
    }
  });
 };


 window.dirtyConfirm = function(path){
  ShopifyApp.Modal.confirm({
    title: "You have unsaved changes on this page",
    message: "If you leave this page, all unsaved changes will be lost. Are you sure you want to leave this page?",
    okButton: "Leave Page",
    cancelButton: "Cancel",
    style: "danger"
  }, function(result){
    if (result) {
      ShopifyApp.redirect("https://{{Auth::user()->domain}}/admin/apps/{{env('SHOPIFY_KEY')}}/retailers");
    } else {
     return console.log('Return');
   }
 });
}




skriptz.dropzone = function () {
  Dropzone.options.logoDropzone = false;
};

skriptz.logo = function () {
  var logoDropzone = new Dropzone('#logo_upload', {
    url: "{{env('APP_URL')}}/upload/image/{{$id}}",
    paramName: "logo",
    thumbnailWidth: 300,
    complete: function () {
      skriptz.cache.$logo_container.load('/retailers/{{$retailer->id}}/edit #logo_container  > *');
    }
  });
};

skriptz.logoDelete = function () {
  $('.image-delete').on('ajax:success', function(event, xhr, status, error) {
    skriptz.cache.$logo_container.load('/retailers/{{$retailer->id}}/edit #logo_container > *');
    ShopifyApp.flashNotice("Deleted!");
  });
};

skriptz.location = function () {
  $('.location_add').on('ajax:error', function(event, xhr, status, error) {
    ShopifyApp.flashError("Error: Missing Fields!");
  });
  $('.location_add').on('ajax:success', function(event, xhr, status, error) {
    skriptz.cache.$location_container.load('/retailers/{{$retailer->id}}/edit #pjax-container > *');
    $(this)[0].reset();
  });

  $('.location_delete').on('ajax:success', function(event, xhr, status, error) {
    skriptz.cache.$location_container.load('/retailers/{{$retailer->id}}/edit #pjax-container > *');
    ShopifyApp.flashError("Deleted!");
  });
};


$(document).ajaxComplete(function() {
  skriptz.logo();
  skriptz.logoDelete();
});
</script>
@stop

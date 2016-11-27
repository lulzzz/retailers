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
  skriptz.logoDelete();
  skriptz.location();
  skriptz.dirty();
  //skriptz.areyousure();
};


skriptz.dirty = function () {
  $('form#retailer-data').areYouSure({
      change: function() {
            // Enable save button only if the form is dirty. i.e. something to save.
            if ($(this).hasClass('dirty')) {
    ShopifyApp.Modal.alert({
      title: "Warning!",
      message: "An alert message",
      okButton: "I understand"
    });
                  } else {
              $(this).find('input[type="submit"]').attr('disabled', 'disabled');
            }
          }
  });
};


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

@extends('app.layout.skeleton')

@section('content')

  @if($retailer->isEmpty())

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="vertical-align retailer-create">
            <div class="center-align text-xs-center">
              <h2>Add your first Retailer!</h2>
              <h4 class="lead">There is currently no Retailers in your database.</h4>
              <img src="/images/website-icon.png" class="img-fluid bg-icons">
              <p><button type="button" onclick="createModal('/merchants/create')" class="btn btn-lg btn-primary">Create Retailer</button></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="container" id="retailers-list">

      <div class="row">
        <div class="col-xs-12">

          <div class="form-group p-t-2">
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" class="btn btn-secondary dropdown-toggle p-x-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter Retailers
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item delete-retailers" href="/retailers/delete-all" data-remote="true" data-method="delete">
                    Delete Retailers
                  </a>
                </div>
              </div>
              <input type="search" name="search" class="form-control search" placeholder="Start typing to find Retailer...">
              <span class="input-group-btn">
                <button class="btn btn-secondary m-b-0" type="button">Go!</button>
              </span>
            </div>
          </div>

          <div id="retailers" class="row list-group">
          </div>

        </div>
      </div>

      <div id="list-container" class="table-responsive retailers-list" >
        <table class="table table-hover tablesorter" id="table-list">
          <thead>
            <tr>
              <th></th>
              <th><a href="#"  class="sort" data-sort="name"> Retailer</a></th>
              <th><a href="#"  class="sort" data-sort="city"> City</a></th>
              <th><a href="#"  class="sort" data-sort="country"> Country</a></th>
              <th><a href="#"  class="sort" data-sort="visibility"> Visible</a></th>
              <th class="text-xs-right"><a href="#"  class="sort" data-sort="modified"> Last Modified</a></th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($retailer as $key => $value)
              <tr>
                <td>
                  @if(is_null($value->logo_lg))

                  @else
                    <div class="row flex-items-xs-middle">
                      <div class="col-xs">
                        <a href="#" style="">
                          <img src="{{$value->logo_lg}}" class="img-fluid" style="max-width: 30px;">
                        @endif
                      </a>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <span class="name">
                  {{ link_to_route('retailers.edit', $value->name ?: 'Example Retailer', array($value->id)) }}
                </span>
              </td>
              <td>
                <span class="city">{{$value->locations->unique("city")->implode("city", ", ")}}</span>
              </td>
              <td>
                <span class="country">{{$value->locations->unique("country")->implode("country", ", ")}}</span>
              </td>
              <td>
                <span class="visibility">{{$value->visibility == 'public' ? 'Public' : 'Hidden'}}</span>
              </td>
                <td class="text-xs-right"><span class="modified">{{ date('M d, g:i a', strtotime($value->updated_at)) }}&nbsp;</span></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endif

@stop


@section('js')
  <script>

  loadjs([
    '{{env('APP_URL')}}/assets/app/js/plugins/list.min.js'],
    { success: function() {
      skriptz.search();
    }
  });

  window.skriptz = window.skriptz || {};

  skriptz.search = function () {
    var RetailersList = new List('retailers-list', {
      valueNames: ['country','city','name']
    });
  };


  jQuery('#checkAll').on('click', function(e) {
    if($(this).is(':checked',true))
    {
      $(".id").prop('checked', true);
    }
    else
    {
      $(".id").prop('checked',false);
    }
  });

  function checkAll() {
    var checks = document.getElementsByName("checks[]");
    for (var i=0; i < checks.length; i++) {
      checks[i].checked = true;
    }
  }


  ShopifyApp.Bar.initialize({
    buttons: {
      primary: [
        {
          label: "Create Retailer",
          loading: false,
          href: "/retailers/create"
        }
      ],
      secondary: [{
        label: "Import / Export",
        type: "dropdown",
        links: [
          { label: "Import Retailers",
          callback: function(messege){
            importModal('CSV Import', "/import", 440);
          }
        },
        { label: "Export Retailers",
        href: "{{ route( 'export_retailers' )  }}"
      }

    ]
  },{
    label: "Preview",
    target: "new",
    href: "//{{Auth::user()->domain}}/a/retailers"
  }]
}
});

window.importModal = function(header, path, height){
  ShopifyApp.Modal.open({
    src: path,
    title: header,
    height: height,
    width: 'small',
    buttons: {
      primary: {
        label: "Close",
        message: 'edit_address',
        callback: function(message){
          ShopifyApp.Modal.close("ok");
          $('body').load('/retailers');
        }
      }
    },
  }, function(result){
    if (result == "ok")
    ShopifyApp.flashNotice("Import Closed")
  });
}



$('.delete-retailers').on('ajax:beforeSend', function(e) {
  ShopifyApp.Modal.confirm({
    title: "Are you sure?",
    message: "Are you sure you want to Delete all your Retailers and their Locations?",
    okButton: "Delete",
    cancelButton: "Cancel",
    style: "danger"
  }, function(result){
    if (result){
        ShopifyApp.redirect("https://{{Auth::user()->domain}}/admin/apps/{{env('SHOPIFY_KEY')}}/retailers");
    } else {
      return console.log('Return');
    }
  });
});




window.createModal = function(path){
  ShopifyApp.Modal.open({
    src: path,
    title: 'What Type of Retailer?',
    height: 290,
    width: 'small'
  });
}
</script>
@stop

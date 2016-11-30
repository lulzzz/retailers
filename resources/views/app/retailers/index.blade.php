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
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Add Merchant</a>
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

      <div class="table-responsive retailers-list" >
        <table class="table table-hover tablesorter" id="table-list">
          <thead>
            <tr>
              <th data-th-mstr>
                <div class="input-group">
                  <span class="input-group-btn">
                    <label class="btn btn-secondary btn-sm dropdown-toggle">
                      <input class="form-control-input" type="checkbox" id="checkAll"/>
                    </label>
                  </span>
                  <span class="input-group-btn" data-bulk-settings >
                    <button class="btn btn-secondary btn-sm delete_all" type="button">
                      Remove Retailers
                    </button>
                  </span>
                </div>
              </th>
              <th></th>
              <th><span data-th-chkd>Retailer</span></th>
              <th><span data-th-chkd>City</span></th>
              <th><span data-th-chkd>Country</span></th>
              <th><span data-th-chkd>Visible</span></th>
              <th class="text-xs-right"><span data-th-chkd>Last Modified</span></th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($retailer as $key => $value)
              <tr>
                <td class="check-td">
                  <input type="checkbox" data-id="{{$value->id}}" class="id" />
                </td>
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
                @if(is_null($value->name))
                  {{ link_to_route('retailers.edit', 'Example Retailer', array($value->id)) }}
                @else
                  <span class="name">
                    {{ link_to_route('retailers.edit', $value->name, array($value->id)) }}
                  </span>
                @endif
              </td>
              <td>@foreach ($value->locations as $location)
                <span class="city">{{$location->city}}</span>
              @endforeach</td>
              <td>@foreach ($value->locations as $location)
                <span class="country" style="display:none;">{{$location->country}}</span>
                {{$location->country_code}}
              @endforeach</td>
              <td>@if ($value->visibility == 'public') Public @else Hidden @endif&nbsp;</td>
                <td class="text-xs-right">{{ date('M d, g:i a', strtotime($value->updated_at)) }}&nbsp;</td>
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

  $(".delete_all").click(function () {

    var arr = new Array();


    $("input:checked").each(function () {

      arr.push($(this).attr("id"));

    }); //each

    $.ajax({
      type: "POST",
      url: "/retailer/",
      data: arr ,//pass the array to the ajax call
      cache: false,

      success: function()
      {   }
    });//ajax

  }); //each


}); //click

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
          importModal('CSV Import', "/import", 540);
        }
      },
      { label: "Export Retailers",
      callback: function(messege){
        importModal('CSV Exports', "/export", 140);
      }
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
        label: "Cancel",
        callback: function(message){
          ShopifyApp.Modal.close("cancel");
        }
      }
    },
  });
}

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

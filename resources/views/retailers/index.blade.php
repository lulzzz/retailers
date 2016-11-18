@extends('layouts.app')

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

      <div class="form-group p-y-2">
       <div class="input-group">
        <div class="input-group-btn">
          <button type="button" class="btn btn-secondary dropdown-toggle p-x-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter Retailers
          </button>
          <div class="dropdown-menu">
            @foreach($navigation as $value)
            @foreach($value->merchants as $merchant)
            <li><a class="dropdown-item"  href="/retailers/{{$merchant}}">{{$merchant}}</a></li>
            @endforeach
            @endforeach
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
          <span class="input-group-btn" data-bulk-settings style="display:none;">
            <button class="btn btn-secondary btn-sm delete_all" type="button">
              Remove Retailers
            </button>
          </span>
        </div>
      </th>
      <th></th>
      <th><span data-th-chkd>Retailer</span></th>
      <th><span data-th-chkd>Merchant</span></th>
      <th><span data-th-chkd>Country</span></th>
      <th><span data-th-chkd>City</span></th>
      <th><span data-th-chkd>Last Modified</span></th>
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
    <td>{{$value->type}}</td>
    <td>@foreach ($value->locations as $location)
     <span class="country" style="display:none;">{{$location->country}}</span>
     {{$location->country_code}}
     @endforeach</td>
     <td>@foreach ($value->locations as $location)
       <span class="city">{{$location->city}}</span>
       @endforeach</td>
       {{--<td>@if ($value->visibility == 'public') Public @else Hidden @endif&nbsp;</td>--}}
       <td>{{ date('M d, g:i a', strtotime($value->updated_at)) }}&nbsp;</td>
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
  '/js/plugins/list.min.js'],
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

jQuery('.delete_all').on('click', function(e) {
  var allVals = [];
  $(".id:checked").each(function() {
    allVals.push($(this).attr('data-id'));
  });
        //alert(allVals.length); return false;
        if(allVals.length <=0)
        {
          alert("Please select row.");
        }
        else {
            //$("#loading").show();
            WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
            var check = confirm(WRN_PROFILE_DELETE);
            if(check == true){
                //for server side

                var join_selected_values = allVals.join(",");

                        //alert(join_selected_values); return false;

                        $.ajax({

                          type: "POST",
                          url: '/dashboard/delete?ids='+join_selected_values,
                          cache:false,
                          success: function(response)
                          {
                           alert(response);
                   // $("#retailers-list").html(response);
                        //referesh table
                      }
                    });

                        $.each(allVals, function( index, value ) {
                          $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });


                      }
                    }
                  });

ShopifyApp.Bar.initialize({
  buttons: {
    primary: [
    {
      label: "Create Retailer",
      loading: false,
      callback: function(messege){
        createModal("/merchants/create");
      }
    }
    ],
    secondary: {
      label: "Preview",
      target: "new",
      href: "//{{Auth::user()->domain}}/a/retailers"
    }
  }
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

@extends('app.layout.skeleton')

@section('content')
<div class="template-merchants">
  <div class="vertical-align">
    <div class="center-align">
      <div class="row flex-items-xs-center flex-items-xs-middle">
        <div class="col-xs-7 p-a-1">
          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            <strong>Submission Error!</strong>
            <ul class="p-t-2">
              <li class="error">
                {{ implode('', $errors->all(':message')) }}
              </li>
            </ul>
          </div>
          @endif
          <div class="card">
            <h5 class="card-header">
              <span class="pull-xs-left">Merchants</span>
              <span class="pull-xs-right lead">Step 2</span>
            </h5>
            <div class="card-block">
              <p class="lead">Thanks, {{ $brand->brand_name }}!</p>
              <p class="card-text">Now we need to know what type of merchants are re-selling your products. "Merchants" are the "Types" of Retailers selling your products, goods or services. </p>
            </div>

            {{ Form::open(array('route' => 'merchants.store')) }}
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="row flex-items-xs-middle">
                  <div class="col-xs-4">
                    <div class="form-check p-t-1">
                      <label class="custom-control custom-checkbox">
                        <input name="merchant_type[]" class="custom-control-input" type="checkbox" value="store" checked>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">&nbsp; Stores</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="info">
                      <i> Stores refer to "Retail Stores" which are retailers that buy your product at wholesale cost and re-sell it in their brick and mortar shop.</i>
                    </div>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row flex-items-xs-middle">
                  <div class="col-xs-4">
                    <div class="form-check p-t-1">
                      <label class="custom-control custom-checkbox">
                        <input name="merchant_type[]" class="custom-control-input" type="checkbox" value="website" checked>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">&nbsp; Webshops</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="info">
                    <i> Webshops refer to "Website Stores" which are retailers that buy your products at wholesale cost and re-sell your products online via their website / online store.</i>
                    </div>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row flex-items-xs-middle">
                  <div class="col-xs-4">
                    <div class="form-check p-t-1">
                      <label class="custom-control custom-checkbox">
                        <input name="merchant_type[]" class="custom-control-input" type="checkbox" value="flagship">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">&nbsp; Flagships</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="info">
                      <i> Flagships refer to "Flagship Stores" which are the brick and mortar stores owned and operate by your brand or company.</i>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="card-block">
             <span class="pull-xs-left"><a class="btn btn-link" href="/brand/{{$brand->id}}/edit">Back</a></span>
             <span class="pull-xs-right">{{ Form::submit('Begin Adding Retailers',  array('class' => 'btn btn-primary')) }}</span>
           </div>
           {{ Form::close() }}
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection

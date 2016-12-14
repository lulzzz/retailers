<h3>Retailer:</h3>
<hr>
<fieldset class="form-group">
  {{ Form::label('name', 'Retailers Name:') }}
  {{ Form::text('name', null, array(
    'class' => 'form-control form-control-sm name',
    'placeholder' => 'Retailers Name')) }}
  </fieldset>


  <fieldset class="form-group pl-0 mb-0">

    {{ Form::label('description', 'Description:') }}
      <div class="input-group">
        {{ Form::text('website', null, array(
          'class' => 'form-control form-control-sm col-xs-5 meta-site',
          'aria-describedby' => 'website',
          'data-crawl' => 'input',
          'data-ays-ignore' => true,
          'placeholder' => 'example.com')) }}
          <span class="input-group-btn meta-btn-wrap">
            <button class="btn btn-secondary btn-sm col-xs-12 meta-btn" data-crawl="button" type="button">
              <span>Generate Description</span>
            </button>
          </span>
        </div>
    </fieldset>


    <fieldset class="form-group">
      {{ Form::textarea('description', null, array(
        'class' => 'form-control form-control-sm des',
        'size' => '30x5',
        'data-crawl' => 'description',
        'id' => 'description',
        'placeholder' => 'Pssst! Enter your retailers website and generate their google description.')) }}
          <span class="muted"><i><small>Please note that the description will be used for SEO and future releases!</small></i></span>
      </fieldset>

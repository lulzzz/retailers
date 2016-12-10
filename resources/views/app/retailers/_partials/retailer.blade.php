<h3>Retailer:</h3>
<hr>
<fieldset class="form-group">
  {{ Form::label('name', 'Retailers Name:') }}
  {{ Form::text('name', null, array(
    'class' => 'form-control form-control-sm name',
    'placeholder' => 'Retailers Name')) }}
  </fieldset>

  {{--
  <fieldset class="form-group">

    {{ Form::label('website', 'Website:') }}
    <div class="input-group">

      <div class="input-group">
        {{ Form::text('website', null, array(
          'class' => 'form-control form-control-sm',
          'aria-describedby' => 'website',
          'id' => 'des',
          'placeholder' => 'www.example.com')) }}
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Get Description!</button>
          </span>
        </div>
      </div>
    </fieldset>
    --}}

    <fieldset class="form-group">
      {{ Form::label('description', 'Description:') }}
      {{ Form::textarea('description', null, array(
        'class' => 'form-control form-control-sm',
        'size' => '30x5',
        'id' => 'description',
        'placeholder' => 'Tell your customer a little bit about this Retailer...')) }}
      </fieldset>

  <h3>Retailer:</h3>
  <hr>
  <fieldset class="form-group">
    {{ Form::label('name', 'Retailers Name:') }}
    {{ Form::text('name', null, array(
      'class' => 'form-control form-control-sm name',
      'placeholder' => 'Retailers Name')) }}
    </fieldset>
    <fieldset class="form-group">
      {{ Form::label('description', 'Description:') }}
      {{ Form::textarea('description', null, array(
        'class' => 'form-control form-control-sm',
        'size' => '30x5',
        'placeholder' => 'Tell your customer a little bit about this Retailer...')) }}
      </fieldset>

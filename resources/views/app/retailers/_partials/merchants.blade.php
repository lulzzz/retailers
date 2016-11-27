<h3>Merchant Type:</h3>
<hr>
<fieldset class="form-group">
  <div class="btn-group" data-toggle="buttons"  role="group" aria-label="Basic example">
    @foreach($navigation as $value)
    @foreach($value->merchants as $merchant)
    <label for="type" class="btn btn-secondary @if($retailer->type == $merchant) active @endif">
      <input type="radio" value="store" name="type"  @if($retailer->type == $merchant) checked @endif>
      {{ucfirst(trans($merchant))}}
    </label>
    @endforeach
    @endforeach
  </div>
</fieldset>

<h3>Featured:</h3>
<fieldset class="form-group p-t-1">
  <div class="form-check-inline">
    <label class="form-check-label">
      <input type="radio" class="form-check-input form-control-lg" name="featured" value="yes" @if ($retailer->featured == 'yes') checked @endif>&nbsp;&nbsp; Yes
    </label>
  </div>
  <div class="form-check-inline">
    <label class="form-check-label">
      <input type="radio"  class="form-check-input form-control-lg" name="featured" value="no"  @if ($retailer->featured == 'no') checked @endif>&nbsp;&nbsp; No
    </label>
  </div>
</fieldset> 
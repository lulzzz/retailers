<h3>Visibility:</h3>
<fieldset class="form-group p-t-1">
 <div class="form-check-inline">
 <label class="form-check-label">
    <input type="radio" value="public" class="form-check-input form-control-lg" name="visibility" @if($retailer->visibility == 'public') checked @endif>&nbsp;&nbsp;Public</label>
  </div>
  <div class="form-check-inline">
  <label class="form-check-label">
      <input type="radio" value="hidden" class="form-check-input form-control-lg" name="visibility"  @if($retailer->visibility == 'hidden') checked @endif>&nbsp;&nbsp; Hidden</label>
    </div>
  </fieldset>

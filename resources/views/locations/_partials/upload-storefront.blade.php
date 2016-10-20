 <div id="storefront_container">
   @if(is_null($location->storefront_lg))
   <div class="dropzone dz-clickable" id="storefront_upload">
    <div class="dz-default dz-message">
     <img class="img-fluid" data-dz-thumbnail>
     <div class="image-placeholder">
       <svg id="i-photo" viewBox="0 0 32 32" width="42" height="42" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25%">
        <path d="M20 24 L12 16 2 26 2 2 30 2 30 24 M16 20 L22 14 30 22 30 30 2 30 2 24" />
        <circle cx="10" cy="9" r="3" />
      </svg>
      <p>Drop file to upload</p>
    </div>
  </div>
</div>
@else
<div class="row">
  <div class="col-xs-9">
    <div class="dropzone dz-clickable" id="storefront_upload">
      <div class="dz-default dz-message">
       <div class="storefront-preview">
         <img src="{{ Storage::url($location->storefront_lg) }}" class="img-fluid">
       </div>
     </div>
   </div>
 </div>
 <div class="col-xs-3">
   <div class="logo-delete">
    <a href="{{ route('delete-logo',array('id' => $location->id, 'type' => 'storefront')) }}" class="btn storefront_delete" data-remote="true" data-method="delete">Remove
    </a>
  </div>
</div>
</div>
@endif
</div>

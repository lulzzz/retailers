<h3 class="p-t-1">Contact Card</h3>
<hr>
<div class="row">
  <fieldset class="form-group col-xs-6">
    {{ Form::label('email', 'Email:') }}
    <div class="input-group">
     <span class="input-group-addon form-control-sm" id="basic-addon3">
       <svg id="i-mail" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%"><path d="M2 26 L30 26 30 6 2 6 Z M2 6 L16 16 30 6" /></svg>
     </span>
     {{ Form::email('email', null, array(
       'class' => 'form-control form-control-sm',
       'aria-describedby' => 'email',
       'placeholder' => 'info@example.com')) }}
     </div>
   </fieldset>
   <fieldset class="form-group col-xs-6">
    {{ Form::label('website', 'Website:') }}
    <div class="input-group">
      <span class="input-group-addon form-control-sm" id="basic-addon3"><svg id="i-link" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
        <path d="M18 8 C18 8 24 2 27 5 30 8 29 12 24 16 19 20 16 21 14 17 M14 24 C14 24 8 30 5 27 2 24 3 20 8 16 13 12 16 11 18 15" />
      </svg></span>
      {{ Form::text('website', null, array(
        'class' => 'form-control form-control-sm',
        'aria-describedby' => 'website',
        'placeholder' => 'www.example.com')) }}
      </div>
    </fieldset>
    <fieldset class="form-group col-xs-6">
      {{ Form::label('instagram', 'Instagram:') }}
      <div class="input-group">
        <span class="input-group-addon form-control-sm" id="basic-addon3">@</span>
        {{ Form::text('instagram', null, array('class' => 'form-control form-control-sm','aria-describedby' => 'instagram',
        'placeholder' => '@instagram'
        )) }}
      </div>
    </fieldset>
    <fieldset class="form-group col-xs-6">
      {{ Form::label('instagram', 'Twitter:') }}
      <div class="input-group">
        <span class="input-group-addon form-control-sm" id="basic-addon3"><svg id="i-twitter" viewBox="0 0 64 64" width="15" height="15">
          <path stroke-width="0" fill="currentColor" d="M60 16 L54 17 L58 12 L51 14 C42 4 28 15 32 24 C16 24 8 12 8 12 C8 12 2 21 12 28 L6 26 C6 32 10 36 17 38 L10 38 C14 46 21 46 21 46 C21 46 15 51 4 51 C37 67 57 37 54 21 Z" />
        </svg></span>
        {{ Form::text('instagram', null, array(
          'class' => 'form-control form-control-sm',
          'aria-describedby' => 'Twitter',
          'placeholder' => '@tweet'
          )) }}
        </div>
      </fieldset>
    </div>
@extends('app.layout.skeleton')

@section('content')
<div class="row p-a-1">
	<div class="col-xs-12">
		<!--<h3 class="hidden">{{ucfirst($title)}}</h3>-->

		@if($retailer->isEmpty())
		<div class="vertical-align">
		<div class="center-align text-xs-center">
				<h2>Add your first {{ucfirst($title)}} Retailers</h2>
				<h4 class="lead">There is no {{$title}} listed in your database. </h4>
					<img src="/images/{{$title}}-icon.png" class="img-fluid bg-icons">
					<p><a href="/retailers/create" class="btn btn-primary btn-lg">Add {{ucfirst($title)}}  Retailer</a></p>
				<h6 class="lead p-t-3">Data entry sucks! so why not outsource this task to us!<br>Enquire about our Outsource project <a href="#">Here!</a> </h6>

			</div>
		</div>
		@else

		<div class="table-responsive">

			<table class="table table-hover tablesorter" id="table-list">
				<thead>
					<tr>
						<th width="15px"></th>
						<th>Retailer</th>
						<th>Featured</th>
						<th>Online</th>
						<th>Last Modified</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($retailer as $value => $key)
					<tr>
						<td><input type="checkbox" class="checkbox"></td>
						<td>{{ link_to_route('retailers.edit', $key->name, array($key->id)) }}</td>
						<td>{{ $key->featured }}</td>
						<td>@if ($key->visibility == 'public') Public @else Hidden @endif&nbsp;</td>
						<td>{{ date('M d, g:i a', strtotime($key->updated_at)) }}&nbsp;</td>
					</tr>
					@endforeach

				</tbody>

			</table>
		</div>
		@endif
	</div>
</div>
@stop

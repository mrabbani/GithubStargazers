@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><a href="{{url('add-repo')}}">Add New Repository</a></h1>
				@if(count($repositories))
					<table class="table table-bordered">
						<thead>
							<th>Repository name</th>
							<th>Action</th>
						</thead>
						<tbody>
						@foreach($repositories as $repository)
							<tr>
								<td>{{$repository->name}}</td>
								<td>
									<a href="{{url('user-name/' . $repository->id)}}">Collect User</a>;
									<a href="{{url('user-info/' . $repository->id)}}">User Info</a>;
									<a href="{{url('collect-email/' . $repository->id)}}">User Email</a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
@endsection

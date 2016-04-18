@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="{{url('store-repo')}}" method="post" class="form-horizontal">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<label for="name" class="control-label col-md-4">Repository Name</label>
						<div class="col-md-6">
							<input type="text" name="name" class="form-control">
							<span class="text-danger">{{$errors->first('name')}}</span>
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="control-label col-md-4">Github User Name</label>
						<div class="col-md-6">
							<input type="text" name="username" class="form-control">
							<span class="text-danger">{{$errors->first('username')}}</span>

						</div>
					</div>
					<div class="form-group">
						<label for="password" class="control-label col-md-4">Github password</label>
						<div class="col-md-6">
							<input type="password" name="password" class="form-control">
							<span class="text-danger">{{$errors->first('password')}}</span>

						</div>
					</div>
					<div class="col-md-offset-4 col-md-6">
						<input type="submit" value="Save" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

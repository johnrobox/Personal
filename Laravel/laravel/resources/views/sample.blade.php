@extends('master')

@section('main_content')
		<h1>Welcome to my page</h1>
		<h2>Customers</h2>

		@foreach($customers  as $customer)
				<p>{{ $customer->name }}</p>
		@endforeach
@stop
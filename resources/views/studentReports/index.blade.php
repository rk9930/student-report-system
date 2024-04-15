@extends('master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Student Data</b></div>
			<div class="col col-md-6">
				<a class="btn btn-success btn-sm float-end" href="{{ route('create-report') }}">Create Report</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>StudentID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>class</th>
				<th>Grade</th>
				<th>Action</th>
			</tr>
			@if(count($reports) > 0)

			@foreach($reports as $report)
			<tr>
				<td>{{$report->student_id}}</td>
				<td>{{$report->first_name}}</td>
				<td>{{$report->last_name}}</td>
				<td>{{$report->email}}</td>
				<td>{{$report->class}}</td>
				<td>{{$report->grade}}</td>
				<td>
				<a class="btn btn-dark" href="report-cards/{{$report->id}}" role="button">View</a>
				<a class="btn btn-primary" href="edit-reports/{{$report->id}}" role="button">Edit</a>
				</td>

			</tr>
			@endforeach
			@endif


		</table>

	</div>

</div>

@endsection
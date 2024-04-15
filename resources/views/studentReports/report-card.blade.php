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
			<div class="col col-md-6"><b>Student Report Card</b></div>
			<div class="col col-md-6">
				<a class="btn btn-success btn-sm float-end" href="/student-reports">Reports</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		@if($personal_data && count($scoresData) > 0)
		<div class="row mb-3">
			<div class="col-6">
				<label>StudentID:{{ $personal_data['student_id'] }}</label>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-6">
				<label>First Name:{{ $personal_data['first_name'] }}</label>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-6">
				<label>Last Name:{{ $personal_data['last_name'] }}</label>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-6">
				<label>Class:{{ $personal_data['class'] }}</label>
			</div>
		</div>

		<div class="row mb-5">
			<div class="col-6">
				<label>Email:{{ $personal_data['email'] }}</label>
				<input type="hidden" value="{{ $personal_data['email'] }}" id="email"/>
			</div>
			<div class="col col-md-6">
				<a class="btn btn-success btn-sm float-end " id="reportButton" href="/mail-report-card/{{$personal_data['id']}}">Send Report</a>
			</div>
		</div>
		<table class="table table-bordered">
			<tr>
				<th>Subject</th>
				<th>Marks(Out of 100)</th>
			</tr>
			@foreach($scoresData as $key=>$val)
			<tr>
				<td>
					{{ $key }}
				</td>
				<td>
					{{ $val }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td><span style="font-weight:bold">Total Marks</span></td>
				<td><span style="font-weight:bold">{{ $personal_data['total_marks'] }}</span></td>
			</tr>
			<tr>
				<td><span style="font-weight:bold">Percentage</span></td>
				<td><span style="font-weight:bold">{{ $personal_data['percentage'] }}</span></td>
			</tr>

			<tr>
				<td><span style="font-weight:bold">Grade</span></td>
				<td><span style="font-weight:bold">{{ $personal_data['grade'] }}</span></td>
			</tr>


		</table>
		@else
		<h3>No data found</h3>
		@endif

	</div>
	<?php $email = $personal_data['email'];?>

</div>
<script>

var email = document.getElementById("email").value;
if(email){
	$('#reportButton').show();
}else{
	$('#reportButton').hide();

}
</script>

@endsection
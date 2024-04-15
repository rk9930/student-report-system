@extends('master')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>

@endif

<div class="card">
    <div class="card-header">

    <div class="row">
			<div class="col col-md-6"><b>Create Student Report</b></div>
			<div class="col col-md-6">
				<a class="btn btn-success btn-sm float-end" href="/student-reports">Reports</a>
			</div>
		</div>
        
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('submit-report') }}" enctype="multipart/form-data" id="create-report">
            @csrf



            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">StudentID*</label>
                <div class="col-sm-10">
                    <input type="number" name="student_id" class="form-control" value="{{old('student_id')}}" required />
                </div>
            </div>



            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">First Name*</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}"required />
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Last Name*</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control"  value="{{old('last_name')}}" required />
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Class*</label>
                <div class="col-sm-10">
                    <input type="text" name="class" class="form-control" value="{{old('class')}}" required />
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" />
                </div>
            </div>




            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Add Marks*</label>
                <div class="col-sm-10">
                    <table class="table table-bordered">
                        <tr>
                            <th>Subject</th>
                            <th>Marks (Out of 100)</th>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control" type="text" value="English" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number" value="{{old('english_marks')}}"  name="english_marks" required />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <input class="form-control" type="text" value="Hindi" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number" value="{{old('hindi_marks')}}" name="hindi_marks" required />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <input class="form-control" type="text" value="Math" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number" value="{{old('math_marks')}}" name="math_marks" required />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <input class="form-control" type="text" value="Science" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number" value="{{old('science_marks')}}" name="science_marks" required />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input class="form-control" type="text" value="History" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number" value="{{old('history_marks')}}" name="history_marks" required />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input class="form-control" type="text" value="Geography" disabled />
                            </td>
                            <td>
                                <input class="form-control" type="number"value="{{old('geography_marks')}}" name="geography_marks" required />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Remarks</label>
                <div class="col-sm-10">
                    <textarea name="remarks" class="form-control" value="{{old('remarks')}}"></textarea>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
        </form>
    </div>
</div>
<script>
    // alert("hello world")
    $(document).ready(function(){
        $('#create-report').validate({
            rules:{
                student_id:{
                    required:true,
                    min:1,
                    digits:true,
                },
                first_name:{
                    required:true,
                    minlength:2,
                    lettersonly:true
                },
                last_name:{
                    required:true,
                    minlength:2,
                    lettersonly:true
                },
                class:{
                    required:true
                },
                email:{
                    email:true
                },
                remarks:{
                    maxlength:150

                },
                english_marks:{
                    min:0,
                    max:100
                },
                hindi_marks:{
                    min:0,
                    max:100
                },
                math_marks:{
                    min:0,
                    max:100
                },
                science_marks:{
                    min:0,
                    max:100
                },
                history_marks:{
                    min:0,
                    max:100
                },
                geography_marks:{
                    min:0,
                    max:100
                }
            }
        });
    });
</script>

@endsection('content')
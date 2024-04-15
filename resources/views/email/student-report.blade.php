<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Report System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>

<body>

    @if($message = Session::get('success'))

    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
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
                    <label>Batch/Class:{{ $personal_data['class'] }}</label>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-6">
                    <label>Email:{{ $personal_data['email'] }}</label>
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

    </div>

    
</body>

</html>

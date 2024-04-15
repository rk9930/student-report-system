<?php

namespace App\Http\Controllers;

use App\Models\StudentReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class StudentReportsController extends Controller
{

    public function studentReportsIndex()
    {
        $reports = StudentReports::orderBy('id', 'desc')->paginate(10);
        return view('studentReports.index', ['reports' => $reports]);
    }

    public function studentReportsCreate()
    {
        return view('studentReports.create');
    }

    public function studentReportsEdit(Request $request)
    {

        $report_id = $request->id;
        $report = StudentReports::where('id', $report_id)->first();
        $scores = json_decode($report->scores);
        return view('studentReports.edit', compact('report', 'scores'));
    }

    /**
     * Function to store report data into database
     */

    public function createStudentReport(Request $request)
    {
        $studentReportExist = StudentReports::where(['student_id' => $request->student_id])->count();
        if ($studentReportExist > 0) {
            return redirect('/create-reports')->withErrors("Student report with id" . $request->student_id . " already exists!")->withInput($request->input());
        }

        $data = $request->all();
        $data['english_marks'] = (int)$request->english_marks;
        $data['hindi_marks'] = (int)$request->hindi_marks;
        $data['math_marks'] = (int)$request->math_marks;
        $data['science_marks'] = (int)$request->science_marks;
        $data['history_marks'] = (int)$request->history_marks;
        $data['geography_marks'] = (int)$request->geography_marks;
        $validation = Validator::make($data, [
            'student_id' => 'required|integer|min:1',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'nullable|email',
            'class' => 'nullable|string',
            "english_marks" => 'required|integer|min:0|max:100',
            "hindi_marks" => 'required|integer|min:0|max:100',
            "math_marks" => 'required|integer|min:0|max:100',
            "science_marks" => 'required|integer|min:0|max:100',
            "history_marks" => 'required|integer|min:0|max:100',
            "geography_marks" => 'required|integer|min:0|max:100',
            "remarks" => 'nullable|string|max:150'
        ]);
        if ($validation->fails()) {
            return redirect('/create-reports')->withErrors($validation)->withInput($request->input());
        }

        try {
            //code...


            $scores = [
                'English' => (int)$request->english_marks,
                'Hindi' => (int)$request->hindi_marks,
                'Math' => (int) $request->math_marks,
                'Science' => (int)$request->science_marks,
                'History' => (int)$request->history_marks,
                'Geography' => (int)$request->geography_marks,
            ];

            $total_marks_scored = (int)$request->english_marks + $request->hindi_marks + $request->math_marks + $request->science_marks + $request->history_marks + $request->geography_marks;
            $percentage = round(($total_marks_scored / 600) * 100, 2);
            $grade = "Fail";
            switch ($percentage) {
                case $percentage >= 75:
                    $grade = "Distinction";
                    break;
                case $percentage >= 60 && $percentage <= 74:
                    $grade = "First Class";
                    break;
                case $percentage >= 33 && $percentage <= 59:
                    $grade = "Pass";
                    break;
                default:
                    $grade =  "Fail";
            }




            $report_data = [
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'class' => $request->class ?? NULL,
                'email' => $request->email ?? NULL,
                'scores' => json_encode($scores),
                'percentage' => $percentage ?? NULL,
                'total_marks' => $total_marks_scored,
                'grade' => $grade ?? NULL,
                'remarks' => $request->remarks ?? NULL,
            ];

            // dd($request->all(), $report_data);

            DB::beginTransaction();

            $report = StudentReports::create($report_data);


            // dd("report created ");
            DB::commit();
            return redirect('/report-cards/' . $report->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect('/create-reports')->withErrors($e->getMessage())->withInput($request->input());
            //throw $th;
        }
    }

    /**
     * Function to update report data into database using report id.
     */
    public function updateStudentReport(Request $request)
    {
        $record_id = $request->id;
        $studentReportExist = StudentReports::where(['id' => $record_id])->count();
        if ($studentReportExist == 0) {
            return redirect('/edit-reports/' . $record_id)->withErrors("Student report does not exists!")->withInput($request->input());
        }

        $data = $request->all();
        $data['english_marks'] = (int)$request->english_marks;
        $data['hindi_marks'] = (int)$request->hindi_marks;
        $data['math_marks'] = (int)$request->math_marks;
        $data['science_marks'] = (int)$request->science_marks;
        $data['history_marks'] = (int)$request->history_marks;
        $data['geography_marks'] = (int)$request->geography_marks;
        $validation = Validator::make($data, [
            'student_id' => 'required|integer|min:1',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'nullable|email',
            'class' => 'nullable|string',
            "english_marks" => 'required|integer|min:0|max:100',
            "hindi_marks" => 'required|integer|min:0|max:100',
            "math_marks" => 'required|integer|min:0|max:100',
            "science_marks" => 'required|integer|min:0|max:100',
            "history_marks" => 'required|integer|min:0|max:100',
            "geography_marks" => 'required|integer|min:0|max:100',
            "remarks" => 'nullable|string|max:150'
        ]);
        if ($validation->fails()) {
            return redirect('/edit-reports/' . $record_id)->withErrors($validation)->withInput($request->input());
        }

        try {
            //code...


            $scores = [
                'English' => (int)$request->english_marks,
                'Hindi' => (int)$request->hindi_marks,
                'Math' => (int) $request->math_marks,
                'Science' => (int)$request->science_marks,
                'History' => (int)$request->history_marks,
                'Geography' => (int)$request->geography_marks,
            ];

            $total_marks_scored = (int)$request->english_marks + $request->hindi_marks + $request->math_marks + $request->science_marks + $request->history_marks + $request->geography_marks;
            $percentage = round(($total_marks_scored / 600) * 100, 2);
            $grade = "Fail";
            switch ($percentage) {
                case $percentage >= 75:
                    $grade = "Distinction";
                    break;
                case $percentage >= 60 && $percentage <= 74:
                    $grade = "First Class";
                    break;
                case $percentage >= 33 && $percentage <= 59:
                    $grade = "Pass";
                    break;
                default:
                    $grade =  "Fail";
            }




            $report_data = [
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'class' => $request->class ?? NULL,
                'email' => $request->email ?? NULL,
                'scores' => json_encode($scores),
                'percentage' => $percentage ?? NULL,
                'total_marks' => $total_marks_scored,
                'grade' => $grade ?? NULL,
                'remarks' => $request->remarks ?? NULL,
            ];

            // dd($request->all(), $report_data);

            DB::beginTransaction();

            $report = StudentReports::where('id', $record_id)->update($report_data);


            // dd("report created ");
            DB::commit();
            return redirect('/report-cards/' . $record_id);
        } catch (\Throwable $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect('/edit-reports/' . $record_id)->withErrors($e->getMessage())->withInput($request->input());
            //throw $th;
        }
    }

    /**
     * Function to generate report card
     */
    public function generateReportCard(Request $request)
    {
        $report_card_id = $request->id;
        $report_card_data = StudentReports::where(['id' => $report_card_id])->first();
        if (is_null($report_card_data)) {
            return redirect('student-reports');
        }
        $scoresData = (array)json_decode($report_card_data->scores) ?? [];
        $personal_data = (array)json_decode(json_encode($report_card_data)) ?? [];
        // dd($scoresData);
        return view('studentReports.report-card', compact('personal_data', 'scoresData'));
    }

    /**
     * Function to mail report card to provided email
     */
    public function mailReportCard(Request $request)
    {
        $report_card_id = $request->id;
        $report_card_data = StudentReports::where(['id' => $report_card_id])->first();
        if (is_null($report_card_data)) {
            return redirect('student-reports');
        }
        $scoresData = (array)json_decode($report_card_data->scores) ?? [];
        $personal_data = (array)json_decode(json_encode($report_card_data)) ?? [];
        $data['personal_data'] = $personal_data;
        $data['scoresData'] = $scoresData;
        $to = $personal_data['email'];
        $pdf = PDF::loadView('email.student-report', $data);
        $mailData['user'] = $personal_data['first_name'];
        $mailData['class'] = $personal_data['class'];
        try {
            Mail::send('email.report-mail', $mailData, function ($message) use ($mailData, $pdf, $to) {
                $message->to($to)
                    ->subject("Student Report")
                    ->attachData($pdf->output(), $mailData['user'] . ".pdf");
            });
            return redirect('student-reports')->with('success', 'Report has been sent successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

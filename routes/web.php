<?php

use App\Http\Controllers\StudentReportsController;
use App\Models\StudentReports;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[StudentReportsController::class, 'studentReportsIndex']);
Route::get('/student-reports', [StudentReportsController::class, 'studentReportsIndex']);
Route::get('/create-reports',[StudentReportsController::class,'studentReportsCreate'])->name('create-report');
Route::get('/edit-reports/{id}',[StudentReportsController::class,'studentReportsEdit'])->name('edit-report');

Route::post('/student-reports', [StudentReportsController::class, 'createStudentReport'])->name('submit-report');
Route::put('/student-reports/{id}', [StudentReportsController::class, 'updateStudentReport'])->name('update-report');

Route::get('/report-cards/{id}', [StudentReportsController::class,'generateReportCard']);

Route::get('/mail-report-card/{id}', [StudentReportsController::class, 'mailReportCard']);

// Route::get('student-report-mail', )
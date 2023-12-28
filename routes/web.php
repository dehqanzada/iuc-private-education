<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceGroupController;
use App\Http\Controllers\ResourceGroupItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Auth::routes();

//Auth::routes([
//    'register' => false,
//    'reset' => false,
//]);

Route::get('/', [HomeController::class, 'index']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/get-students', [StudentController::class, 'getStudents'])->name('getStudents');

    Route::resource('students', StudentController::class);
    Route::resource('resources', ResourceController::class);
    Route::resource('resource-groups', ResourceGroupController::class);
    Route::resource('resource-group-items', ResourceGroupItemController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('settings', SettingController::class);

    Route::get('/do-experiences/{studentId}/{tutorialGroupId}/{examId?}', [ExperienceController::class, 'doExperience'])->name('doExperience');
    Route::post('/save-experiences', [ExperienceController::class, 'saveCanvasImage'])->name('saveExperience');

    Route::get('/get-reports/{studentId}/{groupId}', [ExperienceController::class, 'getReports'])->name('getReports');

    Route::post('/update-setting-style', [SettingController::class, 'updateSettingStyle'])->name('updateSettingStyle');

});

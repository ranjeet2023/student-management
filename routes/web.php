<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/student-record',[StudentController::class,'StudentRecord'])->name('student-record');
    Route::post('/add-student-record',[StudentController::class,'AddStudentRecord'])->name('add-student-record');
    Route::post('/edit-student-record',[StudentController::class,'EditStudentRecord'])->name('edit-student-record');
    Route::post('/delete-student-record',[StudentController::class,'DeleteStudentRecord'])->name('delete-student-record');
    Route::get('/student-result',[StudentController::class,'StudentResult'])->name('student-result');
    Route::post('/create-student-result',[StudentController::class,'CreateStudentResult'])->name('create-student-result');
    Route::get('/view-student-result',[StudentController::class,'ViewStudentResult'])->name('view-student-result');
    Route::get('/get-student-result/{id}',[StudentController::class,'GetStudentResult'])->name('get-student-result');
    Route::post('/update-student-result',[StudentController::class,'CreateStudentResult'])->name('update-student-result');
    Route::get('/delete-student-result/{id}',[StudentController::class,'DelteStudentResult'])->name('delete-student-result');
});

require __DIR__.'/auth.php';

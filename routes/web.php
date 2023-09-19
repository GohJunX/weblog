<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;   
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\videoController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ChatBotController;

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
Auth::routes();

// Route::get('/', function () {
//     return view('jobboard');
// });

// Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class,'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Registration routes
Route::get('/register/job-seeker', [RegisterController::class,'showJobSeekerRegistrationForm'])->name('register.job_seeker');
Route::post('/register/job-seeker', [RegisterController::class,'registerJobSeeker'])->name('register.job_seeker.submit');
Route::get('/register/employer', [RegisterController::class,'showEmployerRegistrationForm'])->name('register.employer');
Route::post('/register/employer', [RegisterController::class,'registerEmployer'])->name('register.employer.submit');

// Admin verify company
Route::group(['prefix' => 'admin',  'as' => 'admin.'], function () {
    Route::get('verify', [VerifyController::class, 'index'])->name('verify.index');
    Route::get('verify/show/{id}', [VerifyController::class, 'show'])->name('verify.show');//id
    Route::post('verify/approve/{id}', [VerifyController::class, 'approve'])->name('verify.approve');//id
    Route::post('verify/reject/{id}', [VerifyController::class, 'reject'])->name('verify.reject');//id
});

// Admin verify sB
Route::group(['prefix' => 'admin',  'as' => 'admin.'], function () {
    Route::get('verifySB', [VerifyController::class, 'indexSB'])->name('verifySB.index');
    Route::get('verifyS/show/{id}', [VerifyController::class, 'showS'])->name('verifyS.show');//id
    Route::get('verifyB/show/{id}', [VerifyController::class, 'showB'])->name('verifyB.show');//id
    Route::post('verifyS/approve/{id}', [VerifyController::class, 'approveS'])->name('verifyS.approve');//id
    Route::post('verifyB/approve/{id}', [VerifyController::class, 'approveB'])->name('verifyB.approve');//id
    Route::post('verifyS/reject/{id}', [VerifyController::class, 'rejectS'])->name('verifyS.reject');//id
    Route::post('verifyB/reject/{id}', [VerifyController::class, 'rejectB'])->name('verifyB.reject');//id
});

// Admin verify JB
Route::group(['prefix' => 'admin',  'as' => 'admin.'], function () {
    Route::get('verifyJB', [VerifyController::class, 'indexJB'])->name('verifyJB.index');
    Route::get('verifyJB/show/{id}', [VerifyController::class, 'showJB'])->name('verifyJB.show');//id
    Route::post('verifyJB/reject/{id}', [VerifyController::class, 'rejectJB'])->name('verify.rejectJB');//id
    Route::get('verifyJB/search', [VerifyController::class, 'search'])->name('verify.search');//id
    Route::post('verifyJB/approve/{id}', [VerifyController::class, 'approveJB'])->name('verify.approveJB');
});

//short video
Route::get('/shortVideo',[videoController::class,'index'])->name('video.home');
Route::get('/shortVideoD/{id}',[videoController::class,'indexD'])->name('videoD.home');
Route::get('/shortVideo/getNextVideo', [videoController::class, 'getNextVideo'])->name('video.getNextVideo');
Route::get('/shortVideo/upload',[videoController::class,'uploadShow'])->name('video.uploadS');
Route::post('/shortVideo/upload',[videoController::class,'upload'])->name('video.upload');
Route::post('/shortVideo/{videoId}/comments', [videoController::class, 'stores'])->name('comments.store');
Route::post('/likes/{videoId}', [videoController::class, 'toggleLike']);
Route::get('/likes/check/{videoId}', [videoController::class, 'checkLike'])->name('likes.check');
Route::post('shortVideo/delete/{id}', [videoController::class, 'videoDelete'])->name('video.delete');//id



//profile jobseeker
Route::get('/editProfile',[ProfileController::class, 'editShow'])->name('profile.edit');
Route::put('/editProfile/edit', [ProfileController::class, 'updateProfile'])->name('jobSeeker.updateProfile');
Route::get('/profile/show/{id}', [ProfileController::class,'show'])->name('user.profile');//id

//profile employer
Route::get('/editEmpProfile',[ProfileController::class, 'editEmpShow'])->name('profileEmp.edit');
Route::put('/editEmpProfile/edit', [ProfileController::class, 'updateEmpProfile'])->name('employer.updateProfile');
Route::get('/profileEmp/show/{id}', [ProfileController::class,'show'])->name('profileEmp.show');//id

//blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('/create', [BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/show/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/profile/{id}', [BlogController::class, 'indexProfile'])->name('blog.profile');
Route::post('/blog/delete/{id}', [BlogController::class, 'blogDelete'])->name('blog.delete');//id


//jobboard
Route::get('/', [JobController::class, 'index'])->name('job.index');
Route::get('/jobs/show/{id}', [JobController::class, 'show'])->name('job.show');//id
Route::get('/jobs/search', [JobController::class, 'search'])->name('job.search');

//apply job
Route::get('/apply/{id}/{successMessage?}', [JobController::class,'showApplyJobForm'])->name('applyJobForm')->middleware('auth');//id
Route::post('/apply/{id}', [JobController::class,'submitApplication'])->name('submitApplication');

//notification
Route::get('/notification', [EmailController::class,'index'])->name('notification.index');
Route::get('/notification/show/{id}', [EmailController::class,'show'])->name('notification.show');
Route::get('/notification/reply/{id}', [EmailController::class,'replyshow'])->name('notificationget.reply');
Route::post('/notification/reply/{id}', [EmailController::class,'reply'])->name('notificationpost.reply');

//notificationJS
Route::get('/notificationJ', [EmailController::class,'indexJ'])->name('notificationJ.index');
Route::get('/notificationJ/show/{id}', [EmailController::class,'showJ'])->name('notificationJ.show');
Route::get('/notificationJ/reply/{id}', [EmailController::class,'replyJShow'])->name('notificationJget.reply');
Route::post('/notificationJ/reply/{id}', [EmailController::class,'replyJ'])->name('notificationJpost.reply');

//Employer job post
Route::get('/employerjobpost', [JobController::class,'showEmployer'])->name('employer.show');
Route::get('/employerjobpost/create', [JobController::class,'showCreateJobPost'])->name('employerCreate.show');
Route::post('/employerjobpost/create', [JobController::class,'createjobPost'])->name('employerCreate');
Route::get('/employerjobpost/detail/{id}', [JobController::class,'jobPostDetailShow'])->name('employerDetail.show');
Route::put('/employerjobpost/detailEdit/{id}', [JobController::class,'jobPostDetail'])->name('employerDetail.Edit');
Route::get('/home', [JobController::class, 'index'])->name('home');
Route::post('/jobPosts/{id}', [JobController::class,'destroy'])->name('jobPosts.destroy');

// Quiz Routes
Route::middleware('auth')->group(function () {
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::post('/quizzes/{quiz}', [QuizController::class, 'submit'])->name('quizzes.submit');
Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
});

//chatBot
Route::post('/chatBot',[ChatBotController::class, 'sendChat'])->name('send');
Route::get('/chatBot',function(){
    return view('chatBot');
});

//about us

Route::get('/aboutus',function(){
    return view('aboutus');
});
<?php

use App\Http\Controllers\AdminNavController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\HukukBasvuruController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

Route::get('/kayıt-ol',function(){
    return view("register");
})->name('login');

Route::get('/demo',function(){
    return view("demo");
});

// Step 1 Dosya yükleme (Pdf,img vs)
Route::post('/uploadFiles',[HukukBasvuruController::class,'uploadFile']); 
// Step 2 Ses Dosyası Yükleme
Route::post('/upload-audio',[HukukBasvuruController::class,'uploadAudio']);
// Step 3 Video Dosyası Yükleme
Route::post('/upload-video',[HukukBasvuruController::class,'uploadVideo']);





Route::get('/giriş-yap',function(){
    return view("login");
})->name('login');


Route::post('/register',[AuthController::class,'registerPost'])->name('registerPost');
Route::post('/login',[AuthController::class,'loginPost'])->name('loginPost');



Route::middleware(['auth'])->group(function(){

    Route::get('/account',function(){
        return view("userpanel.account");
    });
    
    Route::get('/admin',[AdminRequestController::class,'index']);
    Route::get('/requests/{request}',[AdminRequestController::class,'show'])->name('requests.show');

    Route::get('/download/{filename}',[AdminRequestController::class,'download'])->name('download');

    //admin menuitem
    Route::get('/admin/aktif_basvurular', [AdminNavController::class, 'active_requests'])->name('active_requests');

  


    Route::get('/demo',[HukukBasvuruController::class,'basvuru']);


    // SORU OLUŞTURMA AŞAMALARI

    // Başvuru oluşturma ve tür seçme
    Route::post('/createFirstRequest',[HukukBasvuruController::class,'createRequest']);

    // Soru tipini gönderme
    Route::post('/sendRequestTypes',[HukukBasvuruController::class,'sendTypes']);

    // Geri Dönüş Tipini Gönderme

    Route::post('/set-feedback-method',[HukukBasvuruController::class,'setFeedBackMethod']);



});




<?php

use App\Http\Controllers\AdminNavController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\HukukBasvuruController;
use App\Http\Middleware\SetPreferredLanguage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserPanelController;
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

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::get('/u', function(){
    return view('uitest');
});

Route::get('/kayıt-ol',function(){
    return view("register");
})->name('register');
Route::get('/giriş-yap',function(){
    
    return view("login");
})->name('login');

// Footer
Route::get('/about-us',function(){

    return view('about_us');
});

Route::get('/privacy-policy',function(){

    return view('privacy_policy');
});

Route::get('/kvkk',function(){

    return view('kvkk');
});

Route::get('/contact',function(){

    return view('contact');
});

Route::group(['middleware' => ['web']],function(){

Route::get('/', function () {
    return view('items');
})->name('home');





Route::post('/login',[AuthController::class,'loginPost'])->name('loginPost');

Route::post('/register',[AuthController::class,'registerPost'])->name('registerPost');

Route::middleware(['auth'])->group(function(){

    // Kullanıcı Paneli
    Route::get('/account',function(){
        return view("userpanel.account");
    });
    
   // Tüm başvuruları görüntüleme sayfası (Kullanıcı)
   Route::get('/account/aktif-basvurularim', [UserPanelController::class, 'myRequests'])->name('myRequests');
   
 


    // SORU OLUŞTURMA AŞAMALARI
       // Başvuru ekranı
       Route::get('/application',[HukukBasvuruController::class,'basvuru']);
    // Başvuru oluşturma ve tür seçme
    Route::post('/createFirstRequest',[HukukBasvuruController::class,'createRequest']);

    // Soru tipini gönderme
    Route::post('/sendRequestTypes',[HukukBasvuruController::class,'sendTypes']);

    // Geri Dönüş Tipini Gönderme

    Route::post('/set-feedback-method',[HukukBasvuruController::class,'setFeedBackMethod']);


    //dosya upload
    // Step 1 Dosya yükleme (Pdf,img vs)
Route::post('/uploadFiles',[HukukBasvuruController::class,'uploadFile']); 
// Step 2 Ses Dosyası Yükleme
Route::post('/upload-audio',[HukukBasvuruController::class,'uploadAudio']);
// Step 3 Video Dosyası Yükleme
Route::post('/upload-video',[HukukBasvuruController::class,'uploadVideo']);


//AdminPanel
    //Admin Anasayfa
    Route::get('/admin',[AdminRequestController::class,'index']);
    // Tüm başvuruları görüntüleme sayfası
    Route::get('/requests/{request}',[AdminRequestController::class,'show'])->name('requests.show');
    // dosyaları görüntüleme
    Route::get('/download/{filename}',[AdminRequestController::class,'download'])->name('download');
    //admin menuitem
    Route::get('/admin/aktif_basvurular', [AdminNavController::class, 'active_requests'])->name('active_requests');
//Admin Çıkış
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// answer the question
Route::post('/answerQuestion',[AdminRequestController::class,'answerQuestion'])->name('answer.question');
//Delete Answer
Route::delete('/answer/delete/{id}', [AdminRequestController::class, 'deleteAnswer'])->name('answer.delete');


});


//mw end
});
<?php

use App\Http\Controllers\AdminNavController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\DatesController;
use App\Http\Controllers\HukukBasvuruController;
use App\Http\Controllers\IyzicoController;
use App\Http\Controllers\RandevuController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Prices;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\PaymentController;
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

//İtems
Route::get('/legal-counseling',function(){

    $price = Prices::where('id',10)->value('price');
    $integerPrice = floor($price);

    return view('tr_law',compact('integerPrice'));
});


Route::group(['middleware' => ['web']],function(){

Route::get('/', function () {
    return view('items');
})->name('home');





Route::post('/login',[AuthController::class,'loginPost'])->name('loginPost');

Route::post('/register',[AuthController::class,'registerPost'])->name('registerPost');

Route::middleware(['auth'])->group(function(){


    //ortak routes

     // Panel Router
     Route::get('/account',[AuthController::class,'redirectToAccount']);
    // log out
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ek ödeme
Route::post('/add-new-document',[UserPanelController::class,'addNewDocument'])->name('addNewDocuments');
Route::get('/payment/doc/{sepet_id}',[PaymentController::class,'payment'])->name('docpayment');

    
    // GENELLİKLE KULLANICILARIN ERİŞECEĞİ ROUTELAR
           
   // Tüm başvuruları görüntüleme sayfası (Kullanıcı)
   Route::get('/account/aktif-basvurularim', [UserPanelController::class, 'myRequests'])->name('myRequests');
   
     // dosyaları görüntüleme
     Route::get('/download/{filename}',[AdminRequestController::class,'download'])->name('download');



   // SORU OLUŞTURMA AŞAMALARI
 // Başvuru ekranı
 Route::get('/application',[HukukBasvuruController::class,'basvuru']);
 // Başvuru oluşturma ve tür seçme
 Route::post('/createFirstRequest',[HukukBasvuruController::class,'createRequest']);

  // Şirket verilerini kayıt etme
Route::post('/send-information-data',[HukukBasvuruController::class,'saveInformation'])->name('saveCompanyInformation');


 // Soru tipini gönderme
 Route::post('/sendRequestTypes',[HukukBasvuruController::class,'sendTypes']);

 // Geri Dönüş Tipini Gönderme

 Route::post('/set-feedback-method',[HukukBasvuruController::class,'setFeedBackMethod']);

 //ödeme sayfasına gitme

 Route::get('/payment/{req_id}',[PaymentController::class,'summary'])->name('payment');

 //ödeme callback
 Route::post('/callback',[PaymentController::class,'callback'])->name('callback');
 Route::post('/document-callback',[PaymentController::class,'docCallback'])->name('document-callback');

 //Randevu Alma
 Route::get('/u', [DatesController::class, 'index'])->name('randevular.index');
 //Route::get('/randevular/create', [RandevuController::class, 'create'])->name('randevular.create');
 Route::post('/randevular', [DatesController::class, 'store'])->name('randevular.store');
 Route::get('/get-available-times', [DatesController::class, 'getAvailableTimes']);
 //general paymeny sayfasına gitme
 Route::get('/iyzico-payment/{req_id}/{invoice}',[IyzicoController::class,'summary'])->name('generalPayment');
 Route::post('/generalcallback',[IyzicoController::class,'callback'])->name('generalcallback');
    // Tüm randevuları görüntüleme sayfası (Kullanıcı)
    Route::get('/account/randevularım', [UserPanelController::class, 'showMyDates'])->name('myDates');
    // Randevu iptal
    Route::post('/cancel-date',[DatesController::class,'cancelDate']);


//abonelik
//abone ol 
Route::get('subscribe',[SubscriptionController::class,'index']);
Route::post('subscallback',[SubscriptionController::class,'callback']);

 //dosya upload
 // Step 1 Dosya yükleme (Pdf,img vs)
Route::post('/uploadFiles',[HukukBasvuruController::class,'uploadFile']); 
// Step 2 Ses Dosyası Yükleme
Route::post('/upload-audio',[HukukBasvuruController::class,'uploadAudio']);
// Step 3 Video Dosyası Yükleme
Route::post('/upload-video',[HukukBasvuruController::class,'uploadVideo']);

//Şifre değiştirme

Route::get('/bilgilerim',[UserPanelController::class,'information'])->name('information');

Route::post('/update-information',[AuthController::class,'updateInformation'])->name('update.profile');

        // Yetkili erişimi
    Route::middleware(['redirect.tier:avukat'])->group(function () {


                
   //Şifre değiştirme

Route::get('/bilgiler',[AdminNavController::class,'information'])->name('information');

Route::post('/update-information',[AuthController::class,'updateInformation'])->name('update.profile');
//AdminPanel
    //Admin Anasayfa
    Route::get('/admin',[AdminRequestController::class,'index'])->name('adminpanel');
    // Tüm başvuruları görüntüleme sayfası
    Route::get('/requests/{request}',[AdminRequestController::class,'show'])->name('requests.show');

    //admin menuitem
    Route::get('/admin/aktif_basvurular', [AdminNavController::class, 'active_requests'])->name('active_requests');

// answer the question
Route::post('/answerQuestion',[AdminRequestController::class,'answerQuestion'])->name('answer.question');
//Delete Answer
Route::delete('/answer/delete/{id}', [AdminRequestController::class, 'deleteAnswer'])->name('answer.delete');




      
    });


    // Kullanıcı Erişimi
    Route::middleware(['redirect.tier:user'])->group(function () {
      

 // UserPanel Route

    Route::get('/my-dashboard',[UserPanelController::class,'myRequests'])->name('userpanel');
         });

             // Tüm başvuruları görüntüleme sayfası
    Route::get('/basvuru/{request}',[UserPanelController::class,'show'])->name('myrequests.show');
});


//mw end
});
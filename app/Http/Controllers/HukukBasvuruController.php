<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Requests;
use Auth;
use Aws\S3\S3Client;
use App\Models\Image;
use App\Models\Company;
use App\Models\Purchases;
use App\Models\Prices;
use Illuminate\Support\Facades\Storage;


class HukukBasvuruController extends Controller
{   

    public function basvuru(){

        $user = Auth::user();
        $voice = Prices::where('id',2)->value('price');
        $video = Prices::where('id',3)->value('price');
        $call = Prices::where('id',4)->value('price');

        return view('application',compact('user','voice','video','call'));
    }

    public function createRequest(Request $request){

        $user = Auth::user();

        $request->validate([
            'type' => 'required|in:company,personal', 
        ]);
    
        if($request != null){

            

            $question = new Requests;

            $question->creator_uuid = $user->uuid;
            $question->type = $request->type;
            $question->save();
            


            //Sipariş Oluştur
            $invoiceNumber = Purchases::getNextSequence();
            $purchase = new Purchases();
            $purchase->invoice_no = $invoiceNumber;
            $purchase->request_id = $question->id;
            $purchase->user_uuid = Auth::user()->uuid;
            $purchase->save();

        }else
        {
            // Request Boş Dönüyor.
            return 'Bir Hata Oluştu | Code:10001';
        }
    
    }

    public function sendTypes(Request $request){

        $basvuru = Requests::where('creator_uuid', auth::user()->uuid)->latest()->first();
        $types = $request->input('type');
        
        //Siparişe git
        $purchase = Purchases::where('request_id',$basvuru->id)->first();

        // Seçilen checkbox değerlerine göre işlemler yap
        if (in_array('Text', $types)) {
            $basvuru->is_written = true;
        }
    
        if (in_array('Voice', $types)) {
            $basvuru->is_voiced = true;
            $purchase->voiced_price = true;
        }
    
        if (in_array('Video', $types)) {
            $basvuru->is_video = true;
            $purchase->video_price = true;
        }  
    
        $basvuru->save();
        $purchase->save();

        return response()->json(['success' => true]);
    }

    public function setFeedBackMethod(Request $request) {
        $basvuru = Requests::where('creator_uuid', auth::user()->uuid)->latest()->first();
         //Siparişe git
         $purchase = Purchases::where('request_id',$basvuru->id)->first();
         $req_id = $basvuru->id;

        if ($basvuru) { 
            if ($request->has('type')) {
                $types = $request->input('type');
                foreach ($types as $type) {
                    if ($type === 'text') { 
                        $basvuru->is_return_written = true;
                        $purchase->text_feedback_price = true;
                    } elseif ($type === 'voiced') {
                        $basvuru->is_return_called = true;
                        $purchase->voiced_feedback_price = true;
                    } elseif ($type === 'video') {
                        $basvuru->is_return_video = true;
                        $purchase->video_feedback_price = true;
                    }
                }
                $purchase->save();
                $basvuru->save();
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Başvuru bulunamadı.']);
        }


       
        return response()->json(['success' => true, 'message' => 'Başarılı route','req_id' =>$req_id]);
    }
    

    public function uploadFile(Request $request){
    
        $request->validate([
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

 
        $files = $request->file('files') ?? [];


        $basvuru = Requests::where('creator_uuid',auth::user()->uuid)->latest()->first();
        $docID = $basvuru->id;

         //Siparişe git
         $purchase = Purchases::where('request_id',$basvuru->id)->first();

        if($files){
        $totalFile = count($files);
        $purchase->document_price = $totalFile;
        $purchase->save();
        }
        $basvuru->question = $request->input('textarea');
        $basvuru->save();

        foreach($files as $file){
            $userID = auth::user()->uuid;
            $path = $file->store("files/users/user{$userID}/documents/{$docID}", 's3');
            $mimeType = $file->getClientMimeType();

  

            $images = new Image();

            $images->author = auth::user()->uuid;
            $images->doc_uuid = $basvuru->id;
            $images->visibility = 1; 
            $images->filename = basename($path);
            $images->url = Storage::disk('s3')->url($path);
         
                // Fotoğraf veya belge kontrolü
                if (strpos($mimeType, 'image') !== false) {
                 $images->filetype = 'photo';
                } elseif (strpos($mimeType, 'application/pdf') !== false || strpos($mimeType, 'application/msword') !== false) {
                   $images->filetype = 'document';
                } else {
                  // Diğer durumlar için gerekirse başka kontrol ekleyebilirsiniz.
                  $images->filetype = 'other';
                }

            $images->save();
          
        }

        return response()->json(['success' => true, 'message' => 'Dosyalar başarıyla yüklendi']);

    }


    public function uploadAudio(Request $request){

        $basvuru = Requests::where('creator_uuid',auth::user()->uuid)->latest()->first();
        $docID = $basvuru->id;

        if($request->hasFile('audio')){
            $userID = auth::user()->uuid;
            $audioFile = $request->file('audio');

            // Audio modelini kullanarak veritabanına kayıt yapabilirsiniz
            $images = new Image();

            $path = $audioFile->store("files/users/user{$userID}/audios/{$docID}",'s3');          
            $images->author = auth::user()->uuid;
            $images->doc_uuid = $basvuru->id;
            $images->filename = basename($path);
            $images->filetype = "Audio";
            $images->visibility = 1;
            $images->url = Storage::disk('s3')->url($path);
            $images->save();

            return response()->json(['message' => 'Audio uploaded successfully']);
        } else {
            return response()->json(['error' => 'No audio file provided'], 400);
        }
        }
    

        public function uploadVideo(Request $request){
            $basvuru = Requests::where('creator_uuid',auth::user()->uuid)->latest()->first();
            $docID = $basvuru->id;
        
            if($request->hasFile('video')){
                $userID = auth::user()->uuid;
                $videoFile = $request->file('video');
                $extension = $videoFile->getClientOriginalExtension();
                $fileName = "video_" . uniqid() . "." . $extension; // Benzersiz bir dosya adı oluştur
        
                $path = $videoFile->storeAs("files/users/user{$userID}/videos/{$docID}", $fileName, 's3');

               
                $images = new Image();
                $images->author = auth::user()->uuid;
                $images->doc_uuid = $basvuru->id;
                $images->filename = $fileName;
                $images->filetype = "Video";
                $images->visibility = 1;
                $images->url = Storage::disk('s3')->url($path);
                $images->save();
        
                return response()->json(['success' => true, 'message' => 'Dosya başarıyla yüklendi']);
            } else {
                return response()->json(['error' => 'No video file provided'], 400);
            }
        }
        
        


    public function show(Image $image){

        return Storage::disk('s3')->response('images/' .$image->filename);

    }


    // Şirket Verilerinin Veritabanına Kayıt Edilmesi


    public function saveInformation(Request $request){

        $userID = Auth::user()->uuid;
   
    
        $formData = $request->all();
        $file = $request->file('file_input');
        $path = $file->store("files/users/user{$userID}/company", 's3');
        $company = new Company();
        $company->auth_user = $userID;
        $company->name = $request->company_name;
        $company->phone = $request->company_mobile;
        $company->tel = $request->company_phone;
        $company->email = $request->company_email;
        $company->auth_user_position = $request->auth_position;
        $company->auth_document = basename($path);
        $company->save();
    
        return response()->json(['message' => 'İşlem başarılı'], 200);
    }
    

}

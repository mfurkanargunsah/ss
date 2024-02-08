<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Requests;
use Auth;
use Aws\S3\S3Client;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;


class HukukBasvuruController extends Controller
{   

    public function basvuru(){

        $user = Auth::user();

        return view('demo',compact('user'));
    }

    public function createRequest(Request $request){

        $user = Auth::user();

        $request->validate([
            'type' => 'required|in:company,personal', 
        ]);
    
        if($request != null){

            $basePrice = 270;

            $question = new Requests;

            $question->creator_uuid = $user->uuid;
            $question->type = $request->type;
            $question->price = $basePrice;
            $question->save();




        }else
        {
            // Request Boş Dönüyor.
            return 'Bir Hata Oluştu | Code:10001';
        }
    
    }

    public function sendTypes(Request $request){

        $basvuru = Requests::where('creator_uuid', auth::user()->uuid)->latest()->first();
        $types = $request->input('type');
        
        // Seçilen checkbox değerlerine göre işlemler yap
        if (in_array('Text', $types)) {
            $basvuru->is_written = true;
        }
    
        if (in_array('Voice', $types)) {
            $basvuru->is_voiced = true;
        }
    
        if (in_array('Video', $types)) {
            $basvuru->is_video = true;
        }  
    
        $basvuru->save();
        
        return response()->json(['success' => true]);
    }
    

    public function uploadFile(Request $request){
    
        $request->validate([
            'textarea' => 'required',
            'files.*' => 'mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $files = $request->file('files');
        //Dosya Başına Ücret, Orn: 5 * 10TL = 50TL
      

        $basvuru = Requests::where('creator_uuid',auth::user()->uuid)->latest()->first();
        $docID = $basvuru->id;

        $oldPrice = $basvuru->price;
        $totalAmount = count($files) * 10;
        $newPrice = $oldPrice + $totalAmount;

        $basvuru->question = $request->input('textarea');
        $basvuru->price = $newPrice;
        $basvuru->save();

        foreach($files as $file){
            $userID = auth::user()->uuid;
            $path = $file->store("files/users/user{$userID}/documents/{$docID}", 's3');
            $mimeType = $file->getClientMimeType();

  

            $images = new Image();

            $images->author = auth::user()->uuid;
            $images->doc_uuid = $basvuru->id;
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

        return response()->json(['message'=>'Dosyalar Başarıyla Yüklendi']);

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
    
               
                $images = new Image();
    
                $path = $videoFile->store("files/users/user{$userID}/videos/{$docID}",'s3');          
                $images->author = auth::user()->uuid;
                $images->doc_uuid = $basvuru->id;
                $images->filename = basename($path);
                $images->filetype = "Video";
                $images->url = Storage::disk('s3')->url($path);
                $images->save();
    
                return response()->json(['message' => 'Video uploaded successfully']);
            } else {
                return response()->json(['error' => 'No video file provided'], 400);
            }
            }


    public function show(Image $image){

        return Storage::disk('s3')->response('images/' .$image->filename);

    }


}

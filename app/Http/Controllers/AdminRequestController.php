<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\Image;
use App\Models\Answer;
use App\Models\AnswerFiles;
use Auth;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class AdminRequestController extends Controller
{
    

    public function index(){
        $requests = Requests::with('creator')->orderBy('id', 'desc')->paginate(20);


        return view("adminpanel.dashboard",compact('requests')); 
    }

    public function show($id){


        $detailedRequest = Requests::findOrFail($id); 
        $files = Image::where('doc_uuid',$detailedRequest->id)->get();


    
        $answers = Answer::where('request_id', $id)
        ->orderByDesc('updated_at')
        ->get();



        $fileGroups = [
            'photo' => [],
            'Video' => [],
            'Audio' => [],
            'document' => []
        ];

        foreach($files as $file){
            switch ($file->filetype) {
                case 'photo':
                    $fileGroups['photo'][] = $file;
                    break;
                case 'Video':
                    $fileGroups['Video'][] = $file;
                    break;
                case 'Audio':
                    $fileGroups['Audio'][] = $file;
                    break;
                case 'document':
                    $fileGroups['document'][] = $file;
                    break;
                default:
                  
                    break;
            }

        }

        return view('adminpanel.show_request', [
            'request' => $detailedRequest,
            'fileGroups' => $fileGroups,
            'answers' => $answers,
        ]);

    }


    public function download($filename)
    {   
        $file = Image::where('filename', $filename)->first();
    
        if (!$file) {
            abort(404); // Dosya bulunamadı hatası
        }
        
        if($file->filetype === "Video"){
            $path = "files/users/user{$file->author}/videos/{$file->doc_uuid}/$filename";
        }
        elseif($file->filetype === "Audio"){
            $path = "files/users/user{$file->author}/audios/{$file->doc_uuid}/$filename";
            }
           else{
                $path = "files/users/user{$file->author}/documents/{$file->doc_uuid}/$filename";
                }    
    
        return Storage::disk('s3')->response($path);
    }
    


    //Avukat soru cevaplama
    public function answerQuestion(Request $request)
    {   

        $request->validate([
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        try {
        // Formdan gelen verileri alıyoruz
        $files = $request->file('files');
        $userID = auth::user()->uuid;
        $request_id = $request->input('request_id');
        $title = $request->input('name');
        $category = $request->input('category');
        $message = $request->input('message');
        
        // Eğer dosya yüklendi ise
        if ($request->hasFile('files') && is_array($files)) {
            
            foreach ($files as $file) {
             
            $path = $file->store("files/avukat/users/user{$userID}/documents/{$request_id}", 's3');
   

            $answerF = new AnswerFiles();

            $answerF->answer_id = $request_id;
            $answerF->creator = $userID;
            $answerF->filename = basename($path);
            $answerF->url = Storage::disk('s3')->url($path);
            $answerF->save();
            }
          
        }

       
        
        Answer::create([
            'request_id' => $request_id,
            'title' => $title,
            'creator' => $userID,
            'category' => $category,
            'message' => $message,
        ]);


        return redirect()->back()->with('status', 'success');
    } catch (\Exception $e) {
        return redirect()->back()->with('status', 'error');
    }  
}


 public function deleteAnswer($id){

    try {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        
        return response()->json(['message' => 'Cevap başarıyla silindi']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Silme işlemi sırasında bir hata oluştu'], 500);
    }
      
 }

}   

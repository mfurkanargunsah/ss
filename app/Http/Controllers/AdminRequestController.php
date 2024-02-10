<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminRequestController extends Controller
{
    

    public function index(){
        $requests = Requests::with('creator')->orderBy('id', 'desc')->paginate(20);


        return view("adminpanel.dashboard",compact('requests')); 
    }

    public function show($id){


        $detailedRequest = Requests::findOrFail($id); 
        $files = Image::where('doc_uuid',$detailedRequest->id)->get();

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
            'fileGroups' => $fileGroups
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
    


}

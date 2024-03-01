<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Company;
use App\Models\Image;
use App\Models\Purchases;
use App\Models\Requests;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function myRequests()
    {
         $user = Auth::user();
        $userId = auth()->id(); // Aktif kullanıcının id'sini alıyoruz
        $requests = Requests::where('creator_uuid', $user->uuid)
        ->orderBy('id', 'desc')
        ->with('creator')
        ->paginate(20);
        
    
       
        return view('userpanel.my_requests', compact('requests','user'));
    }


    public function show($id){

        $detailedRequest = Requests::findOrFail($id); 
        $files = Image::where('doc_uuid',$detailedRequest->id)->get();
        $user = Auth::user();
        $company = Company::where('auth_user',$detailedRequest->creator_uuid)->first();
        $authFile = $company->auth_document;
    
        $answers = Answer::where('request_id', $id)
        ->orderByDesc('updated_at')
        ->get();

    

        return view('userpanel.show_request', [
            'request' => $detailedRequest,
            'files' => $files,
            'answers' => $answers,
            'user' => $user,
            'authFile' => $authFile,
        ]);


    }



    public function addNewDocument(Request $request)
    {   

        $request->validate([
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        try {
        // Formdan gelen veriler
        $files = $request->file('files');
        $userID = auth::user()->uuid;
        $request_id = $request->input('request_id');
        
        // Eğer dosya yüklendi ise
        if ($request->hasFile('files') && is_array($files)) {
            
            foreach ($files as $file) {
             
            $path = $file->store("files/users/user{$userID}/documents/{$request_id}", 's3');
   

            $document = new Image();
            $document->doc_uuid = $request_id;
            $document->author = $userID;
            $document->visibility = false;
            $document->filetype = "document";
            $document->filename = basename($path);
            $document->url = Storage::disk('s3')->url($path);
            $document->save();
            }

          
            $invoiceNumber = Purchases::getNextSequence();
            $purchase = new Purchases();
            $purchase->invoice_no = $invoiceNumber;
            $purchase->request_id = $document->doc_uuid;
            $purchase->user_uuid = Auth::user()->uuid;
            $totalFile = count($files);
            $purchase->document_price = $totalFile;
            $purchase->save();
            
          
        }



        return redirect()->route('docpayment',['sepet_id'=>$purchase->id]);
    } catch (\Exception $e) {
        return redirect()->back()->with('status', 'error');
    }  
}
}

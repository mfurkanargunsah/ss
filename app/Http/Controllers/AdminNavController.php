<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Requests;

class AdminNavController extends Controller
{
    public function active_requests()
    {
        $requests = Requests::with('creator')->orderBy('id', 'desc')->paginate(20);
        $user = Auth::user();

        return view('adminpanel.request_list',compact('requests','user'));
    }

    public function information(){
        $user = Auth::user();
        return view('adminpanel.admin_information',compact('user'));
    }
  
}

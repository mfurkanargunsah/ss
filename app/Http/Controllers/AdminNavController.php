<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;

class AdminNavController extends Controller
{
    public function active_requests()
    {
        $requests = Requests::with('creator')->orderBy('id', 'desc')->paginate(20);

        return view('adminpanel.request_list',compact('requests'));
    }

  
}

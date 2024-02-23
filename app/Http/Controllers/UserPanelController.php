<?php

namespace App\Http\Controllers;

use App\Models\Requests;

class UserPanelController extends Controller
{
    public function myRequests()
    {
        $userId = auth()->id(); // Aktif kullanıcının id'sini alıyoruz
        $requests = Requests::with(['creator' => function ($query) use ($userId) {
            $query->where('id', $userId); 
        }])->orderBy('id', 'desc')->paginate(20);
    
        return view('userpanel.my_requests', compact('requests'));
    }
}

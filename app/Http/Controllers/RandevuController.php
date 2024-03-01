<?php

namespace App\Http\Controllers;

use App\Models\Randevu;
use Illuminate\Http\Request;

class RandevuController extends Controller
{
    public function index()
    {
        $existingAppointments = Randevu::all();
        return view('uitest',compact('existingAppointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string'
        ]);

        // Check if appointment already exists
        $existingAppointment = Randevu::where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'This time slot is already booked. Please choose another one.');
        }

        Randevu::create([
            'date' => $request->date,
            'time' => $request->time
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
   
    }
}

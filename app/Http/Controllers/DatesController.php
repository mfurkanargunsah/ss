<?php

namespace App\Http\Controllers;

use App\Models\Dates;
use App\Models\Payment;
use App\Models\Prices;
use App\Models\Subscription;
use Auth;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class DatesController extends Controller
{

    public function index()
    {
        $start = '09:00'; // Örnek başlangıç saati
    $end = '18:00'; // Örnek bitiş saati
    $interval = '10 mins'; // Zaman aralığı

    $selectedDate = now()->format('Y-m-d'); // Örnek seçilen tarih, varsayılan olarak bugün
    $startTimes = $this->generateTimeRangeForDate($selectedDate, $start, $end, $interval);
    $endTimes = $this->generateTimeRangeForDate($selectedDate, $start, $end, $interval);

    $price = Prices::where('id',4)->first()->price;

    return view('uitest', compact('startTimes', 'endTimes','price'));
    }

    function generateTimeRangeForDate($date, $start, $end, $interval = '10 mins') {
        $startTime = new DateTime($date . ' ' . $start);
        $endTime = new DateTime($date . ' ' . $end);
        $interval = new DateInterval("PT10M");
        $timeRange = [];
        
        while ($startTime <= $endTime) {
            // Saat ve dakikayı al
            $time = $startTime->format('H:i');
    
            // Saat aralığını ekleyin
            $timeRange[] = $time;
    
            // Zaman aralığını arttırın
            $startTime->add($interval);
        }
        
        return $timeRange;
    }
    public function store(Request $request)
    {   
        $user = Auth::user();
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

       

        // Çakışma yoksa yeni randevuyu oluştur
        $randevu = new Dates();
        $randevu->user_uuid = auth()->user()->uuid;
        $randevu->date = $request->date;
        $randevu->start_time = $request->start_time;
        $randevu->end_time = $request->end_time;
   

    

        $start_time = strtotime($request->start_time);
        $end_time = strtotime($request->end_time);
        $basePrice = Prices::where('id',1)->first()->price;
        $price = Prices::where('id',4)->first()->price;
        
        // Zaman farkını dakika cinsine alma
$time_diff_minutes = round(($end_time - $start_time) / 60);
//çarpma
$result = $time_diff_minutes * $price;
$totalPrice = $result + $basePrice; 

if ($user->subs && $user->subs->status === 1) {
    $sub = Subscription::where('user_uuid', $user->uuid)->first();

    if ($sub) {
        $balance = $sub->balance;
        // Yeni balance hesaplanıyor
        $newBalance = $balance - $time_diff_minutes;
        
        // Eğer yeni balance, negatif olamazsa işlem yapılabilir
        if ($newBalance >= 0) {
            $sub->balance = $newBalance;
            $sub->save();
            $randevu->status = 1;
            $randevu->save();

            return redirect('/account/randevularım')->with('success', 'Randevu başarıyla oluşturuldu');
        } else {
            // Yeni balance negatif olduğu için işlem yapılamaz
            return redirect()->back()->with('error', 'Yetersiz bakiye');
        }
    } else {
        // Abonelik bulunamadı
        $randevu->status = 0;
        $randevu->save();   
    }
} else {
    // Abonelik yok veya durumu uygun değil
    $randevu->status = 0;
$randevu->save();   

}




        $invoiceNumber = Payment::getNextSequence();
        $payments = new Payment();
        $payments->invoice_no = $invoiceNumber;
        $payments->request_id = $randevu->id;
        $payments->user_uuid = auth()->user()->uuid;
        $payments->quantity = $time_diff_minutes;
        $payments->price = $totalPrice;
        $payments->status = 0;
        $payments->item = "Randevu Ücreti";
        $payments->ip = request()->ip();
        $payments->save();

        $inv = strval($invoiceNumber);
        return redirect()->route('generalPayment',['req_id'=>$payments->id,'invoice'=>$inv]);
    }


    public function getAvailableTimes(Request $request)
    {
        $selectedDate = $request->input('date');
        $dateRecords = Dates::where('date', $selectedDate)->where('status',1)->get();
    
        $start = '09:00'; 
        $end = '18:00'; 
    
        $interval = '10 mins'; 
    
        // Başlangıç ve bitiş saatlerinin bulunduğu zaman aralığını oluştur
        $allTimes = $this->generateTimeRangeForDate($selectedDate, $start, $end, $interval);
    
        foreach ($dateRecords as $dateRecord) {
            $startTime = $dateRecord->start_time;
            $endTime = $dateRecord->end_time;
    
            // Başlangıç ve bitiş saatlerini zaman aralığından çıkar
            $unavailableTimes = $this->generateTimeRangeForDate($selectedDate, $startTime, $endTime, $interval);
            $allTimes = array_diff($allTimes, $unavailableTimes);
        }
    
        // Dizideki her bir saat için, kendisinden sonraki 20 dakika içinde bir saat bulunup bulunmadığını kontrol et
        foreach ($allTimes as $time) {
            $twentyMinutesLater = date('H:i', strtotime($time . ' +30 minutes'));
            if (!in_array($twentyMinutesLater, $allTimes)) {
                // 20 dakika sonrası mevcut olmayan saatleri diziden çıkar
                $allTimes = array_diff($allTimes, [$time]);
            }
        }
    
        // Başlangıç ve bitiş saatlerini birleştir
        $startTimes = array_values($allTimes);
        $endTimes = array_values($allTimes);
    
        return response()->json(compact('startTimes', 'endTimes'));
    }
    

    public function cancelDate(Request $request){

        $dateID = $request->input('dateId');

        $date = Dates::findOrFail($dateID);
        $date->status = 3;
        $date->save();

        return response()->json(['success' => true]);
    }



    


    

}

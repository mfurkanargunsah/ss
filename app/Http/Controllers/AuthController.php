<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
class AuthController extends Controller
{
    public function registerPost(Request $request){

        $request->validate([
       
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'country_id' => 'required|numeric|unique:users',
            'phone' => 'required|numeric|unique:users',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'area' => 'required',
           ],
           [
            'email.unique' => 'Bu e-posta adresi zaten alınmış.',
            'country_id.numeric' => 'Kimlik no alanı bir sayı olmalıdır.',
            'country_id.unique' => 'Bu kimlik numarası zaten alınmış.'
        ]
    );

    
        $phone = $request->input('area').$request->input('phone');
        $ipAddress = $request->ip();

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone = $phone;
        $user->tier = "user";
        $user->country_id =$request->country_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->adress;
        $user->tel = $request->tel;
        $user->ip_address = $ipAddress;
    
        if ($user->save()) {
            Auth::login($user);
            return redirect()->intended('/')->with('success', 'Kayıt Başarılı');
        } else {
            return redirect()->back()->withErrors(['error' => 'Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin.']);
        }
    }

    public function login()
    {   

        if(auth()->check()){
            return redirect('/account');
        }
        
        return view('login');
    }


  

    public function loginPost(Request $request)
    {
        $credetails = [
            'email' => $request->email,
            'password'=>$request->password
        ];
                    

        if(Auth::attempt($credetails)) {

            $user = Auth::user();
            $user->update(['last_login' => now()]);

            Mail::to($request->user())->send(new WelcomeMail());
                return redirect()->intended('/');

           
        }
        return back()->with('error','E-posta yada şifre hatalı!');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }


    public function redirectToAccount()
    {
        $user = Auth::user();

        // Kullanıcının rolüne göre doğru yönlendirmeyi yap
        if ($user->tier === 'avukat') {
            return redirect()->route('adminpanel');
        } elseif ($user->tier === 'user') {
            return redirect()->route('userpanel');
        } else {
          
            return redirect('/');
        }
    }


    public function updateInformation(Request $request){
        
        $user = Auth::user();

          // Mevcut şifrenin doğruluğunu kontrol et
    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Mevcut şifre yanlış.');
        }
    }
    
      // Yeni bilgileri güncelle
      try{
      $user->name = $request->input('name', $user->name);
      $user->surname = $request->input('surname', $user->surname);
      $user->email = $request->input('email', $user->email);
      $user->country_id = $request->input('country', $user->country_id);
      $user->phone = $request->input('phone', $user->phone);
      $user->tel = $request->input('tel', $user->tel);
      $user->country = $request->input('country', $user->country_id);
      $user->city = $request->input('city', $user->city);
      $user->address = $request->input('address', $user->address);
      } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Lütfen bilgilerinizi kontrol edin');
      }


        // Yeni şifre varsa, onu güncelle
        if ($request->filled('new_password')) {
            $request->validate([
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'new_password.confirmed' => 'Yeni şifreler eşleşmiyor.',
            ]);
            
            $user->password = Hash::make($request->new_password);
        }

    $user->save();
    return redirect()->back()->with('success', 'Bilgileriniz başarıyla güncellendi.');
    }
}
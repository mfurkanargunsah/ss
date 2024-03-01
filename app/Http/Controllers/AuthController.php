<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
}
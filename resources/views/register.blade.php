<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kayıt Ol</title>
</head>
<body>
    @include('header')   


    <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->


<section class="bg-white mt-8">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl ">KAYIT OL</h1>

    </div>
</section>

<div class="max-w-2xl mx-auto">


<form action="{{route('registerPost')}}" method="POST">
@csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Ad</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Name" required>
        </div>
        <div>
            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900">Soyad</label>
            <input type="text" id="last_name" name="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Surname" required>
        </div>
      
        <div>
                <label for="last_name"  class="block mb-2 text-sm font-medium text-gray-900">Tel No</label>
            <div class="relative w-full flex items-center">
            
          
                <!-- Input Section -->
                <div class="flex items-center">
                    
                    <button id="dropdown-phone-button" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button" onclick="toggleDropdown()">
                        <!-- Dropdown button content here -->
                        <svg class="h-4 w-4 me-2" fill="none" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                            <!-- Dropdown button SVG content here -->
                            <path fill="#E30A17" d="M0 0h1200v800H0z"/>
                            <circle cx="425" cy="400" r="200" fill="#fff"/>
                            <circle cx="475" cy="400" r="160" fill="#e30a17"/>
                            <path fill="#fff" d="M583.334 400l180.901 58.779-111.804-153.885v190.212l111.804-153.885z"/>
                        </svg> +90 <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <!-- Dropdown button arrow SVG content here -->
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <input type="text" id="phone-input" name="phone" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="1234567890" required>
        
                </div>
        
                <!-- Dropdown Section -->
                <div id="dropdown-phone" class="absolute left-0 top-full z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 mt-1">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-phone-button">
                        <!-- Dropdown content here -->
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 " role="menuitem">
                                <!-- Dropdown item content here -->
                                <div class="inline-flex items-center">
                                    <svg class="h-4 w-4 me-2" fill="none" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Dropdown item SVG content here -->
                                        <path fill="#E30A17" d="M0 0h1200v800H0z"/>
                                        <circle cx="425" cy="400" r="200" fill="#fff"/>
                                        <circle cx="475" cy="400" r="160" fill="#e30a17"/>
                                        <path fill="#fff" d="M583.334 400l180.901 58.779-111.804-153.885v190.212l111.804-153.885z"/>
                                    </svg> Türkiye (+90)
                                </div>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <!-- Dropdown item content here -->
                                <div class="inline-flex items-center">
                                    <svg class="w-4 h-4 me-2" fill="none" viewBox="0 0 20 15">
                                        <!-- Dropdown item SVG content here -->
                                        <rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/></mask><g mask="url(#a)"><path fill="#262626" fill-rule="evenodd" d="M0 5.167h19.6V.5H0v4.667z" clip-rule="evenodd"/><g filter="url(#filter0_d_374_135180)"><path fill="#F01515" fill-rule="evenodd" d="M0 9.833h19.6V5.167H0v4.666z" clip-rule="evenodd"/></g><g filter="url(#filter1_d_374_135180)"><path fill="#FFD521" fill-rule="evenodd" d="M0 14.5h19.6V9.833H0V14.5z" clip-rule="evenodd"/></g></g><defs><filter id="filter0_d_374_135180" width="19.6" height="4.667" x="0" y="5.167" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/><feOffset/><feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"/><feBlend in2="BackgroundImageFix" result="effect1_dropShadow_374_135180"/><feBlend in="SourceGraphic" in2="effect1_dropShadow_374_135180" result="shape"/></filter><filter id="filter1_d_374_135180" width="19.6" height="4.667" x="0" y="9.833" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/><feOffset/><feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"/><feBlend in2="BackgroundImageFix" result="effect1_dropShadow_374_135180"/><feBlend in="SourceGraphic" in2="effect1_dropShadow_374_135180" result="shape"/></filter></defs></svg>
                                    Germany (+49)
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


         <div>
            <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900">Kimlik No</label>
            <input type="text" id="country_id" name="country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Country ID" required>
        </div>

        <div>
            <label for="country" class="block mb-2 text-sm font-medium text-gray-900">Ülke</label>
            <input type="text" id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Country" required>
        </div>
        <div>
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Şehir</label>
            <input type="text" id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City / State" required>
        </div>

        
    
    </div>
    <div class="mb-6">
        <label for="adress" class="block mb-2 text-sm font-medium text-gray-900 ">Adres</label>
        <input type="text" id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Adress" required>
    </div>

    
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">E-posta</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="e-posta@domain.com" required>
    </div> 
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Şifre</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="•••••••••" required>
    </div> 
    <div class="mb-6">
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Şifre Tekrar</label>
        <input type="password" id="confirm_password" name="re_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="•••••••••" required>
    </div> 
    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">Hata!</span> Lütfen girdiğiniz bilgilerinizi kontrol edin.
      </div>
      @endif
    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required>
        </div>
        <label for="remember" class="ms-2 text-sm font-medium text-gray-900"><a href="#" class="text-blue-600 hover:underline">Kullanım Şartları ve Koşulları</a> kabul ediyorum.</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kaydol</button>
</form>
@if($errors->any())
<br>
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="flex items-start mb-10 mt-5">
   
    <label for="remember" class=" text-sm font-medium text-gray-900">Hesabınız var mı? <a href="/giriş-yap" class="text-blue-600 hover:underline">Giriş Yapın</a></label>
</div>



</div>


    <script>
   function toggleDropdown() {
    var dropdown = document.getElementById('dropdown-phone');
    dropdown.classList.toggle('hidden');
}

function selectOption(option) {
    var selectedOptionElement = document.getElementById('selected-option');
    selectedOptionElement.textContent = option;

    
    //document.getElementById('phone-input').value = option;

    toggleDropdown(); 
}

    </script>



    @include('footer')
</body>
</html>


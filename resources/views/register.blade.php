<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kayıt Ol</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
    @include('header')   

<section class="bg-white mt-20">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl ">KAYIT OL</h1>

    </div>
</section>

<div class="max-w-2xl mx-auto">


<form action="{{route('registerPost')}}" method="POST">
@csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Ad*</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Adınız" required>
        </div>
        <div>
            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900">Soyad*</label>
            <input type="text" id="last_name" name="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Soyadınız" required>
        </div>
      
        <div>
                <label for="last_name"  class="block mb-2 text-sm font-medium text-gray-900">Tel No*</label>
            <div class="relative w-full flex items-center">
            
          
                <!-- Input Section -->
                <div class="flex items-center">
                    <select id="area" name="area" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                        <option value="+90" selected>
            
                            <span class="inline-flex items-center">
                    
                                +90
                            </span>
                        </option>
                        <option value="+49">
                            <span class="inline-flex items-center">
                                <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15">
                                    <!-- SVG içeriği buraya gelecek -->
                                </svg>
                                +49
                            </span>
                        </option>
                    </select>
                  

                    <input type="text" id="phone-input" name="phone" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="1234567890" required>
        
                </div>
    
            </div>
        </div>

        <div>
            <label for="tel" class="block mb-2 text-sm font-medium text-gray-900">Sabit Tel</label>
            <input type="text" id="tel" name="tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="">
        </div>

         <div>
            <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900">Kimlik No</label>
            <input type="text" id="country_id" name="country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="TCK">
        </div>

        <div>
            <label for="country" class="block mb-2 text-sm font-medium text-gray-900">Ülke*</label>
            <input type="text" id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ülke" required>
        </div>
        <div>
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Şehir*</label>
            <input type="text" id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Şehir / Eyalet" required>
        </div>

        <div>
            <label for="postcode" class="block mb-2 text-sm font-medium text-gray-900">Posta Kodu</label>
            <input type="text" id="postcode" name="postcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="">
        </div>
        
    
    </div>
    <div class="mb-6">
        <label for="adress" class="block mb-2 text-sm font-medium text-gray-900 ">Adres*</label>
        <input type="text" id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Adres" required>
    </div>

    
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">E-posta*</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="e-posta@domain.com" required>
    </div> 
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Şifre*</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="•••••••••" required>
    </div> 
    <div class="mb-6">
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Şifre Tekrar*</label>
        <input type="password" id="confirm_password" name="re_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="•••••••••" required>
    </div> 
    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">Hata!</span> Lütfen girdiğiniz bilgilerinizi kontrol edin.
      </div>
      @endif


  
  <!-- Main modal -->
  <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Şartlar ve Koşullar
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non ipsum quis nibh ornare lobortis. Aenean nec turpis et orci lacinia suscipit. Quisque tempor, urna in euismod elementum, purus diam rhoncus lacus, eget fermentum erat ipsum non nulla. Nunc faucibus magna vel ligula semper, at varius elit mattis. Etiam condimentum, velit eget convallis porttitor, tortor mi lacinia augue, sed faucibus libero quam a purus. Etiam accumsan ante nibh, sit amet tempus odio ultrices mattis. Maecenas tempor dui in orci pellentesque rhoncus. Fusce at convallis sapien. Nulla nibh augue, volutpat eget massa in, fermentum vestibulum sapien. Phasellus fringilla auctor rutrum. Curabitur lacus nulla, iaculis vitae elementum id, eleifend volutpat lectus. Proin at molestie quam.
                  </p>
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Vivamus velit lacus, ultrices eu lectus ac, porttitor lacinia neque. Sed a sodales mauris, eget lobortis lorem. Maecenas eu viverra augue. Integer convallis ligula et massa laoreet condimentum. Sed volutpat semper quam. Suspendisse ac blandit dolor. Morbi malesuada molestie odio, facilisis semper nibh. Fusce viverra finibus ante quis interdum. Curabitur dui nunc, ornare in mauris in, sodales tempor ligula. Proin nec mauris id mi dictum egestas. Vivamus sit amet maximus lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. </p>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kapat</button>
                 
              </div>
          </div>
      </div>
  </div>
  

    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required>
        </div>
        <label for="remember" class="ms-2 text-sm font-medium text-gray-900"><button type="button" class="text-blue-600 hover:underline" data-modal-target="default-modal" data-modal-toggle="default-modal">Kullanım Şartları ve Koşulları</button> kabul ediyorum.</label>
    </div>
    <div class="g-recaptcha mt-4 mb-5" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
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
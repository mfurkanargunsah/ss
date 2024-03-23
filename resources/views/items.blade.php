@extends('welcome')
@section('items')
@include('corousel')
<!-- Modal Container -->
<div id="myModal" class="fixed inset-0 overflow-y-auto hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <!-- Modal Background -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal Content -->
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-2xl relative z-10">
            <!-- Modal Header -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('messages.ss_welcome') }}</h2>
            </div>

            <!-- Modal Body -->
            @php
    $ss_welcome_1 = __('messages.ss_welcome_1');
    $ss_welcome_8 = __('messages.ss_welcome_8');
    $ss_welcome_9 = __('messages.ss_welcome_9');
    $click_i_want_join = __('messages.click_i_want_join');
    $to_click = __('messages.to_click');
 
@endphp
            <p class="mt-6">
                {!! str_replace(':click_i_want_join', '<span class="text-red-700" >' . $click_i_want_join . '</span>', $ss_welcome_1) !!}
            </p>
            <p class="mt-6">
                {{ __('messages.ss_welcome_2') }}
            </p>

            <p class="mt-6"> {{ __('messages.ss_welcome_3') }}</p>

            <p class="mt-6"> {{ __('messages.ss_welcome_4') }}</p>
            <p class="mt-6"> {{ __('messages.ss_welcome_5') }}</p>
            <p class="mt-6"> {{ __('messages.ss_welcome_6') }}</p>
            <p class="mt-6"> {{ __('messages.ss_welcome_7') }}</p>
            <p class="mt-6">      {!! str_replace(':to_click', '<a href="/privacy-policy" target="_blank" class="text-red-700" >' . $to_click . '</a>', $ss_welcome_8) !!}</p>
            <p class="mt-6">      {!! str_replace(':to_click', '<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-red-700" >' . $to_click . '</button>', $ss_welcome_9) !!}</p>
            <br>

            <!-- Modal Footer -->
            <div class="mt-4">
                <ul class="flex flex-col justify-end">
                    <li class="mb-2">
                        <button class="bg-green-500 text-white px-4 py-2 rounded"><a href="/application">{{ __('messages.danismak_istiyorum') }}</a></button>
                    </li>
                    <li class="mb-2">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded"><a href="/abone-ol">{{ __('messages.abone_olmak') }}</a></button>
                    </li>
                    <li class="mb-2">
                        <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">{{ __('messages.vazgectim') }}</button>
                    </li>
                
                </ul>
            </div>
              
        </div>
    </div>
</div>

<!-- Subs Modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg border border-blue-500 shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Abonelik Hakkında
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
                    {{ __('messages.subs_description') }}
                </p>
             
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kapat</button>
              
            </div>
        </div>
    </div>
</div>

 <!-- subs end -->
 <div id="services" class="container mx-auto min-h-screen mt-8 flex justify-center items-center">
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Kart 1 -->
        <a href="/legal-counseling">
        <div class="max-w-4xl bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden relative">
            <div class="relative">
                <img class="rounded-t-lg h-96 w-full object-cover" src={{ url('storage/images/ss1.jpg') }} alt="" />
                <div class="absolute inset-0 flex flex-col justify-end">
                    <div class="p-4 bg-black bg-opacity-60  hover:bg-opacity-90">
                        <h2 class="text-xl font-semibold mb-2 text-white">{{ __('items.for_tr_tittle') }}</h2>
                        <p class="text-gray-300">{{ __('items.for_tr') }} <br><span class="underline font-bold">{{ __('items.click_for_details') }}</span></p>
                    </div>
                    
                </div>
            </div>
         
        </div>
    </a>
        

        <!-- Kart 2 -->
        <a href="/legal-counseling">
        <div class="max-w-4xl bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden relative">
            <div class="relative">
                <img class="rounded-t-lg h-96 w-full object-cover" src={{ url('storage/images/ee2.jpg') }} alt="" />
                <div class="absolute inset-0 flex flex-col justify-end">
                    <div class="p-4 bg-black bg-opacity-60 hover:bg-opacity-90">
                        <h2 class="text-xl font-semibold mb-2 text-white">{{ __('items.for_eu_tittle') }}</h2>
                        <p class="text-gray-300">{{ __('items.for_eu') }}<br> <span class="underline font-bold">{{ __('items.click_for_details') }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        </a>
        <!-- Kart 3 -->
        <div class="max-w-4xl bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden relative">
            <div class="relative">
                <img class="rounded-t-lg h-96 w-full object-cover" src={{ url('storage/images/ss2.jpg') }} alt="" />
                <div class="absolute inset-0 flex flex-col justify-end">
                    <div class="p-4 bg-black bg-opacity-60 hover:bg-opacity-90">
                        <h2 class="text-xl font-semibold mb-2 text-white">{{ __('items.job_from_eu_tittle') }}</h2>
                        <p class="text-gray-300">{{ __('items.job_from_eu') }} <br> <span class="underline font-bold">{{ __('items.click_for_details') }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kart 4 -->
        <div class="max-w-4xl bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden relative">
            <div class="relative">
                <img class="rounded-t-lg h-96 w-full object-cover" src={{ url('storage/images/ee11.jpg') }} alt="" />
                <div class="absolute inset-0 flex flex-col justify-end">
                    <div class="p-4 bg-black bg-opacity-60 hover:bg-opacity-90">
                        <h2 class="text-xl font-semibold mb-2 text-white">{{ __('items.made_in_germany_tittle') }}</h2>
                        <p class="text-gray-300">{{ __('items.made_in_germany') }} <br> <span class="underline font-bold">{{ __('items.click_for_details') }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="bg-white dark:bg-gray-900 mb-8">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">

            <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-xl">
            {!! str_replace(':services', '<a href="#services" class="text-red-700">' . __('items.services') . '</a>', __('items.under_items')) !!}
        </p>
           
        </div>
    </div>
</section>
  




    <script>
        // Modal Açma
        function openDetails(){
            document.getElementById('myModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        }
        
        function openMaps(){
            window.open("https://www.google.com/maps/dir/39.8175703,32.5506095/Ertürk+%26+Ertürk+Danışmanlık+A.Ş./");
        }

        // Modal Kapatma
        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('myModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Sayfanın scroll'unu aç
        });
    </script>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const mobileMenuButton = document.getElementById("openMobileMenu");
          const mobileMenu = document.getElementById("mobileMenu");
          const closeMobileMenuButton = document.getElementById("closeMobileMenu");
    
          if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener("click", function () {
              mobileMenu.classList.toggle("hidden");
            });
          }
    
          if (closeMobileMenuButton && mobileMenu) {
            closeMobileMenuButton.addEventListener("click", function () {
              mobileMenu.classList.add("hidden");
            });
          }
        });
      </script>


@endsection

<!DOCTYPE html>
<html lang="en">
    @include('header')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/fileuploader.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Hukuk Başvurusu Yap</title>
   
</head>

<body class="bg-gray-100">
    
    <div id="stepper" class="max-w-4xl mx-auto mt-20 sm:mt-8 lg:mt-36   items-center">
        <ol class="flex items-center mb-2 w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
            <li id="step1" class="flex items-center text-blue-600 dark:text-blue-500">
               <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                   1
               </span>
               {{ __('application.application_type') }}</span>
               <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
               </svg>
           </li>
           <li id="step2" class="flex items-center">
               <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                   2
               </span>
               {{ __('application.personal_information') }} <span class="hidden sm:inline-flex sm:ms-2"></span>
               <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
               </svg>
           </li>
           <li id="step3" class="flex items-center">
               <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                   3
               </span>
               {{ __('application.application_options') }}
               <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
               </svg>
           </li>
           <li id="step3" class="flex items-center">
               <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                   4
               </span>
               {{ __('application.your_questions') }}
           </li>
       </ol>
    </div>

    <div id="main" class="max-w-4xl  h-screen items-center mx-auto">
        <div class="bg-white p-8 rounded-lg shadow-md">
            
            

         
            <!-- Step 1 Form -->
            <form id="step1Form" class="mb-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-semibold">{{ __('application.application_type') }}</h1>
                </div>
                <div class="flex justify-center items-center  mb-4">
                    <label for="question" class="mr-2">Lütfen başvuru türünüzü seçiniz:</label>
                    <select id="question" name="question"
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                        <option value="personal">{{ __('application.personal') }}</option>
                        <option value="corporate">{{ __('application.corp') }}</option>
                    </select>
                </div>
                <div class="text-center mt-8">
                    <button type="button" onclick="nextStep()" class="bg-blue-500 text-white px-6 py-2 rounded-md">{{ __('buttons.btn_forward') }}</button>
                </div>
            </form>

         


            <!-- Step 2: Personal or Corporate Information Form (Initially hidden) -->
            <form id="personalForm" class="hidden">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-semibold">{{ __('application.personal') }}</h1>
                </div>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                        <div class="w-full">
                            <label for="name"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.name') }}*</label>
                            <input type="text" disabled name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->name}}" @endif  placeholder="Adınız" required="">
                        </div>
                        <div class="w-full">
                            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.surname') }}*</label>
                            <input type="text" disabled name="surname" id="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  @if($user != null) value="{{$user->surname}}" @endif  placeholder="Soyadınız" required="">
                        </div>
                
                    

                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.e-mail') }}*</label>
                            <input type="email" disabled name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  @if($user != null) value="{{$user->email}}" @endif   placeholder="ad@domain.com" required="">
                        </div>
                    
                        <div class="w-full">
                            <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.phone') }}*</label>
                            <input type="text" disabled name="mobile" id="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  @if($user != null) value="{{$user->phone}}" @endif  placeholder="123 456 78 90" required="">
                        </div>
                        <div class="w-full">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.tel') }}</label>
                            <input type="text" disabled name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  @if($user != null) value="{{$user->phone}}" @endif  placeholder="123 456 78 90" required="">
                        </div>
                    </div>
                    <div class="p-4 mb-4 mt-8 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">{{ __('buttons.btn_forward') }}</span> {{ __('application.info_1') }}<a style="border-bottom-width:1px; border-bottom-color:#2563eb; border-bottom-style:solid;font-weight:500;" href="/bilgilerim"> {{ __('application.info_1_btn') }}</a>
                      </div>
                    <div class="text-center mt-8">
                        <button type="button" onclick="previousStep()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md mr-2">{{ __('buttons.btn_back') }}</button>
                        <button type="button" onclick="goToChoice()" class="bg-blue-500 text-white px-6 py-2 rounded-md">{{ __('buttons.btn_forward') }}</button>
                    </div>
            </form>


            <form id="corporateForm" class="hidden">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-semibold">Kurumsal Başvuru</h1>
                </div>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                        <div class="w-full">
                            <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin Ünvanı</label>
                            <input type="text" name="company_name" id="company_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123 Ltd. Şti." required="">
                        </div>
                        <div class="w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirket Yetkilisinin Adı / Soyadı</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Adınız" required="">
                        </div>
                    
                        <div class="w-full">
                            <label for="auth_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Yetkilinin Mobil Tlf. No.</label>
                            <input type="text" name="auth_mobile" id="auth_mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12345678901" required="">
                        </div>

                        <div class="w-full">
                            <label for="company_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin Mobil Tlf. No.</label>
                            <input type="phone" name="company_mobile" id="company_mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12345678901" required="">
                        </div>
                    
                        <div class="w-full">
                            <label for="auth_position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Yetkilinin Şirketteki Görevi</label>
                            <input type="text" name="auth_position" id="auth_position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Müdür" required="">
                        </div>
                        <div class="w-full">
                            <label for="company_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin Sabit Tlf. No.</label>
                            <input type="text" name="company_phone" id="company_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123 456 78 90" required="">
                        </div>
                        <div class="w-full">
                            <label for="auth_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Yetkilinin E-mail Adresi</label>
                            <input type="text" name="auth_email" id="auth_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  placeholder="ad@domain.com" required="">
                        </div>
                        <div class="w-full">
                            <label for="company_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin E-mail Adresi</label>
                            <input type="text" name="company_email" id="company_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="company@domain.com" required="">
                        </div>
                        <div class="w-full">
                        
<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Yetkilinin Yetki Belgesi</label>
<input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" name="file_input" type="file" required>

                        </div>
                    </div>
                <div class="text-center mt-8">
                    <button type="button" onclick="previousStep()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md mr-2">Geri</button>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">İleri</button>
                </div>
            </form>

        </div>
        
    </div>
      <!-- Modal -->
<div id="loadingModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Lütfen Bekleyin...</span>
    </div>
  </div>
     <!-- Step 3: Soru Sorma Yöntemi -->
     <div id="requestType" class="hidden bg-white text-center  mx-auto">

        <div class="max-w-md mx-auto text-center mt-8">
        <h2 class="text-2xl font-bold mb-12">{{ __('application.page_2_tittle') }}</h2>
      
    
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-gray-300 mb-4" role="alert">
            {{ __('application.page_2_info_1') }}
    
        </div>
        <div class="flex justify-center space-x-8">
            <ul class="w-96 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-md">
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center px-4 py-3">
                        <input id="text-checkbox" name="checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label data-tooltip-target="tooltip-default-1" for="text-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('application.page_2_ask_with_written') }}<button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                            <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                 
                                    <p>Bu seçenek seçildiğinde, danışma ücreti olan <strong>220 Euro </strong>  ödenir. İlave
                                        ücret ödenmesi gerekmez.</p>
                                   
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </label>
                        <div class="flex-grow"></div>
                        <div class="flex items-center">
                            <span class="text-sm text-red-500 dark:text-gray-400 mr-1">İlave ücret gerektirmez</span>
                        </div>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center px-4 py-3">
                        <input id="audio-checkbox" name="checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label data-tooltip-target="tooltip-default-2" for="audio-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('application.page_2_ask_with_voice') }}.<button data-popover-target="popover-sesli-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                            <div data-popover id="popover-sesli-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                
                                    <p>Bu seçenek bilgisayarınızda bir mikrofon varsa çalışır. Bilgisayarınıza bağlı bir mikrofonunuz yoksa, sesinizi bir başka yerde kaydedebilir ve bu kaydı dosya olarak burada kullanabilirsiniz.</p>
                         
                                    <p>Bu seçenek tıklandığında, danışma ücreti olan 220 euroya ilaveten, sesinizin yazıya çevrilmesi için {{$voice}} euro daha ödenmesi gerekir. ({{$voice}} euroluk bu miktar zaman içinde değiştirilmeye müsait olacaktır.)</p>
                                    <p>
                                        Konuşacağınız hususları öncelikle not almanız ve ardından kayda başlamanız çok yararlı olacaktır. Mümkün olduğu kadar tane tane konuşmalısınız. <strong> Aksi durumda dinlendiğinde anlaşılması zor olabilir ve tam olarak anlaşılabilmesi için size ilave sorular sorulmasını gerektirebilir. Bu da sorunuzun cevaplanmasını geciktirebilir. </strong></p>
                                   
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </label>
                        <div class="flex-grow"></div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400 mr-1">+{{$voice}}€</span>
                        </div>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center px-4 py-3">
                        <input id="video-checkbox" name="checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label data-tooltip-target="tooltip-default-3" for="video-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('application.page_2_ask_with_video') }}.<button data-popover-target="popover-video-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                            <div data-popover id="popover-video-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                
                                    <p>Bu seçenek bilgisayarınızda bir mikrofon ve kamera varsa çalışır. Bilgisayarınıza bağlı bir mikrofon ve kamera yoksa, ses ve görüntünüzü bir başka yerde kaydedebilir ve bu kaydı dosya olarak burada kullanabilirsiniz. Bu seçenek tıklandığında, danışma ücreti olan 220 euroya ilaveten, sesinizin yazıya çevrilmesi için {{$video}} euro daha ödenmesi gerekir. ({{$voice}} euroluk bu miktar zaman içinde değiştirilmeye müsait olacaktır.)</p>
                         
                                  
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </label>
                        <div class="flex-grow"></div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400 mr-1">+{{$video}}€</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="p-4 mb-4 mt-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            {{ __('application.page_2_info_2') }}
          </div>
        <button onclick="nextButtonClicked()" class="inline-flex items-center px-9 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
            {{ __('buttons.btn_forward') }}
        </button>

        </div>
        
        <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-4xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-xl xl:text-2xl dark:text-white">{{ __('application.page_2_tittle_2') }}</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">{{ __('application.page_2_call_info') }}</p>
                        <button data-modal-target="static-modal" data-modal-toggle="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('buttons.btn_read_more') }}
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            </button>
                    <a href="/u" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        {{ __('buttons.btn_ask_with_phone') }}
                    </a> 
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

                    <dotlottie-player src="https://lottie.host/b027b6c8-be78-4d0f-84b3-1328856ee53e/4xfwEqxxze.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                </div>                
            </div>

            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-gray-100 rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ __('application.page_2_tittle_2') }}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                {{ __('application.page_2_call_info_modal_1') }}</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                {{ __('application.page_2_call_info_modal_2') }} </p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('buttons.btn_ask_with_phone') }}</button>
                            <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('buttons.btn_close') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    
  
    
    </div>

         <!-- Step 4: Başvuru Inputları -->
         <div id="requestForms" class="hidden bg-white text-center  mx-auto mt-20 sm:mt-8 lg:mt-36">

         
        <div class="sm:hidden">
            <select id="tabs" class="bg-blue-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>{{ __('application.description') }}</option>
                <option>{{ __('application.upload_voice') }}</option>
                <option>{{ __('application.upload_video') }}</option>
              
            </select>
        </div>
                    <ul id="tabList" class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                        <li id="aciklamaTab" class="w-full" onclick="tabClicked('aciklamaTab')">
                            <a href="#"  class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" >Açıklama</a>
                        </li>
                        <li id="sesYukleTab" class="w-full" onclick="tabClicked('sesYukleTab')">
                            <a href="#" class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Ses Yükle</a>
                        </li>
                        <li id="goruntuYukleTab" class="w-full" onclick="tabClicked('goruntuYukleTab')">
                            <a href="#" class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Görüntü Yükle</a>
                        </li>
                    </ul>
        

                    <form action="#" id="step4Form">
                        @csrf
                    
                        <div id="text-input" class="sm:col-span-2 hidden mb-6 mt-10" >
                            <label for="textarea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('application.your_questions') }}</label>
                            <textarea id="textarea" rows="14" class="p-2.5 w-full  max-w-3xl text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bu alana, danışmak istediklerinizi yazabilirsiniz."></textarea>
                    
                            <div class=" max-w-3xl w-max mx-auto text-center mt-8 ">
                                <div id="alert-additional-content-4" class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
                                    <div class="flex items-center">
                                  <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                  </svg>
                                  <span class="sr-only">Info</span>
                                  <h3 class="text-lg font-medium">{{ __('application.page_3_warning_tittle') }}</h3>
                                </div>
                                <div class="mt-2 mb-4 text-sm">
                                    {{ __('application.page_3_warning_message') }}   </div>
                                <div class="flex">
                             
                        
                                </div>
                              </div>
                            </div>
        <!-- component -->
        <div class=" h-screen w-screen sm:px-8 md:px-16 sm:py-8">
            <main class="container mx-auto max-w-screen-lg h-full">
              <!-- file upload modal -->
              <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">
                <!-- overlay -->
                <div id="overlay" class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                  <i>
                    <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                    </svg>
                  </i>
                  <p class="text-lg text-blue-700">Yüklemek istediğiniz dosyaları seçin</p>
                </div>
        
                <!-- scroll area -->
                <section class="overflow-auto p-8 w-full h-full flex flex-col">
                  <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                    <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                      <span>{{ __('application.page_3_select_files') }}</span>
                    </p>
                    <input id="hidden-input" type="file" multiple class="hidden" />
                    <button id="button" type="button" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                        {{ __('application.page_3_upload_file') }}
                    </button>
                  </header>
        
                  <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                    {{ __('application.page_3_selected_files') }}
                  </h1>
        
                  <ul id="gallery" class="flex flex-1 flex-wrap -m-1"> 
                    <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
                      <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                      <span class="text-small text-gray-500">{{ __('application.page_3_empty_files') }}</span>
                    </li>
                  </ul>
                </section>
                <footer class="flex justify-end px-8 pb-8 pt-4">
                
        
                  </footer>
              </article>
            </main>
          </div>
        
          <!-- using two similar templates for simplicity in js code -->
          <template id="file-template">
            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
              <article tabindex="0" class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                <img alt="upload preview" class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />
        
                <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                  <h1 class="flex-1 group-hover:text-blue-800"></h1>
                  <div class="flex">
                    <span class="p-1 text-blue-800">
                      <i>
                        <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                        </svg>
                      </i>
                    </span>
                    <p class="p-1 size text-xs text-gray-700"></p>
                    <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                      <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                      </svg>
                    </button>
                  </div>
                </section>
              </article>
            </li>
          </template>
        
          <template id="image-template">
            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
              <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
        
                <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                  <h1 class="flex-1"></h1>
                  <div class="flex">
                    <span class="p-1">
                      <i>
                        <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                        </svg>
                      </i>
                    </span>
        
                    <p class="p-1 size text-xs"></p>
                    <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                      <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                      </svg>
                    </button>
                  </div>
                </section>
              </article>
            </li>
          </template>
        
        <script>
        const fileTempl = document.getElementById("file-template"),
        imageTempl = document.getElementById("image-template"),
        empty = document.getElementById("empty");
        
        // use to store pre selected files
        let FILES = {};
        
        // check if file is of type image and prepend the initialied
        // template to the target element
        function addFile(target, file) {
        const isImage = file.type.match("image.*"),
          objectURL = URL.createObjectURL(file);
        
        const clone = isImage
          ? imageTempl.content.cloneNode(true)
          : fileTempl.content.cloneNode(true);
        
        clone.querySelector("h1").textContent = file.name;
        clone.querySelector("li").id = objectURL;
        clone.querySelector(".delete").dataset.target = objectURL;
        clone.querySelector(".size").textContent =
          file.size > 1024
            ? file.size > 1048576
              ? Math.round(file.size / 1048576) + "mb"
              : Math.round(file.size / 1024) + "kb"
            : file.size + "b";
        
        isImage &&
          Object.assign(clone.querySelector("img"), {
            src: objectURL,
            alt: file.name
          });
        
        empty.classList.add("hidden");
        target.prepend(clone);
        
        FILES[objectURL] = file;
        }
        
        const gallery = document.getElementById("gallery"),
        overlay = document.getElementById("overlay");
        
        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
          for (const file of e.target.files) {
            if (file.type.match("image.*") || file.type.match("application/pdf") || file.type.match("application/msword")) {
              addFile(gallery, file);
            } else {
              console.log("Kabul edilmeyen dosya türü: " + file.type);
            }
          }
        };
        
        
        // use to check if a file is being dragged
        const hasFiles = ({ dataTransfer: { types = [] } }) =>
        types.indexOf("Files") > -1;
        
        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;
        
        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
        ev.preventDefault();
        for (const file of ev.dataTransfer.files) {
          addFile(gallery, file);
          overlay.classList.remove("draggedover");
          counter = 0;
        }
        }
        
        // only react to actual files being dragged
        function dragEnterHandler(e) {
        e.preventDefault();
        if (!hasFiles(e)) {
          return;
        }
        ++counter && overlay.classList.add("draggedover");
        }
        
        function dragLeaveHandler(e) {
        1 > --counter && overlay.classList.remove("draggedover");
        }
        
        function dragOverHandler(e) {
        if (hasFiles(e)) {
          e.preventDefault();
        }
        }
        
        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        gallery.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
          const ou = target.dataset.target;
          document.getElementById(ou).remove(ou);
          gallery.children.length === 1 && empty.classList.remove("hidden");
          delete FILES[ou];
        }
        };
        
   
        
        </script>
        
        <style>
        .hasImage:hover section {
        background-color: rgba(5, 5, 5, 0.4);
        }
        .hasImage:hover button:hover {
        background: rgba(5, 5, 5, 0.45);
        }
        
        #overlay p,
        i {
        opacity: 0;
        }
        
        #overlay.draggedover {
        background-color: rgba(255, 255, 255, 0.7);
        }
        #overlay.draggedover p,
        #overlay.draggedover i {
        opacity: 1;
        }
        
        .group:hover .group-hover\:text-blue-800 {
        color: #2b6cb0;
        }
        </style>
                        
                        </div>
                        <div id="loadingModal" class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
                            <div class="bg-white p-5 rounded-lg">
                       
        <div role="status">
            <p id="progressText">Please wait...</p>
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Your files uploading...</span>
        </div>
                            </div>
        
                            <div class="bg-white p-5 rounded-lg hidden">
                                <p id="progressText">Please wait...</p>
                <progress id="progressBar" value="10" max="100"></progress>
                            </div>
                          </div>
        
        
        
        
        
                          <div id="audio-input" class="sm:col-span-2 hidden mb-6">
                            <div class="text-center">
                                <h2 class="text-2xl font-bold mb-4 mt-10">{{ __('application.page_3_question_tittle') }}</h2>
                                
                                <div class="flex justify-center space-x-4 mt-3">
                                    <div class="flex items-center border border-gray-200 rounded dark:border-gray-700 p-4">
                                        <input checked id="audio-radio-1" type="radio" value="" name="audio-radio" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="audio-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('application.page_3_select_from_before') }}</label>
                                    </div>
                                    
                                    <div class="flex items-center border border-gray-200 rounded dark:border-gray-700 p-4">
                                        <input id="audio-radio-2" type="radio" value="" name="audio-radio" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="audio-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('application.page_3_new_record') }}</label>
                                    </div>
                                </div>
                                
                                <div id="audio-upload-container" class="mt-8">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="audio_input">{{ __('application.page_3_upload_voice_file') }}</label>
                                    <input class="p-2.5 w-full max-w-lg text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="audio_input" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">MP3</p>
                                </div>
                                
                                <div id="audio-items" class="mt-8">
                                    <div class="space-x-4">
                                        <button id="startRecording" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-full focus:outline-none">
                                            {{ __('application.page_3_start_record') }}
                                        </button>
                                        <button id="stopRecording" type="button" class="px-4 py-2 bg-red-500 text-white rounded-full focus:outline-none hidden">
                                            {{ __('application.page_3_stop_record') }}
                                        </button>
                                        <button id="playRecording" type="button" class="px-4 py-2 bg-green-500 text-white rounded-full focus:outline-none hidden" disabled>
                                            {{ __('application.page_3_listen') }}
                                        </button>
                                    </div>
                                    
                                    <div id="recordingStatus" class="mt-4 text-lg font-semibold"></div>
                                    
                                    <audio id="audioPlayer" class="mx-auto mt-4" controls></audio>
                                </div>
                            </div>
                        </div>
                        
        
                        <div id="video-input" class="sm:col-span-2 hidden">
        
                            <h2 class="text-xl font-bold mb-4 mt-10">{{ __('application.page_3_question_tittle') }}</h2>
                        
                            <div class="flex justify-center space-x-4 mt-3">
                                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                    <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('application.page_3_select_from_before') }}</label>
                                </div>
                            
                                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                    <input  id="bordered-radio-2" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('application.page_3_new_record') }}</label>
                                </div>
                            </div>
                            
                            
        
        
                            <div id="file-upload-container">
                                <label class="block mb-2 mt-10 text-sm font-medium text-gray-900 dark:text-white" for="video_input">{{ __('application.page_3_upload_video_file') }}</label>
                                <input class="p-2.5 w-full max-w-lg text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="video_input" type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{ __('application.page_3_upload_video_file_warning') }}</p>
                            </div>
                            
        
                            <div class="text-center mt-10" id="record-items">
                                <video id="videoPlayer" class="mx-auto mt-4" width="640" height="480" style="border: 1px solid #ccc;" autoplay muted></video>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Lütfen kayda başlamak için "Kaydı Başlat" butonuna tıklayın. </p>
                                <div id="videoSizeMessage" class="hidden mt-4">
                                    Kaydedilen video boyutu: <span id="videoSize"></span> MB
                                </div>
                                <button type="button" id="startVRecording" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline-green active:bg-green-800 transition duration-300">{{ __('application.page_3_start_record') }}</button>
                                <button type="button" id="stopVRecording" class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline-red active:bg-red-800 transition duration-300">{{ __('application.page_3_stop_record') }}</button>
                            </div>
                        
                        </div>
        
        
        
                        <button type="button" id="sendAllFiles" class="inline-flex items-center px-9 py-2.5 mt-8 mb-10 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                            İleri
                        </button>
                    </form>
        
         </div>


         <!--Geri Dönüş Seçenekleri-->
         <div id="step5" class="hidden bg-white text-center mt-8">
           
            <button class="text-green-500 mb-4">&larr; Geri</button>
            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white text-center mt-20">Size nasıl geri dönüş yapmamızı istersiniz?</h3>
            <ul class="max-w-screen-lg mx-auto grid w-full gap-6 md:grid-cols-3">
            
    <li>
        <input type="checkbox" id="react-option" value="text" class="hidden peer" required="">
        <label for="react-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
            <div class="block">
              <div class="w-full text-lg font-semibold">Yazılı Olarak</div>
                <div class="w-full text-sm">İLAVE ÜCRET
                    GEREKTİRMEZ.
                    SORULARI, TÜM
                    BAŞVURANLARA, YAZILI
                    BİR RAPOR HALİNDE
                    GÖNDERİLMEKTEDİR.</div>
            </div>
        </label>
    </li>
    <li>
        <input type="checkbox" id="flowbite-option" value="voiced" class="hidden peer">
        <label for="flowbite-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
                 <div class="w-full text-lg font-semibold">Sözlü/Sesli Olarak</div>
                <div class="w-full text-sm">BU SEÇENEĞİ İŞARETLEMENİZ HALİNDE, … EURO İLAVE ÜCRET ÖDEMENİZ GEREKECEKTİR. ŞU ANDA ÖDEMENİZ GEREKEN ÜCRET …. EURODUR.</div>
            </div>
        </label>
    </li>
    <li>
        <input type="checkbox" id="angular-option" value="video" class="hidden peer">
        <label for="angular-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
               <div class="w-full text-lg font-semibold">Görüntülü Olarak</div>
                <div class="w-full text-sm">BU SEÇENEĞİ
                    İŞARETLEMENİZ
                    HALİNDE, … EURO
                    İLAVE ÜCRET ÖDEMENİZ
                    GEREKECEKTİR. ŞU ANDA
                    ÖDEMENİZ GEREKEN
                    ÜCRET …. EURODUR.</div>
            </div>
        </label>
    </li>
</ul>

<div class="flex justify-center mt-8">
    <div id="alert-additional-content-1" class="p-4 mb-4 max-w-screen-lg text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
        <div class="flex items-center">
      <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <h3 class="text-lg font-medium">Açıklama</h3>
    </div>
    <div class="mt-2 mb-4 text-sm">
        BU SEÇENEKLERİN BU AŞAMADA, BAŞLANGIÇTA,
        SEÇİLMESİ MÜMKÜN OLDUĞU GİBİ, ÖNCE YAZILI
        RAPORUN BEKLENİP, RAPOR İNCELENDİKTEN SONRA,
        AÇIKLAMA İHTİYACI DUYULURSA İLAVE OLARAK
        SEÇİLMESİ DE MÜMKÜNDÜR. BU NEDENLE,
        BAŞLANGIÇTA SEÇİLEREK İLAVE ÜCRET ÖDEMEK
        YERİNE, YAZILI RAPOR ANLAŞILMAZ VEYA AÇIKLAMA
        İHTİYACI DUYARSANIZ, BAŞVURU NUMARANIZ İLE BU
        SAYFAYA GİREREK SEÇMENİZİ, İLAVE ÜCRETİNİ
        ÖDEMENİZİ VE RANDEVU BELİRLEMENİZİ ÖNERİRİZ.
    </div>
  
  </div>
</div>
<button onclick="goToPayment()" class="inline-flex items-center px-9 py-2.5 mb-4 sm:mb-6 lg:mb-8 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
    İleri
</button>
        </div>    
       
    <script>    


function sendDataToController(data) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        $.ajax({
            type: 'POST',
            url: '/createFirstRequest',
            data: { 
                type: data,
                _token: csrfToken  
            },
            success: function(response) {
               
                console.log(response);
            },
            error: function(error) {
               
                console.error(error);
            }
        });
    }
      

         document.getElementById('main').classList.remove('hidden');


    function nextStep() {
        const question = document.getElementById('question').value;
        if (question === 'personal') {
            document.getElementById('personalForm').classList.remove('hidden');
            document.getElementById('corporateForm').classList.add('hidden');
            sendDataToController('personal');
        } else if (question === 'corporate') {
            document.getElementById('personalForm').classList.add('hidden');
            document.getElementById('corporateForm').classList.remove('hidden');
            sendDataToController('company');
        }

        document.getElementById('step1').classList.remove('text-blue-600', 'dark:text-blue-500');
        document.getElementById('step1').classList.add('text-gray-600', 'dark:text-gray-500');
        document.getElementById('step2').classList.remove('text-gray-500', 'dark:text-gray-400');
        document.getElementById('step2').classList.add('text-blue-600', 'dark:text-blue-500');

        document.getElementById('step1Form').classList.add('hidden');

    }

        function previousStep() {
            document.getElementById('step1').classList.remove('text-gray-600', 'dark:text-gray-500');
            document.getElementById('step1').classList.add('text-blue-600', 'dark:text-blue-500');
            document.getElementById('step2').classList.remove('text-blue-600', 'dark:text-blue-500');
            document.getElementById('step2').classList.add('text-gray-500', 'dark:text-gray-400');

            document.getElementById('step1Form').classList.remove('hidden');
            document.getElementById('personalForm').classList.add('hidden');
            document.getElementById('corporateForm').classList.add('hidden');
        }



            // Kurumsal bilgilerin gönderimi
        document.getElementById('corporateForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Formun normal gönderimini engelle
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;   
  
     // Modalı aç
     document.getElementById('loadingModal').classList.remove('hidden');
    
    var formData = new FormData(this);
    fetch('/send-information-data', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken 
        },
        body: formData
    })
    .then(response => {
        document.getElementById('loadingModal').classList.add('hidden');
        if (response.ok) {
            nextToStep3();
        } else {
            
            console.error('Form gönderme hatası:', response.statusText);
      
        }
    })
    .catch(error => {
        console.error('Form gönderme hatası:', error);
        document.getElementById('loadingModal').classList.add('hidden');
    });
});

// Kişisel Bilgilerden sonra next
function goToChoice(){
    nextToStep3();
}

// Başvuru Yöntemi Ekranı
    function nextToStep3(){

        document.getElementById('requestType').classList.remove('hidden');
        document.getElementById('personalForm').classList.add('hidden');
        document.getElementById('corporateForm').classList.add('hidden');
        document.getElementById('main').classList.add('hidden');

        document.getElementById('step1').classList.remove('text-blue-600', 'dark:text-blue-500');
        document.getElementById('step1').classList.add('text-gray-600', 'dark:text-gray-500');
        document.getElementById('step2').classList.remove('text-blue-600', 'dark:text-blue-500');
        document.getElementById('step2').classList.add('text-gray-500', 'dark:text-gray-400');
        document.getElementById('step3').classList.remove('text-gray-500', 'dark:text-gray-400');
        document.getElementById('step3').classList.add('text-blue-600', 'dark:text-blue-500');
    }



const textDiv = document.getElementById('textDiv');
const audioDiv = document.getElementById('audioDiv');
const videoDiv = document.getElementById('videoDiv');


    //Başvuru Yükleme Ekranına Geçiş 

    function nextButtonClicked() {  

      // Checkbox elementlerini seç
const textCheckbox = document.getElementById('text-checkbox');
const audioCheckbox = document.getElementById('audio-checkbox');
const videoCheckbox = document.getElementById('video-checkbox');

// Controller İçin
const types = [];

if (textCheckbox.checked) {
types.push('Text');
}

if (audioCheckbox.checked) {
   
types.push('Voice');
}

if (videoCheckbox.checked) {
types.push('Video');
}

if (types.length === 0) {
    alert('Lütfen bir seçenek belirleyin!');
}else
{
// Laravel controller'a types dizisini gönder
document.getElementById('requestForms').classList.remove('hidden');
    // Ana formu gizle
    document.getElementById('requestType').classList.add('hidden');
    document.getElementById('stepper').classList.add('hidden');
sendRequestTypes(types);
}



   // Tab menüsündeki li elemanlarını varsayılan olarak gizle
   const tabList = document.getElementById('tabList');
    const tabs = tabList.getElementsByTagName('li');
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = 'none';
    }


         // Seçilen checkbox'lara göre ilgili tab'ları görünür yap
    if (videoCheckbox.checked) {
        document.getElementById('goruntuYukleTab').style.display = 'block';
        document.getElementById('goruntuYukleTab').click(); // İlk tab'ı tıkla
    }

    if (audioCheckbox.checked) {
        document.getElementById('sesYukleTab').style.display = 'block';
        document.getElementById('sesYukleTab').click(); // İlk tab'ı tıkla
    }

    if (textCheckbox.checked) {
        document.getElementById('aciklamaTab').style.display = 'block';
        document.getElementById('aciklamaTab').click(); // İlk tab'ı tıkla
    }

       // Hiçbir seçenek seçilmediyse, step4'ü gizle
       if (!textCheckbox.checked && !audioCheckbox.checked && !videoCheckbox.checked) {
        textInput.style.display = 'none';
        audioInput.style.display = 'none';
        videoInput.style.display = 'none';
         }

}


//tab'a tıklandığında çağrılır
function tabClicked(tabId) {
    // Tab'ın hangi seçeneği temsil ettiğini belirle
    var selectedOption;
    if (tabId === 'aciklamaTab') {
        selectedOption = 'text';
    } else if (tabId === 'sesYukleTab') {
        selectedOption = 'audio';
    } else if (tabId === 'goruntuYukleTab') {
        selectedOption = 'video';
    }

    // Seçilen seçeneğe göre ilgili input alanlarını görünür hale getir
    var textInput = document.getElementById('text-input');
    var audioInput = document.getElementById('audio-input');
    var videoInput = document.getElementById('video-input');

    if (selectedOption === 'text') {
        textInput.style.display = 'block';
        audioInput.style.display = 'none';
        videoInput.style.display = 'none';
    } else if (selectedOption === 'audio') {
        textInput.style.display = 'none';
        audioInput.style.display = 'block';
        videoInput.style.display = 'none';
    } else if (selectedOption === 'video') {
        textInput.style.display = 'none';
        audioInput.style.display = 'none';
        videoInput.style.display = 'block';
    }
}

// Başvuru tiplerini gönder
function sendRequestTypes(types){
    document.getElementById('loadingModal').classList.remove('hidden');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

$.ajax({
    type: 'POST',
    url: '/sendRequestTypes',
    data: { 
        type: types,
        _token: csrfToken  
    },
    success: function(response) {
        document.getElementById('loadingModal').classList.add('hidden');
        console.log(response);
    },
    error: function(error) {
        document.getElementById('loadingModal').classList.add('hidden');
        console.error(error);
    }
});
    }
    </script>

<!-- radio control -->
<script>
    // video
    var radio1 = document.getElementById('bordered-radio-1');
    var radio2 = document.getElementById('bordered-radio-2');
    var recordItems = document.getElementById('record-items');

    //  audio
    var radioA1 = document.getElementById('audio-radio-1');
    var radioA2 = document.getElementById('audio-radio-2');
    var audioItems = document.getElementById('audio-items');


    
    window.onload = function() {
        handleRadioChange();
        handleRadioAChange();
    };

    //video
    radio1.addEventListener('change', handleRadioChange);
    radio2.addEventListener('change', handleRadioChange);
    function handleRadioChange() {
        if (radio1.checked) {
            recordItems.style.display = 'none';
            document.getElementById('file-upload-container').style.display = 'block';

         
        }
        else if (radio2.checked) {
            recordItems.style.display = 'block'; 
            document.getElementById('file-upload-container').style.display = 'none';

        }
    }
    //audio
    radioA1.addEventListener('change', handleRadioAChange);
    radioA2.addEventListener('change', handleRadioAChange);
    function handleRadioAChange() {
        if (radioA1.checked) {
            audioItems.style.display = 'none'; 
            document.getElementById('audio-upload-container').style.display = 'block';

         
        }
        else if (radioA2.checked) {
            audioItems.style.display = 'block'; 
            document.getElementById('audio-upload-container').style.display = 'none';

        }
    }


    function goToPayment(){
 

    var selectedOptions = [];

    
      document.querySelectorAll('input[type="checkbox"]:checked').forEach(function(checkbox) {
        // Checkbox'un değerini alın
        var value = checkbox.value.trim();
        // Seçili seçeneği seçiliOptions dizisine ekleyin
        selectedOptions.push(value);
    });

    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    $.ajax({
    type: 'POST',
    url: '/set-feedback-method',
    data: { 
        type: selectedOptions,
        _token: csrfToken,
    },
    success: function(response) {
       
        console.log(response);
        var req_id = response.req_id;
        window.location.href = '/payment/' + req_id;
      
    },
    error: function(error) {
       
        console.error(error);
    }
});

}


</script>
   
   @include('footer') 
</body>
</html>

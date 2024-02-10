
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js','resources/js/fileuploader.js'])
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>Form Seçimi</title>
    </head>
    <body class="bg-white h-screen items-center justify-center">
        @include('header')
        <div class="flex flex-col min-h-screen">

        <div id="step1" class="flex  h-screen items-center justify-center">
            
            <div class="text-center" >
                
                <h2 class="text-2xl font-bold mb-12">Şirketiniz adına mı, kendiniz için mi başvuru mu yapmak istiyorsunuz?</h2>
                <div class="flex justify-center space-x-8"> 
                    <button id="companyBtn" data-tooltip-target="tooltip-bottom" onclick="showForm('company')" data-tooltip-placement="bottom" type="button" class="ms-3 mb-2 md:mb-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-6 py-3 text-center">Şirket</button>
                    <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Soracağınız soru, bir şirket ile ilgiliyse bu butona tıklayınız.
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                
                    <button id="personalBtn" data-tooltip-target="tooltip-bottom2" onclick="showForm('personal')" data-tooltip-placement="bottom" type="button" class="ms-3 mb-2 md:mb-0 text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-6 py-3 text-center">Kendim</button>
                    <div id="tooltip-bottom2" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Soracağınız soru, kendiniz ile ilgiliyse bu butona tıklayınız.
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                
        
            </div>
        </div>
        

        <div id="step2_1" class="hidden text-center mt-8 w-full sm:w-auto">
        
            <section class="bg-white">
                
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <button onclick="goBack('step1')" class="text-blue-500 mb-4">&larr; Geri</button>
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Şirket İçin Başvuru</h2>
                    <form action="#">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                            <div class="w-full">
                                <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin Ünvanı</label>
                                <input type="text" name="company_name" id="company_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123 Ltd. Şti." required="">
                            </div>
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirket Yetkilisinin Adı / Soyadı</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->name. " " .$user->surname}}" @endif placeholder="Adınız" required="">
                            </div>
                        
                            <div class="w-full">
                                <label for="auth_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Yetkilinin Mobil Tlf. No.</label>
                                <input type="text" name="auth_mobile" id="auth_mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->phone}}" @endif placeholder="12345678901" required="">
                            </div>

                            <div class="w-full">
                                <label for="company_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin Mobil Tlf. No.</label>
                                <input type="email" name="company_mobile" id="company_mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12345678901" required="">
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
                                <input type="text" name="auth_email" id="auth_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->email}}" @endif placeholder="ad@domain.com" required="">
                            </div>
                            <div class="w-full">
                                <label for="company_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Şirketin E-mail Adresi</label>
                                <input type="text" name="company_email" id="company_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="company@domain.com" required="">
                            </div>
                            <div class="w-full">
                            
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Yetkilinin Yetki Belgesi</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">

                            </div>
                        </div>

                      
                    
                        <button type="button" id="nextFromCompany" onclick="dataForm()" class="inline-flex items-center px-9 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                            İleri
                        </button>
                        
                        
                        
                        
                        
                    </form>
                </div>
            </section>
        </div>

        <div id="step2_2" class="hidden text-center mt-8">
        

            <section class="bg-white dark:bg-gray-900">
                
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <button onclick="goBack('step1')" class="text-green-500 mb-4">&larr; Geri</button>
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Kişisel Başvuru</h2>
                    <form action="#">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ad</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->name}}" @endif placeholder="Adınız" required="">
                            </div>
                            <div class="w-full">
                                <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Soyad</label>
                                <input type="text" name="surname" id="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->surname}}" @endif placeholder="Soyadınız" required="">
                            </div>
                    
                        

                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->email}}" @endif placeholder="ad@domain.com" required="">
                            </div>
                        
                            <div class="w-full">
                                <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cep Telefonu</label>
                                <input type="text" name="mobile" id="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @if($user != null) value="{{$user->phone}}" @endif placeholder="123 456 78 90" required="">
                            </div>
                            <div class="w-full">
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sabit Telefon</label>
                                <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123 456 78 90" required="">
                            </div>
                        </div>

                      

                

                        <button type="button" id="nextFromPersonal" onclick="dataForm()" class="inline-flex items-center px-9 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800" >
                            İleri
                        </button>
                    </form>
                
                </div>
            </section>
    
        </div>

        <div id="step3" class="hidden text-center mt-8  mx-auto">

            <div class="max-w-md mx-auto text-center mt-8 ">
            <button onclick="goBack('step1')" class="text-green-500 mb-4">&larr; Geri</button>
            <h2 class="text-2xl font-bold mb-12">Sorunuzu hangi yöntemle sormak istiyorsunuz?</h2>
        
            <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 mb-4" role="alert">
                Danışmak istediğiniz soruyu en kolay biçimde sormanız için, seçenekler oluşturduk: dilerseniz, yazabilirsiniz.
                Dilerseniz, konuşabilirsiniz ve sesinizi kaydedebilirsiniz. Dilerseniz, görüntülü olarak kayıt yaparak bu sayfaya
                yükleyebilirsiniz.
            </div>


    
        




        
            <div class="flex justify-center space-x-8">
                <ul class="w-96 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-md">
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center px-4 py-3">
                            <input id="text-checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label data-tooltip-target="tooltip-default-1" for="text-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Yazılı olarak sormak istiyorum.<button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
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
                                <span class="text-sm text-gray-600 dark:text-gray-400 mr-1">-</span>
                            </div>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center px-4 py-3">
                            <input id="audio-checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label data-tooltip-target="tooltip-default-2" for="audio-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Sesli olarak sormak istiyorum.<button data-popover-target="popover-sesli-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                                <div data-popover id="popover-sesli-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                    
                                        <p>Bu seçenek bilgisayarınızda bir mikrofon varsa çalışır. Bilgisayarınıza bağlı bir mikrofonunuz yoksa, sesinizi bir başka yerde kaydedebilir ve bu kaydı dosya olarak burada kullanabilirsiniz.</p>
                             
                                        <p>Bu seçenek tıklandığında, danışma ücreti olan 220 euroya ilaveten, sesinizin yazıya çevrilmesi için 30 euro daha ödenmesi gerekir. (30 euroluk bu miktar zaman içinde değiştirilmeye müsait olacaktır.)</p>
                                        <p>
                                            Konuşacağınız hususları öncelikle not almanız ve ardından kayda başlamanız çok yararlı olacaktır. Mümkün olduğu kadar tane tane konuşmalısınız. <strong> Aksi durumda dinlendiğinde anlaşılması zor olabilir ve tam olarak anlaşılabilmesi için size ilave sorular sorulmasını gerektirebilir. Bu da sorunuzun cevaplanmasını geciktirebilir. </strong></p>
                                       
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </label>
                            <div class="flex-grow"></div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400 mr-1">+30€</span>
                            </div>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center px-4 py-3">
                            <input id="video-checkbox" type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label data-tooltip-target="tooltip-default-3" for="video-checkbox" class="w-full ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Görüntülü olarak sormak istiyorum.<button data-popover-target="popover-video-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                                <div data-popover id="popover-video-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                    
                                        <p>Bu seçenek bilgisayarınızda bir mikrofon ve kamera varsa çalışır. Bilgisayarınıza bağlı bir mikrofon ve kamera yoksa, ses ve görüntünüzü bir başka yerde kaydedebilir ve bu kaydı dosya olarak burada kullanabilirsiniz. Bu seçenek tıklandığında, danışma ücreti olan 220 euroya ilaveten, sesinizin yazıya çevrilmesi için 30 euro daha ödenmesi gerekir. (30 euroluk bu miktar zaman içinde değiştirilmeye müsait olacaktır.)</p>
                             
                                      
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </label>
                            <div class="flex-grow"></div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400 mr-1">+20€</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <button onclick="nextButtonClicked()" class="inline-flex items-center px-9 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
                İleri
            </button>

            </div>
            
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <h1 class="max-w-4xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-xl xl:text-2xl dark:text-white">Sorunuzun bir görevlimiz tarafından yazılmasını isterseniz, bu da mümkündür.</h1>
                        <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Bu durumda, telefonla
                            Merkezimizi arayabilirsiniz ve sorunuz, bir görevlimiz tarafından kayıt altına alınır ve sorunuzun doğru anlaşılıp
                            anlaşılmadığını kontrol etmeniz için e-mail ile size gönderilir veya dilerseniz size okunur ve onayınız ardından
                            süreç devam ettirilir. Ancak bu yöntemde sorunuzu kayıt altına alan avukatın kullandığı zamana mukabil, bir
                            ödeme yapmanız gerekecektir. Bunun için, aşağıdaki takvimden randevu oluşturabilirsiniz. O gün ve saatte, +90
                            312 490 70 17 nolu telefonu aradığınızda, konuyu anlatacağınız bir avukat karşınızda olacaktır.</p>
                            <button data-modal-target="static-modal" data-modal-toggle="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Devamını Oku
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                </button>
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                           Telefonla Sormak İstiyorum
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
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Sorunuzun bir görevlimiz tarafından yazılmasını isterseniz, bu da mümkündür.
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
                                    Bu durumda, telefonla
                                    Merkezimizi arayabilirsiniz ve sorunuz, bir görevlimiz tarafından kayıt altına alınır ve sorunuzun doğru anlaşılıp
                                    anlaşılmadığını kontrol etmeniz için e-mail ile size gönderilir veya dilerseniz size okunur ve onayınız ardından
                                    süreç devam ettirilir. Ancak bu yöntemde sorunuzu kayıt altına alan avukatın kullandığı zamana mukabil, bir
                                    ödeme yapmanız gerekecektir. Bunun için, aşağıdaki takvimden randevu oluşturabilirsiniz. O gün ve saatte, +90
                                    312 490 70 17 nolu telefonu aradığınızda, konuyu anlatacağınız bir avukat karşınızda olacaktır. Bunun için
                                    rezervasyonun ardından, talep ettiğiniz zaman için belirlenen ücreti ödemiş olmanız gereklidir. Aşağıdaki
                                    takvimde işaretleyeceğiniz zamana göre belirlenecek ücret her bir dakika için 1,5 Eurodur. Rezervasyonunuz,
                                    10’ar dakikalık dilimler halinde yapılır. Anlatımınızın ne kadar sürebileceği hususuyla ilgili bir tahminde
                                    bulunarak, gerçekçi bir süre belirlemenizi öneririz. Çünkü bu süre dolduğunda, otomatik sayaç, hattı kesecektir.
                                    Hat kesildiğinde sorunuzun yazılmasını tamamlamış olmanız önemlidir. Bu yüzden, mümkünse, tahmin ettiğiniz
                                    zamandan bir 10 dakika daha fazlası için rezervasyon yapmanızı öneririz. Çünkü avukatınızın muhtemel soruları
                                    olabilir ve bunlara cevap vermek için de bir miktar zaman harcayabilirsiniz. Avukatınız, yalnızca sorunuzu
                                    yazacaktır. Size cevap verme yetkisini haiz değildir. Şirketimiz, verilecek cevaplar konusunda son derece
                                    hassastır ve bu hizmeti mükemmelen vermek amacıyla, çok tecrübeli avukatların bilgilerinden yararlanır.
                                    Sorularınızı kayıt altına alma işini genç avukatları aracılığıyla ifa etmektedir ve bu avukatların soruları cevaplama
                                    yetkileri kesinlikle yoktur.  </p>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    Tamamen sizin rahat edeceğiniz biçimde sormanız, bizim için uygundur. Aşağıdakilerden birisini seçebileceğiniz
                                    gibi, aynı anda ikisini veya üçünü de seçebilirsiniz. Bu aşamada bir tanesini seçmiş olsanız bile daha sonra diğer
                                    yöntemleri de ilave edebilirsiniz seçebilirsiniz. Bu yüzden ilave ücret ödemeyi gerektiren seçenekler yerine yazılı
                                    soru seçeneğini kullanıp, ihtiyaç duymanız halinde daha sonra diğerlerini seçmeniz daha az ödeme yapmanız
                                    bakımından daha uygun olacaktır.  </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Telefonla Sormak İstiyorum</button>
                                <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        
      
        
        </div>



        <div id="step4" class="hidden text-center mt-8">

            <button onclick="goBack('step3')" class="text-green-500 mb-4">&larr; Geri</button>


        <div class="sm:hidden">
    <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option>Açıklama</option>
        <option>Ses Yükle</option>
        <option>Görüntü Yükle</option>
      
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
                    <label for="textarea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sorunuz</label>
                    <textarea id="textarea" rows="14" class="p-2.5 w-full  max-w-3xl text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bu alana, danışmak istediklerinizi yazabilirsiniz."></textarea>
            
                    <div class=" max-w-3xl w-max mx-auto text-center mt-8 ">
                        <div id="alert-additional-content-4" class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
                            <div class="flex items-center">
                          <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                          </svg>
                          <span class="sr-only">Info</span>
                          <h3 class="text-lg font-medium">Belge Yükleme</h3>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                            Bu bölümde, sorunuza ilişkin belgeleri sisteme yüklemelisiniz. Sorunuzu cevaplayabilmek için gereken
                            belgelerin neler olduğu hususunda bir fikrinizin olmadığı bir durumda, herhangi bir belge yüklemenize gerek
                            yoktur; sorunuzu inceleyen avukatımız, sizinle temasa geçerek, gerekli belgeleri bildirecek ve sisteme
                            yüklemenizi isteyecektir. O aşamada, bu sayfaya gelerek yüklemeyi yapabilirsiniz.
                            Hemen yüklemeniz, incelemenizin bir an önce sonuçlanarak raporunuzun tarafınıza ulaştırılmasını
                            sağlayacağından, mutlaka gerekli olduğunu düşündüğünüz belgeler varsa onları yükleyiniz.
                            Yüklediğiniz her sayfa avukatımızın incelemesi için belirli bir zamanını alacağından, sayfa başına ilave bir ücret
                            doğacağını unutmayınız. Bu yüzden yalnızca gereken belgeleri yükleyiniz ve gerekli olmayanları <strong> kesinlikle </strong>
                            yüklemeyiniz. Bu kapsamda, gerekli olduğundan emin olmadığınız sayfaları bu aşamada yüklemeyiniz.    </div>
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
              <span>Yüklemek istediğiniz dosyaları buraya sürükleyin</span>
            </p>
            <input id="hidden-input" type="file" multiple class="hidden" />
            <button id="button" type="button" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
              Dosya Yükle
            </button>
          </header>

          <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
           Seçilen Dosyalar
          </h1>

          <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
            <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
              <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
              <span class="text-small text-gray-500">Hiç bir dosya seçilmedi.</span>
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
  addFile(gallery, file);
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


// clear entire selection
document.getElementById("cancel").onclick = () => {
while (gallery.children.length > 0) {
  gallery.lastChild.remove();
};



FILES = {};
empty.classList.remove("hidden");
gallery.append(empty);
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
    <p id="progressText">Lütfen bekleyin...</p>
    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>
    <span class="sr-only">Dosyalarınız Yükleniyor...</span>
</div>
                    </div>

                    <div class="bg-white p-5 rounded-lg hidden">
                        <p id="progressText">Dosyalarınız yükleniyor. Lütfen bekleyin.</p>
        <progress id="progressBar" value="10" max="100"></progress>
                    </div>
                  </div>





                <div id="audio-input" class="sm:col-span-2 hidden mb-6 ">
                  
                      

                    <div class="text-center">
                
                        <h2 class="text-xl font-bold mb-4 mt-10">Lütfen hangi yöntem ile ses yüklemek istediğinizi seçiniz.</h2>
                       
                          
                        
                        <div class="flex justify-center space-x-4 mt-3">
                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                <input checked id="audio-radio-1" type="radio" value="" name="audio-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="audio-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Önceden kayıt ettiğim dosyayı yüklemek istiyorum</label>
                            </div>
                        
                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                <input  id="audio-radio-2" type="radio" value="" name="audio-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="audio-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yeni kayıt almak istiyorum</label>
                            </div>
                        </div>

                        <div id="audio-upload-container" class="mt-8">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="audio_input">Ses Dosyası Yükle</label>
                            <input class="p-2.5 w-full max-w-lg  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="audio_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">MP3</p>
                        </div>

                        <div id="audio-items" class="mt-8">
                        <div class="space-x-4" >
                            <button id="startRecording" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-full focus:outline-none">
                                Kaydı Başlat
                            </button>
                            <button id="stopRecording" type="button" class="px-4 py-2 bg-red-500 text-white rounded-full focus:outline-none hidden">
                                Durdur
                            </button>
                            <button id="playRecording" type="button" class="px-4 py-2 bg-green-500 text-white rounded-full focus:outline-none hidden" disabled>
                                Dinle
                            </button>
                        </div>
                
                        <div id="recordingStatus" class="mt-4 text-lg font-semibold"></div>
                
                        <audio id="audioPlayer" class="mx-auto mt-4" controls></audio>
                        </div>

                    </div>


                </div>

                <div id="video-input" class="sm:col-span-2 hidden">

                    <h2 class="text-xl font-bold mb-4 mt-10">Lütfen hangi yöntem ile görüntü yüklemek istediğinizi seçiniz.</h2>
                
                    <div class="flex justify-center space-x-4 mt-3">
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Önceden kayıt ettiğim dosyayı yüklemek istiyorum</label>
                        </div>
                    
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input  id="bordered-radio-2" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yeni kayıt almak istiyorum</label>
                        </div>
                    </div>
                    
                    


                    <div id="file-upload-container">
                        <label class="block mb-2 mt-10 text-sm font-medium text-gray-900 dark:text-white" for="video_input">Görüntü Dosyası Yükle</label>
                        <input class="p-2.5 w-full max-w-lg text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="video_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Yalnızca MP4 ve AVI formatındaki dosyaları yükleyebilirsiniz.</p>
                    </div>
                    

                    <div class="text-center mt-10" id="record-items">
                        <video id="videoPlayer" class="mx-auto mt-4" width="640" height="480" style="border: 1px solid #ccc;" autoplay muted></video>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Lütfen kayda başlamak için "Kaydı Başlat" butonuna tıklayın. </p>
                        <button type="button" id="startVRecording" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline-green active:bg-green-800 transition duration-300">Kaydı Başlat</button>
                        <button type="button" id="stopVRecording" class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline-red active:bg-red-800 transition duration-300">Durdur</button>
                    </div>
                
                </div>



                <button type="button" id="sendAllFiles" class="inline-flex items-center px-9 py-2.5 mt-8 mb-10 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    İleri
                </button>
            </form>

        </div>
    

        <div id="step5" class="hidden text-center mt-8">

            <button onclick="goBack('step4')" class="text-green-500 mb-4">&larr; Geri</button>


           
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
<button onclick="goToPayment()" class="inline-flex items-center px-9 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
    İleri
</button>
        </div>    


        <div id="step6" class="hidden text-center mt-8">

            <button onclick="goBack('step5')" class="text-green-500 mb-4">&larr; Geri</button>
    


<div class="w-full mx-auto max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Tahakkuk Eden Ücret</h5>
      
   </div>
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                  
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                          Temel Ücret
                        </p>
                      
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        €220
                    </div>
                </div>
            </li>
           
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                  
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                          Video Yükleme
                        </p>
                      
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        €30
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                  
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                         Sesli/Sözlü Geri Dönüş
                        </p>
                      
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        €20
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                  
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                         Belge Yükleme 4X
                        </p>
                      
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        €60
                    </div>
                </div>
            </li>
        </ul>
   </div>
</div>


        </div>

    <script>



        function showForm(type) {
            const step1 = document.getElementById('step1');
            const step2_1 = document.getElementById('step2_1');
            const step2_2 = document.getElementById('step2_2');
            const step5 = document.getElementById('step5');
          
    

            if (type === 'company') {
                step1.classList.add('hidden');
                step2_1.classList.remove('hidden');
                step2_2.classList.add('hidden');
                sendDataToController('company');
            } else if (type === 'personal') {
                step1.classList.add('hidden');
                step2_1.classList.add('hidden');
                step2_2.classList.remove('hidden');
                sendDataToController('personal');
            }
        }

        function dataForm(){
            const step3 = document.getElementById('step3');

            step2_1.classList.add('hidden');
            step2_2.classList.add('hidden');
            step3.classList.remove('hidden');

            
        }

    

        function toggleButton() {
            console.log("toggleButton çalıştı");
            var checkbox = document.getElementById('def-checkbox');
            var button = document.getElementById('nextFromPersonal');

            // Checkbox işaretli ise, butonu tıklanabilir hale getir
            if (checkbox.checked) {
                button.removeAttribute('disabled');
            } else {
                // Checkbox işaretli değilse, butonu devre dışı bırak
                button.setAttribute('disabled', 'true');
            }
        }

        function enableButton() {
            toggleButton(); // Checkbox durumuna göre butonu güncelle
        }


        function goBack(step) {
            const step1 = document.getElementById('step1');
            const step2_1 = document.getElementById('step2_1');
            const step2_2 = document.getElementById('step2_2');
            const step3 = document.getElementById('step3');
            const step4 = document.getElementById('step4');
            const step5 = document.getElementById('step5');
            const step6 = document.getElementById('step6');

            if (step === 'step1') {
                step1.classList.remove('hidden');
                step2_1.classList.add('hidden');
                step2_2.classList.add('hidden');
                step3.classList.add('hidden');
            }
            if (step === 'step3') {
                step1.classList.add('hidden');
                step2_1.classList.add('hidden');
                step2_2.classList.add('hidden');
                step3.classList.remove('hidden');
                step4.classList.add('hidden');
            }
            if (step === 'step4') {
                step1.classList.add('hidden');
                step2_1.classList.add('hidden');
                step2_2.classList.add('hidden');
                step3.classList.add('hidden');  
                 step5.classList.add('hidden');
                step4.classList.remove('hidden');
            }
            if (step === 'step5') {
                step1.classList.add('hidden');
                step2_1.classList.add('hidden');
                step2_2.classList.add('hidden');
                step3.classList.add('hidden');  
                 step5.classList.add('hidden');
                step4.classList.add('hidden');
                step6.classList.remove('hidden');
            }
        }



        function nextButtonClicked() {

      

    const step3 = document.getElementById('step3');
    const step4 = document.getElementById('step4');

    step3.classList.add('hidden');
    step4.classList.remove('hidden');

          // Checkbox elementlerini seç
    const textCheckbox = document.getElementById('text-checkbox');
    const audioCheckbox = document.getElementById('audio-checkbox');
    const videoCheckbox = document.getElementById('video-checkbox');

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

// Laravel controller'a types dizisini gönder
sendRequestTypes(types);

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


function goToPayment(){
   /* const step5 = document.getElementById('step5');
    const step6 = document.getElementById('step6');

    step5.classList.add('hidden');
    step6.classList.remove('hidden'); */

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
        _token: csrfToken  
    },
    success: function(response) {
       
        console.log(response);
       // setTimeout(function() {
   // window.location.href = "/admin"; 
//}, 2000); // 2 saniye
    },
    error: function(error) {
       
        console.error(error);
    }
});

}



// Bu fonksiyon, tab'a tıklandığında çağrılır
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

</script>

<!-- Başvuru Oluşturma İşlemleri -->
<script>
    function sendRequestTypes(types){
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

$.ajax({
    type: 'POST',
    url: '/sendRequestTypes',
    data: { 
        type: types,
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
</script>


@include('footer')
        </div>
</body>
</html>

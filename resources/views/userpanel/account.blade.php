<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yönetim Paneli | Anasayfa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
       
      <nav class="bg-white border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    
      
          <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <div class="w-20 h-20 bg-cover bg-center  overflow-hidden">
              <img src="{{ url('storage/images/ss_logo.png') }}" alt="Schloss Schaumburg Logo"  class="w-full h-full object-cover" />
            </div>
              <span class="self-center text-2xl font-semibold whitespace-nowrap">Schloss Schaumburg GmbH</span>
          </a>
          <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-multi-level" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
              </svg>
          </button>
          <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
              <li>
                <a href="/" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0">{{ __('messages.home')}}</a>
              </li>
            
            
              </li>
              <li>
                <a href="/contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">{{ __('messages.contact')}}</a>
              </li>
              <li>
                <a href="/account" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">{{ __('messages.account')}}</a>
              </li>
              <li> 
           <!-- component -->
    
      <div class="flex flex-row items-center right-1 ">
        <button id="deButton" class="p-2 flex flex-row items-center border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                        >
                            <span class="text-md">De</span>
                            <span class="ml-1"> <img src="data:image/png;base64,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" class="w-5 h-5" /></span>
                        </button>
    
        <button id="trButton" class="p-2 flex flex-row items-center border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:bg-gray-200 focus:outline-none "
                        >
                            <span class="text-md">Tr</span>
                             <span class="ml-1"> <img src="https://img.icons8.com/?size=512&id=7PhX5XSLeDb9&format=png" class="w-5 h-5" /></span>
                        </button>
      </div>
    
    
            
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <!-- Sidebar -->
    
        <aside
          class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
          aria-label="Sidenav"
          id="drawer-navigation"
        >
          <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <form action="#" method="GET" class="md:hidden mb-2">
              <label for="sidebar-search" class="sr-only">Search</label>
              <div class="relative">
                <div
                  class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                >
                  <svg
                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    ></path>
                  </svg>
                </div>
                <input
                  type="text"
                  name="search"
                  id="sidebar-search"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  placeholder="Search"
                />
              </div>
            </form>
            <ul class="space-y-2">
              <li>
                <a
                  href="/my-dashboard"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                >
                  <svg
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                  </svg>
                  <span class="ml-3">{{ __('messages.home') }}</span>
                </a>
              </li>
              <li>
                <button
                  type="button"
                  class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-pages"
                  data-collapse-toggle="dropdown-pages"
                >
                  <svg
                    aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap"
                    >{{ __('messages.side_applications') }}</span
                  >
                  <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </button>
                <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                  <li>
                    <a
                        href="/application"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.new_application') }}</a
                     
                    >
                  </li>
                  <li>
                    <a
                        href="/account/aktif-basvurularim"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.active_applications') }}</a
                     
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.closed_applications') }}</a
                    >
                  </li>
                
                </ul>
              </li>
          
              <li>
                <button
                  type="button"
                  class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-randevu"
                  data-collapse-toggle="dropdown-randevu"
                >
                  <svg
                    aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap"
                    >{{ __('messages.dates') }}</span
                  >
                  <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </button>
                <ul id="dropdown-randevu" class="hidden py-2 space-y-2">
                  <li>
                    <a
                        href="/u"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.new_dates') }}</a
                     
                    >
                  </li>
                  <li>
                    <a
                        href="/account/randevularım"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.my_dates') }}</a
                     
                    >
                  </li>
               
                
                </ul>
              </li>
              <li>
                <button
                  type="button"
                  class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-authentication"
                  data-collapse-toggle="dropdown-authentication"
                >
                  <svg
                    aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap"
                    >{{ __('messages.security') }}</span
                  >
                  <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </button>
                <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                
                  <li>
                    <a
                      href="/bilgilerim"
                      class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                      >{{ __('messages.my_account') }}</a
                    >
                  </li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST" class="fixed-bottom-right">
                      @csrf
                      <button type="submit" class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        {{ __('messages.logout') }}
                      </button>
                  </form>
              
                  </li>
                </ul>
              </li>
            </ul>
           
          <div
            class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20"
          >
        
        
            <div
              id="tooltip-settings"
              role="tooltip"
              class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
            >
              Settings page
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
    
          </div>
        </aside>
    
        <main class="p-4 md:ml-64 h-auto pt-20">
    
          <div
            class=" rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
          >
          

<!-- Session Dialog Modal -->
<div id="successModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="relative w-full max-w-md mx-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow-lg">
     
      <div class="p-4 text-center">
        <div class="w-12 h-12 rounded-full bg-green-100 p-2 flex items-center justify-center mx-auto mb-3.5">
          <svg aria-hidden="true" class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Success</span>
        </div>
        <p id="successMessage" class="mb-4 text-lg font-semibold text-gray-900"></p>
        <button data-modal-toggle="successModal" id="successButton" type="button" class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300">
          {{ __('buttons.ok') }}
        </button>
      </div>
    </div>
  </div>
</div>


       
          
          @yield('basvurularim')
          @yield('randevularım')
          @yield('request')
          @yield('password')

     
    
          </div>
          
        </main>
        
      </div>
    

      <script>
     
     document.addEventListener('DOMContentLoaded', function () {
    var successModal = document.getElementById('successModal');
    var successMessage = document.getElementById('successMessage');

    // Modalı açan buton
    var openModalButton = document.getElementById('successButton');

    // Modalı kapatma işlevi
    function closeModal() {
      successModal.classList.add('hidden');
    }

    // Modalı açma işlevi
    function openModal(message) {
      successMessage.textContent = message;
      successModal.classList.remove('hidden');
    }

    // Modal dışına tıklanınca modalı kapatma
    successModal.addEventListener('click', function (event) {
      if (event.target === successModal) {
        closeModal();
      }
    });

    // Tamam butonuna basıldığında modalı kapatma
    openModalButton.addEventListener('click', function () {
      closeModal();
    });

    // Sessiondan gelen mesajı modal içine yazdırma
    var sessionMessage = "<?php echo session('success'); ?>";
    if (sessionMessage) {
      openModal(sessionMessage);
    }
  });


        </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const deButton = document.querySelector("#deButton");
        const trButton = document.querySelector("#trButton");
    
        // Almanca butonuna tıklandığında
        deButton.addEventListener("click", function() {
            changeLanguage("de");
        });
    
        // Türkçe butonuna tıklandığında
        trButton.addEventListener("click", function() {
            changeLanguage("tr");
        });
    
        // Dil değiştirme fonksiyonu
        function changeLanguage(language) {
            // Ajax isteği gönder
            fetch("/change-language", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ language: language })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Bir hata oluştu.");
                }
                // Sayfayı yeniden yükle
                location.reload();
            })
            .catch(error => {
                console.error("Hata:", error);
            });
        }
    });
    
    </script>
</body>
</html>


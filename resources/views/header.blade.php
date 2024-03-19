@vite(['resources/css/app.css','resources/js/app.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


<header class="bg-white fixed top-0 w-full z-50">
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
  
</header>

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


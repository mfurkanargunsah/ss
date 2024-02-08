
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schloss Schaumburg</title>

</head>

<body>
  @include('header')
      

  <section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <a href="#" class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 " role="alert">
            <span class="text-xs bg-primary-600 rounded-full text-black px-4 py-1.5 mr-3"></span> <span class="text-sm font-medium">Duyuru Satırı</span> 
            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </a>
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl ">Danışma Merkezi</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 ">Lorem Ipsum Dolor Sit</p>
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
           
           
        </div>
       
    </div>
</section>

      
<!-- Modal Container -->
<div id="myModal" class="fixed inset-0 overflow-y-auto hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <!-- Modal Background -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal Content -->
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-2xl relative z-10">
            <!-- Modal Header -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Hoş Geldiniz.</h2>
            </div>

            <!-- Modal Body -->
            <p class="mt-6">
                Sorunuzun yazılacağı kutuya gelmeden önce, sisteme dair bazı açıklamalar yapmak isteriz. Daha
                öncesinde bu açıklamaları incelediyseniz, tekraren incelemeden, aşağıda “danışmak istiyorum.”
                Butonuna tıklayarak, doğrudan sonraki sayfaya geçebilirsiniz.
            </p>
            <p class="mt-6">
                Her bir işlemin ne şekilde yapılacağı, ilgili bölümde ayrıntılı olarak açıklanmıştır. Eğer bu hususlara vakıfsanız bu
açıklamaları okumanız gerekmez. Ama ilk kez yapacaksanız, öncelikle açıklamaları dikkatle okumanızı ve
istenilenleri harfiyen yerine getirmenizi öneririz.
            </p>

            <p class="mt-6">Bu sistem, danışmak istediğiniz konularda size detaylı rapor hazırlanması amacıyla faaliyet göstermektedir.
                Danışma, bir ücret ödenmesini gerektirir.</p>

            <p class="mt-6">Konuyla ilgili olarak incelenmesini istediğiniz belgeleri ekleyebilirsiniz. Bu durumda her bir sayfa başına ilave bir
                ücret ödemeniz gerekir. Bu nedenle gereksiz olduğunu düşündüğünüz belgeleri sisteme yüklemeyiniz. Tereddüt
                ederseniz, yüklememeyi seçiniz. Çünkü müracaatınız alındığında, başvurunuzla ilgili bir ön inceleme yapılacak
                ve incelemenin sağlıklı yapılabilmesi için gerekli evraklar belirlenecek ve hangi evrakların eksik olduğu size
                bildirilecektir. Bu bildirimin ardından yükleyebilirsiniz. Ancak mutlaka gerekli olduğunu düşündüğünüz belgeleri
                yüklemeniz, başvurunuzun daha hızlı biçimde raporlanmasına katkı sağlayabilecektir.</p>
            <p class="mt-6">Bir sonraki sayfada, sorunuzu yazabilir, konuşabilir veya görüntü yükleyebilirsiniz. Bunları kolayca yapabilmeniz
                için veri girişiniz mümkün olabildiği kadar kolaylaştırılmıştır.</p>
            <p class="mt-6">Sorunuzun cevaplanması için katkı sağlayacağınızı düşündüğünüz tüm belgeleri lütfen yanınızda bulundurunuz
                ve ilgili yere yükleyiniz.</p>
            <p class="mt-6">Soracağınız hiçbir soru, anlatacağınız hiçbir sorun veya vereceğiniz/göndereceğiniz hiçbir belge, hiçbir nedenle,
                bu danışma faaliyeti dışında kullanılmaz. Bunların korunması Şirketimiz sorumluluğu ve ahlak anlayışı
                çerçevesinde, en önemli önceliklerimizdendir. Bu husustaki aydınlatma metnini incelemek için tıklayınız.</p>
            <p class="mt-6">Eğer sormak istediğiniz hususlar, uzun süreli olarak devam edecek gibi görünen sorunlar ise, daha uygun bir
                maliyetle, telefonla danışmak isterseniz, aşağıdaki butonlardan “Abone olmak istiyorum.” butonunu
                seçebilirsiniz. Bu durumda, her ay, ayda 4 saat süreyle danışabilirsiniz ve bunun için yalnızca 2 temel ücret
                ödersiniz. Kullanmadığınız saatler, izleyen aya devredilir veya 4 saatten fazla süre kullanmak isterseniz, izleyen
                ay kontenjanından avans olarak kullanabilirsiniz. Abonelik ücretleri, 6’şar aylık periyotlarda peşin olarak ödenir
                ve kullanım durumu, ekstrelerle tarafınıza bildirilir.Kullanabileceğiniz sürelerin, 6 aydan daha önce dolması
                halinde, yeniden abone olmanız gerekir.</p>
            <p class="mt-6">Bu açıklamalardan sonra, danışmak istediğiniz hususla ilgili sayfanın açılmasını istiyorsanız, DANIŞMAK
                İSTİYORUM butonuna tıklayınız.</p>
                <br>

            <!-- Modal Footer -->
            <div class="flex justify-end mt-4">
                <button class="bg-green-500 text-white px-4 py-2 ml-2 rounded">  <a href="/demo">DANIŞMAK İSTİYORUM</a></button>
                <button id="closeModal" class="bg-red-500 text-white px-4 py-2 ml-2 rounded">DANIŞMAKTAN VAZGEÇTİM</button>
                <button class="bg-yellow-500 text-white px-4 py-2 ml-2 rounded">ABONE OLMAK İSTİYORUM</button>
            </div>
        </div>
    </div>
</div>


<div class="container mx-auto min-h-screen flex justify-center items-center">
    <div class="grid grid-cols-2 gap-4">
 
      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow relative">
        <a href="#" class="relative block">
            <img class="rounded-t-lg" src="https://www.eventsimschloss.de/templates/yootheme/cache/b9/schloss-innenhof-01-klein-b9c9b607.jpeg" alt="" />
        
            <div class="absolute bottom-4 right-4 text-white bg-gray-800 p-2 rounded-md">
                <!-- Add your address bar content here -->
                Adres Satırı, Almanya
            </div>
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Türkiye'deki hukuki sorunlarınız için Almanya merkezimize bekliyoruz.</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700"></p>
            <a id="openModal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Detaylar
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div> 
   
    
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow relative">
        <a href="#" class="relative block">
            <img class="rounded-t-lg" src="https://www.eventsimschloss.de/templates/yootheme/cache/b9/schloss-innenhof-01-klein-b9c9b607.jpeg" alt="" />
        
            <div class="absolute bottom-4 right-4 text-white bg-gray-800 p-2 rounded-md">
                <!-- Add your address bar content here -->
                Adres Satırı, Türkiye
            </div>
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Almanya'da işe yerleşmek için Türkiye ofisimize bekliyoruz</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700"></p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Detaylar
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div> 
       

    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow relative">
        <a href="#" class="relative block">
            <img class="rounded-t-lg" src="https://www.eventsimschloss.de/templates/yootheme/cache/b9/schloss-innenhof-01-klein-b9c9b607.jpeg" alt="" />
        
            <div class="absolute bottom-4 right-4 text-white bg-gray-800 p-2 rounded-md">
                <!-- Add your address bar content here -->
                Adres Satırı, Almanya
            </div>
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Türkiye'deki hukuki sorunlarınız için Almanya merkezimize bekliyoruz.</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700"></p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Detaylar
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div> 
    
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow relative">
        <a href="#" class="relative block">
            <img class="rounded-t-lg" src="https://www.eventsimschloss.de/templates/yootheme/cache/b9/schloss-innenhof-01-klein-b9c9b607.jpeg" alt="" />
        
            <div class="absolute bottom-4 right-4 text-white bg-gray-800 p-2 rounded-md">
                <!-- Add your address bar content here -->
                Adres Satırı, Almanya
            </div>
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Türkiye'deki hukuki sorunlarınız için Almanya merkezimize bekliyoruz.</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700"></p>
            <a  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Detaylar
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div> 
        </div>
    </div>
 








       
      



     @include('footer')
    
    
  

    <script>
        // Modal Açma
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('myModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Sayfanın scroll'unu kapat
        });

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



</body>
</html>


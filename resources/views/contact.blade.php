@extends('welcome')
@section('contact')
<div class=" mt-24">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Bize Ulaşın</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Yaşadığınız sorun ya da görüş hakkında bizimle iletişime geçebilirsiniz. Ekibimiz en kısa sürede size ulaşacaktır.</p>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">E-Posta</label>
                    <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="ad@mail.com" required>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Konu</label>
                    <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Mesajınız</label>
                    <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mesajınızı yazınız..."></textarea>
                </div>
                <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Gönder</button>
         
            </form>
        </div>
      </section>
      
      <section class="bg-gray-100 dark:bg-gray-800 py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <div>
                  <h3 class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">İletişim Bilgileri</h3>
                  <ul class="space-y-4">
                      <li>
                          <p class="text-gray-700 dark:text-gray-300"><strong>Telefon:</strong> +1234567890</p>
                      </li>
                      <li>
                          <p class="text-gray-700 dark:text-gray-300"><strong>E-posta:</strong> info@schlossschaumburg.com</p>
                      </li>
                      <li>
                          <p class="text-gray-700 dark:text-gray-300"><strong>Adres:</strong> 123 Main Street, City, Almanya</p>
                      </li>
                  </ul>
              </div>
              <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2546.470530351223!2d7.974850976550705!3d50.339128671571146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bdd3f9b0c07857%3A0x9b48de429a9c4c9b!2sSchaumburg%20Castle%2C%20Rhineland-Palatinate!5e0!3m2!1str!2str!4v1707781055244!5m2!1str!2str" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          </div>
      </section>
</div>


    
@endsection
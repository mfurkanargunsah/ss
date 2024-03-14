@extends('welcome')
@section('subs')



<script src="https://cdn.tailwindcss.com"></script>

<!-- component -->
<div class='flex min-h-screen pt-[100px] px-[20px]'>
    <div class="min-w-full">
      
 
      <!--Checkout ve Ödeme-->
      <div class="mt-28 lg:mt28 sm:mt8">
        <div class="bg-gray-100 h-screen py-8">
            <div id="checkoutform" class="container mx-auto px-4"  >
                <h1 class="text-2xl font-semibold mb-4 text-center ">Ödemeyi Tamamla</h1>
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-3/4">
                        <div class="bg-white rounded-lg shadow-md p-6  overflow-x-auto max-w-4xl mx-auto">
                          
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Hizmet Adı
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Periyod
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                           Ücret 
                                        </th>
                                        <th>
                                         Toplam
                                        </th>    
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                
                                        
  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Abonelik
                                        </th>
                                        <td class="px-6 py-4">
                                            <p>6 Ay</p>
                                        </td>
                                        <td class="px-6 py-4">
                                   
                                                <p>{{ $totalPrice}}€</p>
                                      
                                        </td>
                                        <td class="px-6 py-4">
                                            <p>{{ $totalPrice}}€</p>
                                        </td>
                                    </tr>
                              
                        
                              
                          
                            
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="md:w-1/4">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-semibold mb-4">Sipariş Özeti</h2>
                            <div class="flex justify-between mb-2">
                                <span>Ara Toplam</span>
                                <span>€{{ $totalPrice }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>KDV (%19)</span>
                                <span>€{{number_format ($onlykdv,2) }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Toplam</span>
                                <span class="font-semibold">€{{number_format ($finalPrice,2 )}}</span>
                            </div>
                            <button id="checkout" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                  
                        </div>
                    </div>
                </div>
            </div>   
            <div id="iyzipay-checkout-form" class="responsive hidden"></div>
            {!! $paymentinput !!}
        </div>

       </div>
    @include('footer')

    <script>
        document.getElementById("checkout").addEventListener("click", function() {
    var checkOutForm = document.getElementById("checkoutform");
    var paymentForm = document.getElementById("iyzipay-checkout-form");
  
      checkOutForm.classList.add("hidden");
      paymentForm.classList.remove("hidden");
    
});
    </script>   
            
    </div>
 </div>


@endsection
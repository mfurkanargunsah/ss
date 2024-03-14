<!DOCTYPE html>
@include('header')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ödeme Yap</title>
</head>
<body>
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
                                            Adet
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
                                          Temel Ücret
                                        </th>
                                        <td class="px-6 py-4">
                                            <p>1</p>
                                        </td>
                                        <td class="px-6 py-4">
                                   
                                                <p>{{ $basePrice->price}}€</p>
                                      
                                        </td>
                                        <td class="px-6 py-4">
                                            <p>{{ $basePrice->price}}€</p>
                                        </td>
                                    </tr>
                              
                        
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Sesli Başvuru
                                        </th>
                                        <td class="px-6 py-4">
                                            <p>{{ $payment->quantity}}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                        
                                                <p>{{ $calledPrice->price}}€</p>
                                      
                                        </td>
                                        <td class="px-6 py-4">
                                            <p>{{ number_format($payment->quantity * $calledPrice->price, 2) }}€</p>

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
                                <span>KDV (%20)</span>
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
</body>
</html>
           
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
                <h1 class="text-2xl font-semibold mb-4 text-center ">Başvuruyu Tamamla</h1>
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
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if($purchase->voiced_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Sesli Başvuru
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 2)
                                                <p>{{ $price->price }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                                    @if($purchase->video_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Görüntülü Başvuru
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 3)
                                                <p>{{ $price->price }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                                    @if($purchase->document_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Belge Yükleme
                                        </th>
                                        <td class="px-6 py-4">
                                            <p>{{ $purchase->document_price }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 9)
                                            @php
                                             $tPrice = $price->price   * $purchase->document_price;
                                            @endphp
                                                <p>{{ $tPrice }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                                    @if($purchase->text_feedback_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Yazılı Dönüş
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 5)
                                                <p>{{ $price->price }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                                    @if($purchase->voiced_feedback_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Sesli Dönüş
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 6)
                                                <p>{{ $price->price }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                                    @if($purchase->video_feedback_price)
                                        
                                  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                          Görüntülü Dönüş
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($prices as $price)
                                            @if($price->id == 7)
                                                <p>{{ $price->price }}</p>
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                         
                                        </td>
                                    </tr>
                                    @endif
                            
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
                                <span>€{{ $onlykdv }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Toplam</span>
                                <span class="font-semibold">€{{ $finalPrice }}</span>
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
           
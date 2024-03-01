<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Purchases;
use App\Models\Prices;
use App\Models\Requests;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;


use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Request\RetrieveCheckoutFormRequest;
use Iyzipay\Model\CheckoutForm;

class PaymentController extends Controller
{
    
    public function payment($sepet_id){

        

        $purchase = Purchases::where('id',$sepet_id)->first();
        $prices = Prices::all();    
        $user = Auth::user();
        $totalPrice = 0;
       
        foreach($prices as $price) {
        
            if ($purchase->document_price && $price->id == 9) {
                $totalPrice += $price->price * $purchase->document_price;
            }
      
        }
            $kdv = 0.20;
            $onlykdv = $totalPrice * $kdv;
            $finalPrice = $totalPrice + $onlykdv;


            $options = new Options();
            $options->setApiKey('sandbox-JMlIUPFaV297L3eovXOcQzN2jeSTQsNs');
            $options->setSecretKey('sandbox-iO56Uv12CQBFCIVZoQxZec8EZewhZwsw');
            $options->setBaseUrl('https://sandbox-api.iyzipay.com');
      
           $request = new CreateCheckoutFormInitializeRequest();
           $request->setLocale(Locale::TR);
           $request->setConversationId($purchase->invoice_no);
           $request->setPrice($finalPrice);
           $request->setPaidPrice($finalPrice);
           $request->setCurrency(Currency::EUR);
           $request->setBasketId($purchase->id);
           $request->setPaymentGroup(PaymentGroup::PRODUCT);
           $request->setCallbackUrl("http://127.0.0.1:8001/document-callback");
           $request->setEnabledInstallments(array(1));
      
           $buyer = new Buyer();
           $buyer->setId($user->uuid);
           $buyer->setName($user->name);
           $buyer->setSurname($user->surname);
           $buyer->setGsmNumber($user->phone);
           $buyer->setEmail($user->email);
           $buyer->setIdentityNumber($user->country_id);
           $buyer->setLastLoginDate("2015-10-05 12:43:35");
           $buyer->setRegistrationDate("2013-04-21 15:12:09");
           $buyer->setRegistrationAddress($user->address);
           $buyer->setIp($user->ip_address);
           $buyer->setCity($user->city);
           $buyer->setCountry($user->country);
           $buyer->setZipCode("34732");
           $request->setBuyer($buyer);
      
           $shippingAddress = new Address();
           $shippingAddress->setContactName($user->name ." ". $user->surname);
           $shippingAddress->setCity($user->city);
           $shippingAddress->setCountry($user->country);
           $shippingAddress->setAddress($user->address);
           $shippingAddress->setZipCode("34742");
           $request->setShippingAddress($shippingAddress);
      
           $billingAddress = new Address();
           $billingAddress->setContactName($user->name ." ". $user->surname);
           $billingAddress->setCity($user->city);
           $billingAddress->setCountry($user->country);
           $billingAddress->setAddress($user->address);
           $billingAddress->setZipCode("34742");
           $request->setBillingAddress($billingAddress);
      
           $basketItems = array();
           $firstBasketItem = new BasketItem();
           $firstBasketItem->setId("1");
           $firstBasketItem->setName("Başvuru Bedeli");
           $firstBasketItem->setCategory1("Hizmetler");
           $firstBasketItem->setCategory2("Hukuk Başvurusu");
           $firstBasketItem->setItemType(BasketItemType::VIRTUAL);
           $firstBasketItem->setPrice($finalPrice);
           $basketItems[0] = $firstBasketItem;
           $request->setBasketItems($basketItems);

           $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
           $paymentinput = $checkoutFormInitialize->getCheckoutFormContent();
              
           return view('docpayment',compact('purchase','prices','totalPrice','onlykdv','finalPrice','paymentinput'));

    }
   
    public function summary($req_id){

        $purchase = Purchases::where('request_id',$req_id)->first();
        $prices = Prices::all();
        $user = Auth::user();

        $totalPrice = 0;
        foreach($prices as $price) {
            if ($purchase->base_price && $price->id == 1) {
                $totalPrice += $price->price;
            }
            if ($purchase->voiced_price && $price->id == 2) {
                $totalPrice += $price->price;
            }
            if ($purchase->video_price && $price->id == 3) {
                $totalPrice += $price->price;
            }
            if ($purchase->document_price && $price->id == 9) {
                $totalPrice += $price->price * $purchase->document_price;
            }
            if ($purchase->text_feedback_price && $price->id == 5) {
                $totalPrice += $price->price;
            }
            if ($purchase->voiced_feedback_price && $price->id == 6) {
                $totalPrice += $price->price;
            }
            if ($purchase->video_feedback_price && $price->id == 7) {
                $totalPrice += $price->price;
            }
        }
        $kdv = 0.20;
        $onlykdv = $totalPrice * $kdv;
        $finalPrice = $totalPrice + $onlykdv;
        //Vergi ekle
         



        $options = new Options();
      $options->setApiKey('sandbox-JMlIUPFaV297L3eovXOcQzN2jeSTQsNs');
      $options->setSecretKey('sandbox-iO56Uv12CQBFCIVZoQxZec8EZewhZwsw');
      $options->setBaseUrl('https://sandbox-api.iyzipay.com');

     $request = new CreateCheckoutFormInitializeRequest();
     $request->setLocale(Locale::TR);
     $request->setConversationId($purchase->invoice_no);
     $request->setPrice($finalPrice);
     $request->setPaidPrice($finalPrice);
     $request->setCurrency(Currency::EUR);
     $request->setBasketId($purchase->id);
     $request->setPaymentGroup(PaymentGroup::PRODUCT);
     $request->setCallbackUrl("http://127.0.0.1:8001/callback");
     $request->setEnabledInstallments(array(1));

     $buyer = new Buyer();
     $buyer->setId($user->uuid);
     $buyer->setName($user->name);
     $buyer->setSurname($user->surname);
     $buyer->setGsmNumber($user->phone);
     $buyer->setEmail($user->email);
     $buyer->setIdentityNumber($user->country_id);
     $buyer->setLastLoginDate("2015-10-05 12:43:35");
     $buyer->setRegistrationDate("2013-04-21 15:12:09");
     $buyer->setRegistrationAddress($user->address);
     $buyer->setIp($user->ip_address);
     $buyer->setCity($user->city);
     $buyer->setCountry($user->country);
     $buyer->setZipCode("34732");
     $request->setBuyer($buyer);

     $shippingAddress = new Address();
     $shippingAddress->setContactName($user->name ." ". $user->surname);
     $shippingAddress->setCity($user->city);
     $shippingAddress->setCountry($user->country);
     $shippingAddress->setAddress($user->address);
     $shippingAddress->setZipCode("34742");
     $request->setShippingAddress($shippingAddress);

     $billingAddress = new Address();
     $billingAddress->setContactName($user->name ." ". $user->surname);
     $billingAddress->setCity($user->city);
     $billingAddress->setCountry($user->country);
     $billingAddress->setAddress($user->address);
     $billingAddress->setZipCode("34742");
     $request->setBillingAddress($billingAddress);

     $basketItems = array();
     $firstBasketItem = new BasketItem();
     $firstBasketItem->setId("1");
     $firstBasketItem->setName("Başvuru Bedeli");
     $firstBasketItem->setCategory1("Hizmetler");
     $firstBasketItem->setCategory2("Hukuk Başvurusu");
     $firstBasketItem->setItemType(BasketItemType::VIRTUAL);
     $firstBasketItem->setPrice($finalPrice);
     $basketItems[0] = $firstBasketItem;
     $request->setBasketItems($basketItems);

   /*  $secondBasketItem = new BasketItem();
     $secondBasketItem->setId("BI102");
     $secondBasketItem->setName("Game code");
     $secondBasketItem->setCategory1("Game");
     $secondBasketItem->setCategory2("Online Game Items");
     $secondBasketItem->setItemType(BasketItemType::VIRTUAL);
     $secondBasketItem->setPrice("0.5");
     $basketItems[1] = $secondBasketItem;

     $thirdBasketItem = new BasketItem();
     $thirdBasketItem->setId("BI103");
     $thirdBasketItem->setName("Usb");
     $thirdBasketItem->setCategory1("Electronics");
     $thirdBasketItem->setCategory2("Usb / Cable");
     $thirdBasketItem->setItemType(BasketItemType::VIRTUAL);
     $thirdBasketItem->setPrice("0.2");
     $basketItems[2] = $thirdBasketItem;
    
     */
    

     $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
     $paymentinput = $checkoutFormInitialize->getCheckoutFormContent();
        
        return view('checkout',compact('purchase','prices','totalPrice','onlykdv','finalPrice','paymentinput'));
    }



    public function callback(Request $request){

       
        $options = new Options();
        $options->setApiKey('sandbox-JMlIUPFaV297L3eovXOcQzN2jeSTQsNs');
        $options->setSecretKey('sandbox-iO56Uv12CQBFCIVZoQxZec8EZewhZwsw');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');
   

        $request1 = request();
        $token = $request1->get('token');
    
        # create request class
        $request = new RetrieveCheckoutFormRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId("123456789");
        $request->setToken($token);
  
        # make request
        $checkoutForm = CheckoutForm::retrieve($request, $options);

        $control2 = $checkoutForm->getBasketId();

        # print result

        //It gives the status of operation. Result will be success or failure.
        $status1 = $checkoutForm->getStatus();

        //It gives the status of payment operation.
        //Result will be SUCCESS, FAILURE, INIT_THREEDS, CALLBACK_THREEDS, BKM_POS_SELECTED, CALLBACK_PECCO
        $status2 = $checkoutForm->getPaymentStatus();

        //If the process has been failed, this will show us error message
        $status3 = $checkoutForm->getErrorMessage();

 

        //Unic ID value for payment
        $paymentId = $checkoutForm->getPaymentId();
        $iyizicoFee = $checkoutForm->getIyziCommissionFee();
        $iyizico = $checkoutForm->getIyziCommissionRateAmount();

        $invoice = $request->getConversationId();
       

        //installment information about payment. Current values; 1, 2, 3, 6, 9. You can ask for 12.
        $taksit = $checkoutForm->getInstallment();

        if($status1 == "success")
        {
            if($status2 == "SUCCESS")
            {
                
                $purchases = Purchases::where("id", $control2)->first();
                $basvuru = Requests::where("id",$purchases->request_id)->first();

                $purchases->status = "Ödeme Tamamlandı";
                $basvuru->status = "İşlem Bekleniyor";
                $purchases->save();
                $basvuru->save();
                
                
                //TO DO WHAT YOU NEED 
                return redirect()->route('userpanel')->with('success','Ödeme Başarılı');
                
            }
            else
            {
                return view('payment.fail', compact('status3'));
            }
        }
        else
        {
            return view('payment.fail', compact('status3'));
        }

    }

    // EK dosya callback

    public function docCallback(Request $request){

       
        $options = new Options();
        $options->setApiKey('sandbox-JMlIUPFaV297L3eovXOcQzN2jeSTQsNs');
        $options->setSecretKey('sandbox-iO56Uv12CQBFCIVZoQxZec8EZewhZwsw');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');
   

        $request1 = request();
        $token = $request1->get('token');
    
        # create request class
        $request = new RetrieveCheckoutFormRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId("123456789");
        $request->setToken($token);
  
        # make request
        $checkoutForm = CheckoutForm::retrieve($request, $options);

        $control2 = $checkoutForm->getBasketId();

        # print result

        //It gives the status of operation. Result will be success or failure.
        $status1 = $checkoutForm->getStatus();

        //It gives the status of payment operation.
        //Result will be SUCCESS, FAILURE, INIT_THREEDS, CALLBACK_THREEDS, BKM_POS_SELECTED, CALLBACK_PECCO
        $status2 = $checkoutForm->getPaymentStatus();

        //If the process has been failed, this will show us error message
        $status3 = $checkoutForm->getErrorMessage();

 

        //Unic ID value for payment
        $paymentId = $checkoutForm->getPaymentId();
        $iyizicoFee = $checkoutForm->getIyziCommissionFee();
        $iyizico = $checkoutForm->getIyziCommissionRateAmount();

        $invoice = $request->getConversationId();
       

        //installment information about payment. Current values; 1, 2, 3, 6, 9. You can ask for 12.
        $taksit = $checkoutForm->getInstallment();

        if($status1 == "success")
        {
            if($status2 == "SUCCESS")
            {
                
                $purchases = Purchases::where("id", $control2)->first();
                $purchases->status = "Ödeme Tamamlandı";
                $purchases->save();
                $filesize = $purchases->document_price;
                
                $files = Image::where("doc_uuid", $purchases->request_id)
                ->orderBy('created_at', 'desc') 
                ->limit(2)
                ->get();

                foreach($files as $file){

                    $file->visibility = 1;
                    $file->save();
                }
            
                
                //TO DO WHAT YOU NEED 
                return redirect()->route('userpanel')->with('success','Ödeme Başarılı');
                
            }
            else
            {
                return view('payment.fail', compact('status3'));
            }
        }
        else
        {
            return view('payment.fail', compact('status3'));
        }

        }


}




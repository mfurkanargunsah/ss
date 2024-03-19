<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Prices;
use App\Models\Subscription;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;



use App\Models\Dates;
use App\Models\Image;

use App\Models\Purchases;

use App\Models\Requests;
use App\Models\User;



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

class SubscriptionController extends Controller
{
    public function index(){

        $user = Auth::user();

        $price = Prices::where('id',10)->first();
        
       
        $invoiceNumber = Payment::getNextSequence();
        
        $payments = new Payment();
        $payments->invoice_no = $invoiceNumber;
        $payments->request_id = "subscription";
        $payments->user_uuid = $user->uuid;
        $payments->quantity = 1;
        $payments->price = $price->price;
        $payments->status = 0;
        $payments->item = "Abonelik Ücreti";
        $payments->ip = request()->ip();
        $payments->save();
        

      
        $totalPrice = $price->price;
      
        $kdv = 0.19;
        $onlykdv = $totalPrice * $kdv;
        $finalPrice = $totalPrice + $onlykdv;
        //Vergi ekle
         



        $options = new Options();
      $options->setApiKey('sandbox-JMlIUPFaV297L3eovXOcQzN2jeSTQsNs');
      $options->setSecretKey('sandbox-iO56Uv12CQBFCIVZoQxZec8EZewhZwsw');
      $options->setBaseUrl('https://sandbox-api.iyzipay.com');

     $request = new CreateCheckoutFormInitializeRequest();
     $request->setLocale(Locale::TR);
     $request->setConversationId($payments->invoice_no);
     $request->setPrice($finalPrice);
     $request->setPaidPrice($finalPrice);
     $request->setCurrency(Currency::EUR);
     $request->setBasketId($payments->id);
     $request->setPaymentGroup(PaymentGroup::PRODUCT);
     $request->setCallbackUrl("http://127.0.0.1:8001/subscallback");
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
     $buyer->setZipCode("null");
     $request->setBuyer($buyer);

     $shippingAddress = new Address();
     $shippingAddress->setContactName($user->name ." ". $user->surname);
     $shippingAddress->setCity($user->city);
     $shippingAddress->setCountry($user->country);
     $shippingAddress->setAddress($user->address);
     $shippingAddress->setZipCode("null");
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
     $firstBasketItem->setName("Abonelik Ücreti");
     $firstBasketItem->setCategory1("Abonelik");
     $firstBasketItem->setCategory2("Abonelik");
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
        
        return view('subscription',compact('payments','totalPrice','onlykdv','finalPrice','paymentinput','totalPrice'));
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
                
                $payment = Payment::where("id", $control2)->first();
         

                $payment->status = 1;
                $payment->save();

                $startDate = Carbon::now();
                $endDate = $startDate->copy()->addMonths(6);
                $userId = auth()->user()->uuid;
           
                $subs = new Subscription();
                $subs->user_uuid = $userId;
                $subs->start_date = $startDate;
                $subs->end_date = $endDate;
                $subs->balance = 1440;
                $subs->status = 1;
                $subs->save();
                
                
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

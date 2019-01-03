<?php

namespace App\Http\Controllers;

use App\Menu;
use App\ReCategory;
use Illuminate\Http\Request;
use App\Services\NL_CheckOutV3;

class TransactionController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function recharge(){

        return v('transaction.nap-tien', ['menuData' => $this->menuFE]);
    }
    public function postRecharge() {
        $nlcheckout= new NL_CheckOutV3(MERCHANT_ID,MERCHANT_PASS,RECEIVER,URL_API);
        $total_amount=$_POST['total_amount'];

        $array_items[0]= array('item_name1' => 'Product name',
            'item_quantity1' => 1,
            'item_amount1' => $total_amount,
            'item_url1' => 'http://nganluong.vn/');

        $array_items=array();
        $payment_method =$_POST['option_payment'];
        $bank_code = @$_POST['bankcode'];
        $order_code ="macode_".time();

        $payment_type ='';
        $discount_amount =0;
        $order_description='';
        $tax_amount=0;
        $fee_shipping=0;
        $return_url ='http://localhost/nganluong.vn/checkoutv3/payment_success.php';
        $cancel_url =urlencode('http://localhost/nganluong.vn/checkoutv3?orderid='.$order_code) ;

        $buyer_fullname =$_POST['buyer_fullname'];
        $buyer_email =$_POST['buyer_email'];
        $buyer_mobile =$_POST['buyer_mobile'];

        $buyer_address ='';




        if($payment_method !='' && $buyer_email !="" && $buyer_mobile !="" && $buyer_fullname !="" && filter_var( $buyer_email, FILTER_VALIDATE_EMAIL )  ){
            if($payment_method =="VISA"){

                $nl_result= $nlcheckout->VisaCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,
                    $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,
                    $buyer_address,$array_items,$bank_code);

            }elseif($payment_method =="NL"){
                $nl_result= $nlcheckout->NLCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,
                    $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,
                    $buyer_address,$array_items);

            }elseif($payment_method =="ATM_ONLINE" && $bank_code !='' ){
                $nl_result= $nlcheckout->BankCheckout($order_code,$total_amount,$bank_code,$payment_type,$order_description,$tax_amount,
                    $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,
                    $buyer_address,$array_items) ;
            }
            elseif($payment_method =="NH_OFFLINE"){
                $nl_result= $nlcheckout->officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
            }
            elseif($payment_method =="ATM_OFFLINE"){
                $nl_result= $nlcheckout->BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);

            }
            elseif($payment_method =="IB_ONLINE"){
                $nl_result= $nlcheckout->IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
            }
            elseif ($payment_method == "CREDIT_CARD_PREPAID") {

                $nl_result = $nlcheckout->PrepaidVisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
            }
//var_dump($nl_result); die;
            if ($nl_result->error_code =='00'){

//Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
                ?>
                <script type="text/javascript">
                    <!--
                    window.location = "<?php echo(string)$nl_result->checkout_url; // .'&lang=en' chuyển mặc định tiếng anh  ?>"
                    //-->
                </script>
                <?PHP
            }else{
                echo $nl_result->error_message;
            }

        }else{
            echo "<h3> Bạn chưa nhập đủ thông tin khách hàng </h3>";
        }
    }
}

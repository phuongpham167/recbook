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
        $nlcheckout= new NL_CheckOutV3(env('MERCHANT_ID'),env('MERCHANT_PASS'),env('RECEIVER'),env('URL_API'));
        $total_amount=\request('total_amount');

        $array_items[0]= array('item_name1' => 'nạp tiền',
            'item_quantity1' => 1,
            'item_amount1' => $total_amount,
            'item_url1' => asset(''));

        $bc = \request('bankcode');
        $buyer_email = auth()->user()->email;
        $buyer_fullname = auth()->user()->name;
        $buyer_mobile = '0123456789';

//        echo $bc;
//        exit();
        switch ($bc) {
            case 'NL':
                $payment_method = 'NL';
                $bank_code = '';
                break;

            case 'ATM_ONLINE_BIDV':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'BIDV';
                break;
            case 'ATM_ONLINE_VCB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'VCB';
                break;
            case 'ATM_ONLINE_DAB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'DAB';
                break;
            case 'ATM_ONLINE_TCB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'TCB';
                break;
            case 'ATM_ONLINE_MB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'MB';
                break;
            case 'ATM_ONLINE_VIB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'VIB';
                break;
            case 'ATM_ONLINE_ICB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'ICB';
                break;
            case 'ATM_ONLINE_EXB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'EXB';
                break;
            case 'ATM_ONLINE_ACB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'ACB';
                break;
            case 'ATM_ONLINE_HDB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'HDB';
                break;
            case 'ATM_ONLINE_MSB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'MSB';
                break;
            case 'ATM_ONLINE_NVB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'NVB';
                break;
            case 'ATM_ONLINE_VAB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'VAB';
                break;
            case 'ATM_ONLINE_VPB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'VPB';
                break;
            case 'ATM_ONLINE_SCB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'SCB';
                break;
            case 'ATM_ONLINE_PGB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'PGB';
                break;
            case 'ATM_ONLINE_GPB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'GPB';
                break;
            case 'ATM_ONLINE_AGB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'AGB';
                break;
            case 'ATM_ONLINE_SGB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'SGB';
                break;
            case 'ATM_ONLINE_BAB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'BAB';
                break;
            case 'ATM_ONLINE_TPB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'TPB';
                break;
            case 'ATM_ONLINE_NAB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'NAB';
                break;
            case 'ATM_ONLINE_SHB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'SHB';
                break;
            case 'ATM_ONLINE_OJB':
                $payment_method = 'ATM_ONLINE';
                $bank_code = 'OJB';
                break;

            case 'IB_ONLINE_BIDV':
                $payment_method = 'IB_ONLINE';
                $bank_code = 'BIDV';
                break;
            case 'IB_ONLINE_VCB':
                $payment_method = 'IB_ONLINE';
                $bank_code = 'VCB';
                break;
            case 'IB_ONLINE_DAB':
                $payment_method = 'IB_ONLINE';
                $bank_code = 'DAB';
                break;
            case 'IB_ONLINE_TCB':
                $payment_method = 'IB_ONLINE';
                $bank_code = 'TCB';
                break;

            case 'ATM_OFFLINE_BIDV':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'BIDV';
                break;
            case 'ATM_OFFLINE_VCB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'VCB';
                break;
            case 'ATM_OFFLINE_DAB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'DAB';
                break;
            case 'ATM_OFFLINE_TCB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'TCB';
                break;
            case 'ATM_OFFLINE_MB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'MB';
                break;
            case 'ATM_OFFLINE_ICB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'ICB';
                break;
            case 'ATM_OFFLINE_ACB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'ACB';
                break;
            case 'ATM_OFFLINE_MSB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'MSB';
                break;
            case 'ATM_OFFLINE_SCB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'SCB';
                break;
            case 'ATM_OFFLINE_PGB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'PGB';
                break;
            case 'ATM_OFFLINE_AGB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'AGB';
                break;
            case 'ATM_OFFLINE_SHB':
                $payment_method = 'ATM_OFFLINE';
                $bank_code = 'SHB';
                break;

            case 'NH_OFFLINE_BIDV':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'BIDV';
                break;
            case 'NH_OFFLINE_VCB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'VCB';
                break;
            case 'NH_OFFLINE_DAB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'DAB';
                break;
            case 'NH_OFFLINE_TCB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'TCB';
                break;
            case 'NH_OFFLINE_MB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'MB';
                break;
            case 'NH_OFFLINE_VIB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'VIB';
                break;
            case 'NH_OFFLINE_ICB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'ICB';
                break;
            case 'NH_OFFLINE_ACB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'ACB';
                break;
            case 'NH_OFFLINE_MSB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'MSB';
                break;
            case 'NH_OFFLINE_SCB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'SCB';
                break;
            case 'NH_OFFLINE_PGB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'PGB';
                break;
            case 'NH_OFFLINE_AGB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'AGB';
                break;
            case 'NH_OFFLINE_TPB':
                $payment_method = 'NH_OFFLINE';
                $bank_code = 'TPB';
                break;

            case 'VISA':
                $payment_method = 'VISA';
                $bank_code = 'VISA';
                break;
            case 'MASTER':
                $payment_method = 'VISA';
                $bank_code = 'MASTER';
                break;
        }

//        echo $buyer_email.'-'.$buyer_fullname.'-'.$buyer_mobile;
//        echo $payment_method;
//        exit();
        $order_code ="macode_".time();

        $payment_type ='';
        $discount_amount =0;
        $order_description='';
        $tax_amount=0;
        $fee_shipping=0;
        $return_url =asset('/nap-tien/ket-qua');
        $cancel_url =urlencode(asset('nap-tien/huy-bo?orderid=').$order_code) ;

        $buyer_address ='hp';




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
            set_notice(trans('system.not_enough_info'), 'warning');
            return redirect()->back();
        }
    }
}

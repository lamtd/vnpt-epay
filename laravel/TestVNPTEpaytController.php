<?php

namespace lamtd\VNPTEpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use lamtd\VNPTEpay\Facade\Gateway as VNPTEpay;
// use Omnipay\VNPTEpay\Gateway as VNPTEpay;
use Exeption;

class TestVNPTEpaytController extends Controller
{    
    /**
     * process_VNPTEPay
     * kiểm tra data từ client post lên, sau đó trả về token
     * @param  mixed $request
     * @return void
     */
    public function process_VNPTEPay(Request $request){

        $responds =  VNPTEpay::purchase([
            'amount' => $request -> input('goodsAmount'),
            'userFee' => $request -> input('userFee'),
            'userId' => $request -> input('userId'),
            'callBackUrl' => route('demo-result-vnpt-epay'), 
            'notiUrl' => '' //khi test local không dùng link ipn được
        ]) ;
        $responds -> send();

        // 9704 0000 0000 0018
        // NGUYEN VAN A 03/07 otp

        // amount: 10000
        // callBackUrl: "http://localhost:8000/api/public/order/ipn-vnpt-epay"
        // description: "TT Hoa Don: Order_20210819180033_5077"
        // domain: "https://sandbox.megapay.vn:2810"
        // invoiceNo: "Order_20210819180033_5077"
        // merId: "EPAY000001"
        // merTrxId: "MERTRXID20210819180033_2761"
        // merchantToken: "dc7bbb8c636e6b1a65d621f759185690231ced39df0f3b18bb0c7567134cc046"
        // notiUrl: "http://localhost:8000/api/public/order/vnpt-epay-success"
        // success: true

        // e55d057239fc046649033e67b93d7a2940194add9e78b75b1020e9717bf3fadb

    }
    
    /**
     * getResult
     * demo lấy kết trả về từ server test của vnpt
     * @return void
     */
    public function getResult(Request $request){

        $returnData['resultCd'] = '00_000';
        $returnData['resultMsg'] = 'SUCCESS';
        
        try {
            $response = VNPTEpay::notification()->send();
        } catch (Exception $th) {
            $returnData['resultCd'] = 'CC_115';
            $returnData['resultMsg'] = 'Chữ ký của merchant không hợp lệ';
            return $returnData;
        }

        if ($response->isSuccessful()) {
            return $returnData;
        }

        $returnData['resultCd'] = 'FL_902';
        $returnData['resultMsg'] = 'Có lỗi xảy ra trong quá trình xử lý';

    }
}

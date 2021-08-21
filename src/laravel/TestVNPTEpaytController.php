<?php

namespace Lamtd\VNPTEpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Lamtd\VNPTEpay\Facade\Gateway as VNPTEpay;
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

        return VNPTEpay::purchase([
            'amount' => $request -> input('goodsAmount'),
            'userFee' => $request -> input('userFee'),
            'userId' => $request -> input('userId'),
            'callBackUrl' => route('demo-result-vnpt-epay'), 
            'notiUrl' => '' //khi test local không dùng link ipn được
        ])  -> send();;


        // 9704 0000 0000 0018
        // NGUYEN VAN A 03/07 otp
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

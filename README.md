# vnpt-epay
Tạo cổng thanh toán VNPT

return VNPTEpay::purchase([
            'amount' => $request -> input('goodsAmount'),
            'userFee' => $request -> input('userFee'),
            'userId' => $request -> input('userId'),
            'callBackUrl' => route('vnpt-epay-success'), 
            'notiUrl' => '' //khi test local không dùng link ipn được
        ]) -> send();;

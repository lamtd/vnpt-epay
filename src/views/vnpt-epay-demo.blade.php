<head>
    <!--Link To CSS File-->
    <link rel="stylesheet" href="https://sandbox.megapay.vn:2810/pg_was/css/payment/layer/paymentClient.css"
        type="text/css" media="screen">
    <link rel="stylesheet" href="CSS/paymentpage.css" type="text/css" media="screen">
    <title>Cổng thanh toán VNPT EPAY</title>
    <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>

<body>
 <!--------------PAYMENT----------------------->
 <div id="tab-1" class="tab-content current">
        <form id="megapayForm" name="megapayForm" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
            <input type="hidden" name="invoiceNo" value=""/>
            <input type="hidden" name="amount" value=""/>
            <input type="hidden" name="currency" value="VND"/>
            
            <input type="hidden" name="buyerPhone" value="">
            <input type="hidden" name="buyerAddr" value="">
            <input type="hidden" name="buyerCity" value="">
            <input type="hidden" name="buyerState" value=""/>
            <input type="hidden" name="buyerPostCd" value=""/>
            <input type="hidden" name="buyerCountry"/>
            <input type="hidden" name="fee" value=""/>
            
            <!-- Delivery Info -->
            <input type="hidden" name="receiverFirstNm" value="">
            <input type="hidden" name="receiverLastNm" value="">
            <input type="hidden" name="receiverPhone" value="">
            <input type="hidden" name="receiverAddr" value="">
            <input type="hidden" name="receiverCity" value="">
            <input type="hidden" name="receiverState" value=""/>
            <input type="hidden" name="receiverPostCd" value=""/>
            <input type="hidden" name="receiverCountry" value="VN"/>
            <input type="hidden" name="description" value="Thông tin test VNPT"/>

            <!------------------------------- Main Value ------------------------------>
            <!-- Call Back URL -->
			<?php $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$url = str_replace('test.php', '', $url);
			?>
            <input type="hidden" name="callBackUrl" value="<?php echo $url; ?>result.php"/>
            <!-- Notify URL -->
            <input type="hidden" name="notiUrl" value="<?php echo $url; ?>/notify.php"/>
            <!-- Merchant ID -->
            <input type="hidden" name="merId" value=''/>
            <!-- Encode Key -->
            
            <!------------------------------------------------------------------------->

            <!-- <input type="hidden" name="reqServerIP" value=""/> -->
            <!-- <input type="hidden" name="reqClientVer" value=""/> -->
            <!-- <input type="hidden" name="userIP" value="172.16.12.145"/> -->
            <!-- <input type="hidden" name="userSessionID" value=""/> -->
            <!-- <input type="hidden" name="userAgent" value="chrome"/> -->
            <!-- <input type="hidden" name="version"/> -->
            <!-- <input type="hidden" name="mer_temp01" value=""/> -->
            <!-- <input type="hidden" name="mer_temp02" value=""/> -->
            <!-- <input type="hidden" name="domesticToken"/> -->
            <!-- <input type="hidden" name="instmntMon" value=""/> -->
            <!-- <input type="hidden" name="instmntType" value=""/> -->
            <!-- <input type="hidden" name="vat" value=""/> -->
            <!-- <input type="hidden" name="notax" value=""/> -->

            <input type="hidden" name="payType" id="payType" value="NO"/>
            <input type="hidden" name="bankCode" id="bankCode" value=""/>
            <input type="hidden" name="reqDomain" value="http://localhost:8080"/>
            <input type="hidden" name="userLanguage" value="VN"/>
            <input type="hidden" name="merchantToken" value=""/>
            <input type="hidden" name="payToken" id="payToken" value=""/>
            <input type="hidden" name="timeStamp" value=""/>
            <input type="hidden" name="merTrxId"/>
            <input type="hidden" name="windowType" value=""/>
            <input type='hidden' name='windowColor' value='#0B3B39'/>
            <input type="hidden" name="userFee" id="userFee" value="0"/>
            <input type="hidden" name="vaCondition" value="03"/>
            

            <div class="row">
                <table>
                    
                    <tr id="showPayOption_IC">
                        <td><b>Payment Option</b></td>
                        <td>
                            <table class="subTbl">
                                <tr>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" id="payOption" value=""/>Dùng thông tin thẻ
                                    </td>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" value="PAY_AND_CREATE_TOKEN" id="payOption"/>Thanh toán và Lưu thẻ(Tạo Token)
                                    </td>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" value="PAY_WITH_TOKEN" id="payOption"/>Sử dụng thẻ đã lưu(Dùng Token)
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr id="showPayOption_DC">
                        <td><b>Payment Option</b></td>
                        <td>
                            <table class="subTbl">
                                <tr>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" id="payOption" value=""/>Dùng thông tin thẻ
                                    </td>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" value="PAY_WITH_RETURNED_TOKEN" id="payOption"/>Thanh toán và Lưu thẻ(Tạo Token)
                                    </td>
                                    <td>
                                        <input type="radio" name="payOption" id="payOption" value="PURCHASE_OTP" id="payOption"/>Sử dụng thẻ đã lưu(Dùng Token)
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr id="showUserId">
                        <td><b>Data Demo đơn hàng</b></td>
                        <td>
                            <input type="text" name="userId" id="userId" placeholder="User ID" value="username"/>
                            <input type="hidden" name="goodsAmount" id="goodsAmount" value="10000"/>
                            <input type="hidden" name="buyerFirstNm" value="Boony">
                            <input type="hidden" name="buyerLastNm" value="Group">
                            <input type="hidden" name="buyerEmail" value=""/>
                            <input type="hidden" name="goodsNm" value="San pham Demo"/>
                        </td>
                    </tr>                  
                </table>
            </div>
        </form>
</div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://sandbox.megapay.vn:2810/pg_was/js/payment/layer/paymentClient.js">
    </script>
    <script>
        $( document ).ready(function() {
            payment();
        });
        function payment() {
        var userFee = $('#userFee').val();
        var userId = $('#userId').val();
        var goodsAmount = $('#goodsAmount').val();

        // payOption : payOpt
        $.ajax({
            url : "{{route('demo-process-vnpt-epay')}}",
            headers : {
                'X-CSRF-Token' : document.querySelector('meta[name="csrf-token"]').content
            },
            type : 'POST',
            dataType : 'json',
            data : { goodsAmount : goodsAmount, userFee : userFee, userId : userId, 
                order_id: orderID, order_code:orderCode },
                success : function(res) {
                if (res.success) {
                    var domain = res.domain;
                    paymentForm = document.getElementById('megapayForm');
                    for (const [key, value] of Object.entries(res)) {
                        if (paymentForm.elements[key]){
                            paymentForm.elements[key].value = value;
                        }
                    }
                    openPayment(1, domain);
                } else {
                    alert(res.mes);
                }
            },
            error : function() {
                alert('Có lỗi trong quá trình xử lý - đơn hàng chưa được hoàn thành. Vui lòng liên hệ hotline hỗ trợ!');
            }
        });
    }
    </script>
</body>

</html>
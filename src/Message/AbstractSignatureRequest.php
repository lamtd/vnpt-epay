<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 * @copyright (c) boonygroup.com
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VnptEpay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\VnptEpay\Concerns\Parameters;
use Omnipay\VnptEpay\Concerns\ParametersNormalization;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureRequest extends AbstractRequest
{
    use Parameters;
    use ParametersNormalization;
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        
        $timeStamp = date('YmdHis');
        $merTrxId = 'MERTRXID'.$timeStamp.'_'.rand(100,10000);
        $invoiceNo = 'Order_'.$timeStamp.'_'.rand(100,10000);

        $this->setTimestamp(
            $timeStamp
        );
        $this->setMertrxid(
            $merTrxId 
        );
        $this->setInvoiceNo(
            $invoiceNo
        );
        
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            $this->getSignatureParameters()
        );

        $parameters = $this->getParameters();

        $parameters['merchantToken'] = $this->generateSignature(
            'sha256'
        );

        unset($parameters['EncodeKey'], $parameters['testMode']);

        return $parameters;
    }


    /**
     * {@inheritdoc}
     */
    public function getMertrxid(): ?string
    {
        return $this->getParameter('merTrxId');
    }

    /**
     * {@inheritdoc}
     */
    public function setMertrxid($value)
    {
        return $this->setParameter('merTrxId', $value);
    }

    /**
     * Trả về thông tin đơn hàng hay lý do truy vấn đến VNPay.
     *
     * @return null|string
     */
    public function getVnpOrderInfo(): ?string
    {
        return $this->getParameter('vnpt_OrderInfo');
    }

    /**
     * Thiết lập thông tin đơn hàng hay lý do truy vấn đến VNPay.
     *
     * @param  null|string  $info
     * @return $this
     */
    public function setVnpOrderInfo(?string $info)
    {
        return $this->setParameter('vnpt_OrderInfo', $info);
    }

    /**
     * Trả về thời gian khởi tạo truy vấn đến VNPay.
     *
     * @return null|string
     * @see getVnpReturnUrl
     */
    public function getTimestamp(): ?string
    {
        return $this->getParameter('timeStamp');
    }

    /**
     * Thiết lập thời gian khởi tạo truy vấn đến VNPay.
     * Mặc định sẽ là thời gian hiện tại.
     *
     * @param  null|string  $date
     * @return $this
     * @see setReturnUrl
     */
    public function setTimestamp(?string $date)
    {
        return $this->setParameter('timeStamp', $date);
    }

    public function getInvoiceNo(){
        return $this->getParameter('vnpt_invoiceNo');
    }

    public function setInvoiceNo(?string $value){
        return $this->setParameter('vnpt_invoiceNo', $value);
    }

    
 
}

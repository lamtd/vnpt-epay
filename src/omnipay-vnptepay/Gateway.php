<?php
/**
 * @link 
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay;

use Omnipay\Common\AbstractGateway;
use Omnipay\VNPTEpay\Message\IncomingRequest;
use Omnipay\VNPTEpay\Message\PurchaseRequest;
use Omnipay\VNPTEpay\Message\QueryTransactionRequest;
use Omnipay\VNPTEpay\Message\RefundRequest;

/**
 * @author Lam Truong <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class Gateway extends AbstractGateway
{
    use Concerns\Parameters;
    use Concerns\ParametersNormalization;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'VNPTEpay';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        return parent::initialize($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'notiUrl' => null,
            'callBackUrl' => null,
            'reqDomain' => null,
            'description' => null,
            'currency' => null,
            'goodsNm' => null,
        ];
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|IncomingRequest
     */
    public function completePurchase(array $options = []): IncomingRequest
    {
        return $this->createRequest(IncomingRequest::class, $options);
    }

    /**
     * Tạo yêu cầu xác minh IPN gửi từ VNPay.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\AbstractRequest|IncomingRequest
     */
    public function notification(array $options = []): IncomingRequest
    {
        return $this->createRequest(IncomingRequest::class, $options);
    }

    /**
     * Tạo yêu cầu truy vấn thông tin giao dịch đến VNPay.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\AbstractRequest|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        return $this->createRequest(QueryTransactionRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|RefundRequest
     */
    public function refund(array $options = []): RefundRequest
    {
        return $this->createRequest(RefundRequest::class, $options);
    }
}

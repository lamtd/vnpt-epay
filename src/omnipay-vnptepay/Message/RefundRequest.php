<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Message;

/**
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class RefundRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $productionEndpoint = '';

    /**
     * {@inheritdoc}
     */
    protected $testEndpoint = '';

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->setParameter('vnp_Command', 'refund');

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): SignatureResponse
    {
        $query = http_build_query($data, null, '&', PHP_QUERY_RFC3986);
        $requestUrl = $this->getEndpoint().'?'.$query;
        $response = $this->httpClient->request('GET', $requestUrl);
        $responseRawData = $response->getBody()->getContents();
        parse_str($responseRawData, $responseData);

        return $this->response = new SignatureResponse($this, $responseData);
    }

    /**
     * Trả về số tiền cần hoàn trả.
     * Đây là phương thức ánh xạ của [[getAmount()]].
     *
     * @return null|string
     * @see getAmount
     */
    public function getVNPT_Amount(): ?string
    {
        return $this->getAmount();
    }

    /**
     * Thiết lập số tiền hoàn trả.
     * Đây là phương thức ánh xạ của [[setAmount()]].
     *
     * @param  null|string  $number
     * @return $this
     * @see setAmount
     */
    public function setVNPT_Amount(?string $number)
    {
        return $this->setAmount($number);
    }

    /**
     * Trả về hình thức hoàn tiền.
     *
     * @return null|string
     */
    public function getVnpTransactionType(): ?string
    {
        return $this->getParameter('vnp_TransactionType');
    }

    /**
     * Thiết lập hình thức hoàn tiền.
     *
     * @param  null|string  $type
     * @return $this
     */
    public function setVnpTransactionType(?string $type)
    {
        return $this->setParameter('vnp_TransactionType', $type);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): ?string
    {
        return $this->getParameter('vnp_Amount');
    }

    /**
     * {@inheritdoc}
     */
    public function setAmount($value)
    {
        return $this->setParameter('vnp_Amount', $value);
    }

    /**
     * Trả về thời gian phát sinh giao dịch tại VNPay.
     *
     * @return null|string
     */
    public function getVnpTransDate(): ?string
    {
        return $this->getParameter('vnp_TransDate');
    }

    /**
     * Thiết lập thời gian phát sinh giao dịch tại VNPay.
     *
     * @param  null|string  $date
     * @return $this
     */
    public function setVnpTransDate(?string $date)
    {
        return $this->setParameter('vnp_TransDate', $date);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'vnp_Version', 'vnp_Command', 'Mer_ID', 'merTrxId', 'vnp_OrderInfo', 'vnp_Amount',
            'vnp_TransDate', 'vnp_TransactionType',
        ];
    }
}

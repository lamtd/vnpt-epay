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
class QueryTransactionRequest extends AbstractSignatureRequest
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

        $this->setParameter('vnp_Command', 'querydr');

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
     * Trả về mã giao dịch của VNPay.
     * Đây là phương thức ánh xạ của [[getTransactionReference()]].
     *
     * @return null|string
     * @see getTransactionReference
     */
    public function getVnpTransactionNo(): ?string
    {
        return $this->getParameter('merTrxId');
    }

    /**
     * Thiết lập mã giao dịch của VNPay.
     * Đây là phương thức ánh xạ của [[setTransactionReference()]].
     *
     * @param  null|string  $no
     * @return $this
     * @see setTransactionReference
     */
    public function setVnpTransactionNo(?string $no)
    {
        return $this->setParameter('merTrxId', $no);
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionReference(): ?string
    {
        return $this->getParameter('merTrxId');
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionReference($value)
    {
        return $this->setParameter('merTrxId', $value);
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
        $parameters = [
            'vnp_Version', 'vnp_Command', 'Mer_ID', 'merTrxId', 'vnp_OrderInfo', 'vnp_TransDate',
            'vnp_CreateDate', 'vnp_IpAddr',
        ];

        if ($this->getVnpTransactionNo()) {
            $parameters[] = 'merTrxId';
        }

        return $parameters;
    }
}

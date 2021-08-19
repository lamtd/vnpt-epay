<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 * 
 * set chức parameters cho các biến,
 * tự động  tìm functions theo dạng 'set' + tên function viết hoa đầu tiên
 * tham khảo ở file Omnipay\Common\Helper;
 */


namespace Omnipay\VnptEpay\Message;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $productionEndpoint = '';

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);       

        return $this;
    }

    /**
     * {@inheritdoc}
     * VNPT không post request lên
     */ 
    public function sendData($data): array
    {

        // $query = http_build_query($data);
        // $redirectUrl = $this->getEndpoint().'?'.$query;
        // // echo json_encode ($data);
        // return $this->response = new PurchaseResponse($this, $data, $redirectUrl);

        $description = 'TT Hoa Don: ' . $this -> getInvoiceNo();
        
        return
            [
                'success' => true, 'description' => $description, 
                'amount' =>  $data['amount'] + $data['userFee'],
                'merchantToken' => $data['merchantToken'], 
                'timeStamp' => $this -> getTimestamp(), 
                'merId' => $this -> getMerid(), 'invoiceNo' => $this -> getInvoiceNo(), 
                'merTrxId' => $this-> getMertrxid(), 
                'domain' => $this -> getVnptdomain(),
                'callBackUrl' => isset($data['callBackUrl']) ? $data['callBackUrl'] : null,
                'notiUrl' => isset($data['notiUrl']) ? $data['notiUrl'] : null,
            ];
    }

    /**
     * Thiết lập link return
     * Link trả về sau khi có xác nhận kết quả từ IPN
     * @param  null|string  $code
     * @return $this
     */
    public function setCallbackurl(?string $code)
    {
        return $this->setParameter('callBackUrl', $code);
    }

    /**
     * Link trả về sau khi có xác nhận kết quả từ IPN
     *
     * @return null|string
     */
    public function getCallbackurl(): ?string
    {
        return $this->getParameter('callBackUrl');
    }

    /**
     * Đặt Link IPN 
     *
     * @param  null|string  $type
     * @return $this
     */
    public function setNotiUrl(?string $type)
    {
        return $this->setParameter('notiUrl', $type);
    }

    /**
     * Lấy Link Ipn
     *
     * @return null|string
     */
    public function getNotiurl(): ?string
    {
        return $this->getParameter('notiUrl');
    }


    /**
     * {@inheritdoc}
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserfee(): ?string
    {
        return $this->getParameter('userFee');
    }

    /**
     * {@inheritdoc}
     */
    public function setUserfee($value)
    {
        return $this->setParameter('userFee', $value);
    }


    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        $parameters = [
            'merTrxId', 'timeStamp', 'vnpt_invoiceNo', 'amount', 'userFee', 
             'merId' , 'EncodeKey'
        ];

        // if ($this->getVnpBankCode()) {
        //     $parameters[] = 'vnpt_BankCode';
        // }

        return $parameters;
    }
}

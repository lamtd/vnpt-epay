<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VnptEpay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\VnptEpay\Concerns\Parameters;
use Omnipay\VnptEpay\Concerns\ParametersNormalization;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class IncomingRequest extends AbstractRequest
{
    use Parameters;
    use ParametersNormalization;

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            array_keys($parameters = $this->getIncomingParameters())
        );

        return $parameters;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): SignatureResponse
    {
        return $this->response = new SignatureResponse($this, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        foreach ($this->getIncomingParameters() as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }

        return $this;
    }

    /**
     * Trả về danh sách parameters từ VNPay gửi sang.
     *
     * @return array
     */
    protected function getIncomingParameters(): array
    {
        return $this->httpRequest->query->all();
    }
}

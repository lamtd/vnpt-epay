<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class SignatureResponse extends Response
{
    use Concerns\ResponseSignatureValidation;

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if ($this->isSuccessful()) {
            $this->validateSignature();
        }
    }
}

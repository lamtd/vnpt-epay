<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 * @copyright (c) boonygroup.com
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Message\Concerns;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\VNPTEpay\Support\Signature;

/**
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Kiểm tra tính hợp lệ của dữ liệu do VNPay phản hồi.
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['merchantToken'])) {
            throw new InvalidResponseException('Không có trường token từ VNPT EPAY!');
        }

        $data['EncodeKey']  = $this->getRequest()->getEncodekey();
        $signature = new Signature(
            'sha256'
        );

        if (! $signature->validate($data, $data['merchantToken'])) {
            throw new InvalidResponseException(sprintf('Token không đúng!'));
        }
    }
}

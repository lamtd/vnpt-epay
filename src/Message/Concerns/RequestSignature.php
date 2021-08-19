<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 * @copyright (c) boonygroup.com
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VnptEpay\Message\Concerns;

use Omnipay\VnptEpay\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestSignature
{
    /**
     * Trả về chữ ký điện tử gửi đến VNPay dựa theo [[getSignatureParameters()]].
     *
     * @param  string  $hashType
     * @return string
     */
    protected function generateSignature(string $hashType = 'sha256'): string
    {
        $data = [];
        $signature = new Signature(
            $hashType
        );

        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        return $signature->generate($data);
    }

    /**
     * Trả về danh sách parameters dùng để tạo chữ ký số.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}

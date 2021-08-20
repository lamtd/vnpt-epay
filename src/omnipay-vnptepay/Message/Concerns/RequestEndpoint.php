<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 * @copyright (c) boonygroup.com
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Message\Concerns;

/**
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{
    /**
     * Đường dẫn giao tiếp với VNPay ở môi trường production.
     *
     * @var string
     */
    protected $productionEndpoint;

    /**
     * Đường dẫn giao tiếp với VNPay ở môi trường test.
     *
     * @var string
     */
    protected $testEndpoint;

    /**
     * Trả về url kết nối VNPay.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->productionEndpoint;
    }
}

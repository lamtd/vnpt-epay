<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Concerns;

/**lấy những biến mặc định từ file config
 * đã load lên hết từ Ignited\LaravelOmnipay; lưu ý: function dùng set + ucfirst(option_name)
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
trait Parameters
{
    /**
     * Trả về mã Tmn do VNPT cấp.
     *
     * @return null|string
     */
    public function getVnptdomain(): ?string
    {
        return $this->getParameter('VNPTDomain');
    }

    /**
     * Thiết lập mã Tmn.
     *
     * @param  null|string  $code
     * @return $this
     */
    public function setVnptdomain(?string $code)
    {
        return $this->setParameter('VNPTDomain', $code);
    }

    /**
     * Trả về mã Tmn do VNPT cấp.
     *
     * @return null|string
     */
    public function getMerid(): ?string
    {  
       
        return $this->getParameter('merId');
    }

    /**
     * Thiết lập mã .
     *
     * @param  null|string  $code
     * @return $this
     */
    public function setMerid(?string $code)
    {
        echo "set Par";
        return $this->setParameter('merId', $code);
    }

    /**
     * Trả về khóa dùng để tạo chữ ký dữ liệu.
     *
     * @return null|string
     */
    public function getEncodekey(): ?string
    {
        return $this->getParameter('EncodeKey');
    }

    /**
     * Thiết lập khóa dùng để tạo chữ ký dữ liệu.
     *
     * @param  null|string  $secret
     *
     * @return $this
     */
    public function setEncodekey(?string $secret)
    {
        echo "set encode";
        return $this->setParameter('EncodeKey', $secret);
    }
}

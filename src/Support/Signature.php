<?php
/**
 * @link https://github.com/lamtd/vnpt-epay
 * @copyright (c) boonygroup.com
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VnptEpay\Support;

use InvalidArgumentException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Signature
{

    /**
     * Loại thuật toán mã hóa sẽ sử dụng.
     *
     * @var string
     */
    protected $hashType;

    /**
     * Khởi tạo đối tượng DataSignature.
     *
     * @param  string  $hashSecret
     * @param  string  $hashType
     * @throws InvalidArgumentException
     */
    public function __construct(string $hashType = 'sha256')
    {
        if (! $this->isSupportHashType($hashType)) {
            throw new InvalidArgumentException(sprintf('Hash type: `%s` is not supported by VNPT', $hashType));
        }

        $this->hashType = $hashType;
    }

    /**
     * Trả về chữ ký dữ liệu của dữ liệu truyền vào.
     *
     * @param  array  $data
     * @return string
     */
    public function generate(array $data): string
    {

        ksort($data);
        $plainTxtToken = $data['timeStamp'] . $data['merTrxId'] . 
        $data['merId'] . ($data['amount'] + $data['userFee']) . $data['EncodeKey'];

        if (!empty($data['resultCd'])){//Chiều trả về của VNPT sinh ra token kah1c
            $plainTxtToken = $data['resultCd'].$data['timeStamp'] . $data['merTrxId'] . 
            $data['trxId'].$data['merId'].($data['amount']).$data['EncodeKey'];
        }
        // echo $plainTxtToken."<br>" ;
        return hash($this->hashType, $plainTxtToken);
    }

    /**
     * Kiểm tra tính hợp lệ của chữ ký dữ liệu so với dữ liệu truyền vào.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(array $data, string $expect): bool
    {
        $actual = $this->generate($data);

        return 0 === strcasecmp($expect, $actual);
    }

    /**
     * Phương thức cho biết loại mã hóa truyền vào có được VNPay hổ trợ hay không.
     *
     * @param  string  $type
     * @return bool
     */
    protected function isSupportHashType(string $type): bool
    {
        return 0 === strcasecmp($type, 'md5') || 0 === strcasecmp($type, 'sha256');
    }
}

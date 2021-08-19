<?php
/**
 * @link 
 *
 * @copyright boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VnptEpay\Facade;

use Illuminate\Support\Facades\Facade;
use Omnipay\VnptEpay\Gateway as VNPTGateway;

/**
 *
 * @author Lam Truong <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class Gateway extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): VNPTGateway
    {
        return static::$app['omnipay']->gateway('VnptEpay');
    }
}

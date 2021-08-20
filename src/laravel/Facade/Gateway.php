<?php
/**
 * @link 
 *
 * @copyright boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Lamtd\VNPTEpay\Facade;

use Illuminate\Support\Facades\Facade;
use Omnipay\VNPTEpay\Gateway as VNPTGateway;

/**
 *
 * @author Lam Truong <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class Gateway extends Facade
{
    /**
     * {@inheritdoc}
     * gốc https://github.com/thephpleague/omnipay
     */ 
    protected static function getFacadeAccessor() : VNPTGateway
    {
        
        return static::$app['omnipay']->gateway('VNPTEpay');
    }
}

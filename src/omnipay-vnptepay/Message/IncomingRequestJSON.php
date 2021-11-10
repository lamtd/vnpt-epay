<?php

/**
 * @link https://github.com/lamtd/vnpt-epay
 *
 * @copyright (c) boonygroup.com
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPTEpay\Message;

use Omnipay\Common\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Illuminate\Support\Facades\Log;

/**
 * @author lamtd <lamtd@boonygroup.com>
 * @since 1.0.0
 */
class IncomingRequestJSON extends IncomingRequest
{

    protected $respondFields = [];
    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {

        call_user_func_array(
            [$this, 'validate'],
            array_keys($parameters = $this->respondFields)
        );

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        Log::info(json_encode($this-> httpRequest -> getContent()));

        foreach (json_decode($this->httpRequest->getContent()) as $parameter => $value) {

            $this->respondFields[$parameter] = $value;
            $this->setParameter($parameter, $value);
        }
        return $this;
    }
}

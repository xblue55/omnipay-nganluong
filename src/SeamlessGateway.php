<?php

namespace NganLuong;

use Omnipay\Common\AbstractGateway;

/**
 * NganLuong SeamlessGateway Class
 */
class SeamlessGateway extends AbstractGateway
{

    public function getName()
    {
        return 'NganLuong_Seamless';
    }


    public function getDefaultParameters()
    {
        $settings= parent::getDefaultParameters();
        $settings['merchant_id'] = '';
        $settings['merchant_password'] = '';
        $settings['receiver'] = '';
        $settings['version'] = '';
        $settings['return_url'] = '';
        $settings['cancel_url'] = '';
        $settings['notify_url'] = '';
        $settings['time_limit'] = '';
        $settings['test_mode'] = false;
        return $settings;
    }


    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }


    public function getMerchantPassword()
    {
        return $this->getParameter('merchant_password');
    }


    public function setMerchantPassword($value)
    {
        return $this->setParameter('merchant_password', $value);
    }

    public function getReceiver()
    {
        return $this->getParameter('receiver');
    }


    public function setReceiver($value)
    {
        return $this->setParameter('receiver', $value);
    }
  

    public function authorize(array $parameters = [ ])
    {
      // if ($parameters['payment_method'] == '')
        return $this->createRequest('\Omnipay\NganLuong\src\Message\ExpressAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = [ ])
    {
        return $this->authorize($parameters);
    }

    public function fetchCheckout(array $parameters = [ ])
    {
        return $this->createRequest('\Omnipay\NganLuong\src\Message\ExpressFetchCheckoutRequest', $parameters);
    }
}

<?php

namespace NganLuong\Message;

/**
 * NganLuong Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    const API_VERSION = '85.0';

    protected $liveEndpoint = 'https://www.nganluong.vn/checkoutseamless.api.nganluong.post.php';

    protected $testEndpoint = 'https://www.nganluong.vn/checkoutseamless.api.nganluong.post.php';

    public function getVersion()
    {
        return $this->getParameter('Version');
    }


    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }


    public function setMerchantId($value)
    {
        return $this->setParameter('merchant_id', $value);
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

    public function getOrderCode()
    {
      return $this->getParameter('order_code');
    }

    public function setOrderCode($value)
    {
      return $this->setParameter('order_code', $value);
    }

    public function getTotalAmount()
    {
        return $this->getParameter('total_amount');
    }

    public function setTotalAmount($value)
    {
        return $this->setParameter('total_amount', $value);
    }

    public function getPaymentMethod()
    {
        return $this->getParameter('payment_method');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('payment_method', $value);
    }

    public function getPaymentType()
    {
        return $this->getParameter('payment_type');
    }

    public function setPaymentType($value)
    {
        return $this->setParameter('payment_type', $value);
    }

    public function getOrderDescription()
    {
        return $this->getParameter('order_description');
    }

    public function setOrderDescription($value)
    {
        return $this->setParameter('order_description', $value);
    }

    public function getTaxNumber()
    {
        return $this->getParameter('tax_amount');
    }

    public function setTaxNumber($value)
    {
        return $this->setParameter('tax_amount', $value);
    }

    public function getDiscountNumber()
    {
        return $this->getParameter('discount_amount');
    }

    public function setDiscountNumber($value)
    {
        return $this->setParameter('discount_amount', $value);
    }

    public function getFeeShipping()
    {
        return $this->getParameter('fee_shipping');
    }

    public function setFeeShipping($value)
    {
        return $this->setParameter('fee_shipping', $value);
    }

    public function getBankCode()
    {
        return $this->getParameter('bank_code');
    }

    public function setBankCode($value)
    {
        return $this->setParameter('bank_code', $value);
    }

    public function getTimeLimit()
    {
        return $this->getParameter('time_limit');
    }

    public function setTimeLimit($value)
    {
        return $this->setParameter('time_limit', $value);
    }

    public function getBuyerFullname()
    {
        return $this->getParameter('buyer_fullname');
    }

    public function setBuyerFullname($value)
    {
        return $this->setParameter('buyer_fullname', $value);
    }

    public function getBuyerEmail()
    {
        return $this->getParameter('buyer_email');
    }

    public function setBuyerEmail($value)
    {
        return $this->setParameter('buyer_email', $value);
    }

    public function getBuyerPhone()
    {
        return $this->getParameter('buyer_mobile');
    }

    public function setBuyerPhone($value)
    {
        return $this->setParameter('buyer_mobile', $value);
    }

    public function getBuyerAddress()
    {
        return $this->getParameter('buyer_address');
    }

    public function setBuyerAddress($value)
    {
        return $this->setParameter('buyer_address', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('cur_code');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('cur_code', $value);
    }

    public function getLangCode()
    {
        return $this->getParameter('lang_code');
    }

    public function setLangCode($value)
    {
        return $this->setParameter('lang_code', $value);
    }

    public function getAffCode()
    {
        return $this->getParameter('affiliate_code');
    }

    public function setAffCode($value)
    {
        return $this->setParameter('affiliate_code', $value);
    }

    public function getCardNumber()
    {
        return $this->getParameter('card_number');
    }

    public function setCardNumber($value)
    {
        return $this->setParameter('card_number', $value);
    }

    public function getCardFullname()
    {
        return $this->getParameter('card_fullname');
    }

    public function setCardFullname($value)
    {
        return $this->setParameter('card_fullname', $value);
    }

    public function getCardMonth()
    {
        return $this->getParameter('card_month');
    }

    public function setCardMonth($value)
    {
        return $this->setParameter('card_month', $value);
    }

    public function getCardYear()
    {
        return $this->getParameter('card_year');
    }

    public function setCardYear($value)
    {
        return $this->setParameter('card_year', $value);
    }

    protected function getBaseData($method)
    {
        $data                       = [ ];
        $data['function']          = $method;
        $data['version']          = $this->getVersion();
        $data['merchant_id'] = $this->getMerchantId();
        $data['merchant_password']  = $this->getMerchantPassword();
        $data['receiver_email']  = $this->getReceiver();

        return $data;
    }


    public function sendData($data)
    {
        $paramsStr = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getEndpoint());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        if (!empty($result)) {
          $str_result = str_replace('&', '&amp;', (string) $result);
          $xml = simplexml_load_string($str_result);
          $json_result = json_encode($xml);
          $result = json_decode($json_result, true);
        }

        return $this->createResponse($result);
    }


    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }


    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }

    // private function _makeChecksum($params)
    // {
    //     $md5  = '';
    //     $keys = $this->_getMapKeys();
    //     foreach ($keys as $key) {
    //         $md5 .= strval(@$params[$key]);
    //     }
    //     $md5 .= $this->merchantPassword;

    //     return md5($md5);
    // }
}

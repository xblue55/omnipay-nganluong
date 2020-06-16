<?php

namespace NganLuong\Message;

/**
 * NganLuong Express Authorize Request
 */
class ExpressAuthorizeRequest extends AbstractRequest
{

    public function getData()
    {
        $data = $this->getBaseData('SetExpressCheckout');

        $this->validate('amount', 'returnUrl', 'cancelUrl');

        $data['receiver']                 = $this->getReceiver();
        $data['order_code']               = $this->getOrderCode();
        $data['amount']                   = $this->getAmount();
        $data['currency_code']            = $this->getCurrency();
        $data['tax_amount']               = $this->getTransactionId();
        $data['discount_amount']          = $this->getDescription();
        $data['fee_shipping']             = $this->getNotifyUrl();
        $data['request_confirm_shipping'] = $this->getNotifyUrl();
        $data['no_shipping']              = $this->getNotifyUrl();

        $data['return_url'] = $this->getReturnUrl();
        $data['cancel_url'] = $this->getCancelUrl();

        return $data;
    }


    protected function createResponse($data)
    {
        return $this->response = new ExpressAuthorizeResponse($this, $data);
    }
}

<?php

namespace NganLuong\Message;

/**
 * NganLuong Express Authorize Request
 */
class ExpressAuthorizeRequest extends AbstractRequest
{

  public function getData()
  {
    $data = $this->getBaseData('GetRequestField');

    $this->validate('payment_method', 'bank_code');

    $data['payment_method']                 = $this->getPaymentMethod();
    $data['bank_code']               = $this->getBankCode();

    $data['return_url'] = $this->getReturnUrl();
    $data['cancel_url'] = $this->getCancelUrl();

    return $data;
  }


  protected function createResponse($data)
  {
    return $this->response = new ExpressAuthorizeResponse($this, $data);
  }
}

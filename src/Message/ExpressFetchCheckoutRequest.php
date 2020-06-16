<?php

namespace NganLuong\Message;

/**
 * Ngan Luong Fetch Checkout Details Request
 */
class ExpressFetchCheckoutRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate();

        $data = $this->getBaseData('GetExpressCheckoutDetails');

        return $data;
    }
}

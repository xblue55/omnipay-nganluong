<?php

namespace NganLuong\Message;

/**
 * Ngan Luong Fetch Transaction Request
 */
class FetchTransactionRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('transactionReference');

        $data                   = $this->getBaseData('GetTransactionDetails');
        $data['transaction_id'] = $this->getTransactionReference();

        return $data;
    }
}

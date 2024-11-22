<?php

namespace App\Services;

use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;
use PhonePe\payments\v1\models\request\builders\PgRefundRequestBuilder;

use PhonePe\Env;
use PhonePe\payments\v1\PhonePePaymentClient;


class PhonePeService
{
    protected $client;

    public function __construct()
    {
        $config = config('phonepe');
    
        $environment = $config['environment'] === 'PRODUCTION' ? Env::PRODUCTION : Env::UAT;

        $this->client = new PhonePePaymentClient(
            $config['merchant_id'],
            $config['salt_key'],
            $config['salt_index'],
            $environment,
            $config['should_publish_events']
        );
    }

    public function initiatePayment($mobileNumber, $amount, $callbackUrl, $redirectUrl)
    {
        $merchantTransactionId = 'Txn_' . uniqid();
       
        $request = PgPayRequestBuilder::builder()
            ->mobileNumber($mobileNumber)
            ->callbackUrl($callbackUrl)
            ->merchantId(config('phonepe.merchant_id'))
            ->merchantUserId('TestUser') // Update as needed
            ->amount($amount * 100) // Convert to paise
            ->merchantTransactionId($merchantTransactionId)
            ->redirectUrl($redirectUrl)
            ->redirectMode('REDIRECT')
            ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
            ->build();

        $response = $this->client->pay($request);

        return [
            'transaction_id' => $merchantTransactionId,
            'redirect_url' => $response->getInstrumentResponse()->getRedirectInfo()->getUrl(),
        ];
    }

    public function checkStatus($merchantTransactionId)
    {
        return $this->client->statusCheck($merchantTransactionId);
    }

    public function refund($originalTransactionId, $amount, $callbackUrl)
    {
        $request = PgRefundRequestBuilder::builder()
            ->originalTransactionId($originalTransactionId)
            ->merchantId(config('phonepe.merchant_id'))
            ->merchantTransactionId('Refund_' . uniqid())
            ->callbackUrl($callbackUrl)
            ->amount($amount * 100) // Convert to paise
            ->build();

        return $this->client->refund($request);
    }

    public function verifyCallback($response, $xVerify)
    {
        return $this->client->verifyCallback($response, $xVerify);
    }
}

<?php

namespace Josmarh\JVZooIPN\Services;

use Josmarh\JVZooIPN\Models\JVProduct;
use Josmarh\JVZooIPN\Models\JVProductTransaction;
use Josmarh\JVZooIPN\Events\SaleReceived;
use Josmarh\JVZooIPN\Events\RefundReceived;

class IPNVerificationService
{
    public function handle(array $data, $rawPayload)
    {
        if (config('jvzoo-ipn.verify_signature')) {
            if (!$this->verifyIPN($rawPayload, $data)) {
                throw new \Exception('IPN verification failed');
            }
        }

        $product = JVProduct::where('product_id', $data['cproditem'])->first();

        if(!$product){
            throw new \Exception('Unknown product type');
        }

        if (JVProductTransaction::where('transaction_id', $data['ctransreceipt'])->exists()) {
            return ['status' => 'Already processed'];
        }

        $transaction = JVProductTransaction::create([
            'product_id' => $product->product_id,
            'transaction_id' => $data['ctransreceipt'],
            'transaction_type' => $data['ctransaction'],
            'customer_email' => $data['ccustemail'],
            'customer_name' => $data['ccustname'],
            'amount' => $data['ctransamount'],
            'metadata' => $data,
        ]);

        return match ($data['ctransaction']) {
            'SALE' => $this->handleSale($transaction),
            'RFND' => $this->handleRefund($transaction),
            default => ['status' => 'Transaction type not supported']
        };
    }

    public function handleSale(JVProductTransaction $transaction)
    {
        event(new SaleReceived($transaction));

        return ['status' => 'sale processed'];
    }

    public function handleRefund(JVProductTransaction $transaction)
    {
        event(new RefundReceived($transaction));

        return ['status' => 'refund processed'];
    }

    public function verifyIPN($rawPayload, array $data)
    {
        parse_str($rawPayload, $data);

        $receivedHash = $data['cverify'] ?? null;

        unset($data['cverify']);

        ksort($data);

        $queryString = http_build_query($data);

        $calculated = strtoupper(md5($queryString . config('jvzoo-ipn.secret_key')));

        return $calculated === $receivedHash;
    }
}
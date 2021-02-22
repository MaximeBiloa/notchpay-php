<?php

namespace Notchpay;

/**
 * Notch Pay PHP client
 * http://notchpay.xyz/docs
 *
 * @author  Chapdel KAMGA <drop@chapdel.me>
 * @version 1.0
 */

use Curl\Curl;

class Payment
{
    public $curl;
    public $business_id;
    public $base_url = 'http://notchpay-backend.test';

    /**
     * Create a new instance
     *
     * @param string $business_id      Your Notch Pay Business ID
     *
     * @throws \Exception
     */
    public function __construct($business_id = null)
    {
        $this->curl = new Curl();
        $this->curl->setDefaultUserAgent();
        $this->curl->setHeader('X-Requested-With', 'XMLHttpRequest');
        $this->curl->setHeader('Accept', 'application/json');
        $this->curl->setHeader('Content-Type', 'application/json');
        $this->curl->setHeader('Content-Type', 'application/json');

        if ($business_id != null) {
            $this->business_id = $business_id;
        }
    }

    /**
     * Set Business ID
     *
     * @param string $business_id    Notch Pay Business ID
     * @return void
     */

    public function setBusinessID($business_id)
    {
        $this->business_id = $business_id;
    }

    /**
     * get Business ID
     *
     * @return string
     */

    public function getBusinessID()
    {
        return $this->business_id;
    }

    /**
     * Checkout
     *
     * @param array $data   customer data
     * @return bool
     */
    public function checkout($data = [])
    {
        if (!$this->business_id) {
            throw new \Exception("business_id is required", 1);
        }
        if (!isset($data['amount'])) {
            throw new \Exception("amount is required", 1);
        }

        if (!isset($data['description'])) {
            throw new \Exception("description is required", 1);
        }

        $data['business_id'] = $this->business_id;

        $this->curl->post($this->base_url . "/checkout/initialize", $data);

        if ($this->curl->error) {

            throw new \Exception($this->curl->errorMessage, 1);
        }

        return $this->curl->response;
    }

    /**
     * Verify transaction
     *
     * @param string $reference  Transaction reference
     * @return object
     */
    public function verify($reference)
    {
        if (!$this->business_id) {
            throw new \Exception("business_id is required", 1);
        }

        $this->curl->get($this->base_url . "/verify/" . $reference, [
            "business_id" => $this->business_id
        ]);

        if ($this->curl->error) {

            // throw error
            throw new \Exception($this->curl->errorMessage, 1);
        }

        return $this->curl->response;
    }
}

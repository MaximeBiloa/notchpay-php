<?php

namespace Notchpay;

/**
 * Notch Pay PHP Wrapper
 * https://docs.notchpay.co
 *
 * @author  Chapdel KAMGA <drop@chapdel.me>
 * @version 1.0
 */

use Curl\Curl;

class Transaction
{
    public $curl;
    public $business_key;
    public $base_url = 'https://api.notchpay.co';

    /**
     * Create a new instance
     *
     * @param string $business_key      Your Notch Pay Business Key
     *
     * @throws \Exception
     */
    public function __construct($business_key = null)
    {
        if ($business_key != null) {
            $this->business_key = $business_key;
        }
        $this->curl = new Curl();
        $this->curl->setDefaultUserAgent();
        $this->curl->setHeader('X-Requested-With', 'XMLHttpRequest');
        $this->curl->setHeader('Accept', 'application/json');
        $this->curl->setHeader('Content-Type', 'application/json');
        $this->curl->setHeader('N-Authorization', $this->business_key);
    }

    /**
     * Set Business Key
     *
     * @param string $business_key    Notch Pay Business Key
     * @return void
     */

    public function setBusinessKey($business_key)
    {
        $this->business_key = $business_key;
    }

    /**
     * get Business Key
     *
     * @return string
     */

    public function getBusinessKey()
    {
        return $this->business_key;
    }

    /**
     * Init
     *
     * @param array $data   customer data
     * @return bool
     */
    public function init($data = [])
    {
        if (!$this->business_key) {
            throw new \Exception("business_key is required", 1);
        }
        if (!isset($data['amount'])) {
            throw new \Exception("amount is required", 1);
        }

        if (!isset($data['currency'])) {
            throw new \Exception("currency is required", 1);
        }


        $this->curl->post($this->base_url . "/checkout/initialize", $data);

        if ($this->curl->error) {

            throw new \Exception($this->curl->errorMessage, 1);
        }

        return $this->curl->response;
    }

    /**
     * Complete transaction
     *
     * @param array $data   customer data
     * @return bool
     */
    public function complete($reference, $gateway, $data = [])
    {
        if (!$this->business_key) {
            throw new \Exception("business_key is required", 1);
        }

        if (!isset($gateway)) {
            throw new \Exception("gateway is required", 1);
        }
        if (!isset($reference)) {
            throw new \Exception("reference is required", 1);
        }

        $this->curl->post($this->base_url . "/checkout/$reference", $data);

        if ($this->curl->error) {

            throw new \Exception($this->curl->errorMessage, 1);
        }

        return $this->curl->response;
    }

    /**
     * Fetch transaction
     *
     * @param string $reference  Transaction reference
     * @return object
     */
    public function fetch($reference)
    {
        if (!$this->business_key) {
            throw new \Exception("business_key is required", 1);
        }

        try {
            $this->curl->get($this->base_url . "/checkout/" . $reference);
        }
        catch (\Exception $e){
            throw new \Exception($this->curl->errorMessage, 1);
        } 

        return $this->curl->response;
    }

    /**
     * Cancel transaction
     *
     * @param string $reference  Transaction reference
     * @return object
     */
    public function cancel($reference)
    {
        if (!$this->business_key) {
            throw new \Exception("business_key is required", 1);
        }

        try {
            $this->curl->put($this->base_url . "/checkout/" . $reference);
        }
        catch (\Exception $e){
            // throw error
            throw new \Exception($this->curl->errorMessage, 1);
        }

        return $this->curl->response;
    }
}

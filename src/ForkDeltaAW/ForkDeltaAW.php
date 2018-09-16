<?php
namespace ForkDeltaAW;

class ForkDeltaAW
{
    const SYMBOL_DATA_URL = 'https://forkdelta.app/config/main.json';
    const TICKER_DATA_URL = 'https://api.forkdelta.com/returnTicker';

    private $symbol_data;
    private $ticker_data;

    public function getSymbolData()
    {
        if ($this->symbol_data) {
            return $this->symbol_data;
        }
        $handle = curl_init(self::SYMBOL_DATA_URL);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($handle);
        curl_close($handle);
        $decoded_result = json_decode($result, true);
        return ($this->symbol_data = $decoded_result['tokens']);
    }

    public function getTickerData()
    {
        if ($this->ticker_data) {
            return $this->ticker_data;
        }
        $handle = curl_init(self::TICKER_DATA_URL);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($handle);
        curl_close($handle);
        $decoded_result = json_decode($result, true);
        return ($this->ticker_data = $decoded_result);
    }

    public function getAddress($symbol)
    {
        foreach ($this->getSymbolData() AS $single_result) {

            if ($single_result['name'] == $symbol) {

                $return_result = $single_result['addr'];

            }

        }

        return $return_result;
    }

    public function getDecimals($symbol)
    {
        foreach ($this->getSymbolData() AS $single_result) {

            if ($single_result['name'] == $symbol) {

                $return_result = $single_result['decimals'];

            }

        }

        return $return_result;
    }

    public function printAddress($symbol)
    {
        echo $this->getAddress($symbol);
    }

    public function printDecimals($symbol)
    {
        echo $this->getDecimals($symbol);
    }

    public function printQuoteVolume($symbol)
    {
        $address = $this->getAddress($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['quoteVolume']);

            }

        }

    }

    public function printBaseVolume($symbol)
    {
        $address = $this->getAddress($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['baseVolume']);

            }

        }

    }

    public function printLastPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['last'], $decimals);

            }

        }

    }

    public function printBidPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['bid'], $decimals);

            }

        }

    }

    public function printAskPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['ask'], $decimals);

            }

        }

    }

    public function printUpdated($symbol)
    {
        $address = $this->getAddress($symbol);

        foreach ($this->getTickerData() AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo $single_result['updated'];

            }

        }

    }

}

<?php
namespace ForkDeltaAW;

class ForkDeltaAW
{
    public $symbol_data;
    public $ticker_data;

    public function __construct()
    {
        $this->symbol_data = $this->getSymbolData();
        $this->ticker_data = $this->getTickerData();
    }

    public function getSymbolData()
    {
        $full_url = 'https://raw.githubusercontent.com/forkdelta/forkdelta.github.io/master/config/main.json';
        $handle = curl_init($full_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handle);
        curl_close($handle);
        $decoded_result = json_decode($result, true);
        return $decoded_result['tokens'];
    }

    public function getTickerData()
    {
        $full_url = 'https://api.forkdelta.com/returnTicker';
        $handle = curl_init($full_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handle);
        curl_close($handle);
        $decoded_result = json_decode($result, true);
        return $decoded_result;
    }

    public function getAddress($symbol)
    {
        foreach ($this->symbol_data AS $single_result) {

            if ($single_result['name'] == $symbol) {

                $return_result = $single_result['addr'];

            }

        }

        return $return_result;
    }

    public function getDecimals($symbol)
    {
        foreach ($this->symbol_data AS $single_result) {

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

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['quoteVolume']);

            }

        }

    }

    public function printBaseVolume($symbol)
    {
        $address = $this->getAddress($symbol);

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['baseVolume']);

            }

        }

    }

    public function printLastPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['last'], $decimals);

            }

        }

    }

    public function printBidPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['bid'], $decimals);

            }

        }

    }

    public function printAskPrice($symbol)
    {
        $address = $this->getAddress($symbol);
        $decimals = $this->getDecimals($symbol);

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo number_format($single_result['ask'], $decimals);

            }

        }

    }

    public function printUpdated($symbol)
    {
        $address = $this->getAddress($symbol);

        foreach ($this->ticker_data AS $single_result) {

            if ($single_result['tokenAddr'] == $address) {

                echo $single_result['updated'];

            }

        }

    }

}

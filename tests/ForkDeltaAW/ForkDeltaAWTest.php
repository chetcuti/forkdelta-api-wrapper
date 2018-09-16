<?php

namespace Tests\ForkDeltaAW;

use ForkDeltaAW\ForkDeltaAW;
use phpmock\Mock;
use phpmock\MockBuilder;
use PHPUnit\Framework\TestCase;

class ForkDeltaAWTest extends TestCase
{
    /**
     * @var ForkDeltaAW
     */
    private $forkDeltaAw;

    /**
     * @var Mock
     */
    private $curlExecMock;

    /**
     * @var int
     */
    private $curlExecCallsCount;

    protected function setUp()
    {
        $this->curlExecMock = $this->buildCurlExecMock();
        $this->curlExecMock->enable();
        $this->forkDeltaAw = new ForkDeltaAW();
    }

    protected function tearDown()
    {
        $this->curlExecMock->disable();
    }

    public function testGetSymbolData()
    {
        $this->assertCount(3, $this->forkDeltaAw->getSymbolData());
    }

    public function testGetSymbolDataCaching()
    {
        // ensure that subsequent getSymbolData() calls don't reach out to a third-party server, but return a cached response instead
        $response = $this->forkDeltaAw->getSymbolData();
        $this->assertEquals($response, $this->forkDeltaAw->getSymbolData());
        $this->assertEquals(1, $this->curlExecCallsCount);
    }

    public function testGetTickerData()
    {
        $this->assertCount(3, $this->forkDeltaAw->getTickerData());
    }

    public function testGetTickerDataCaching()
    {
        // ensure that subsequent getTickerData() calls don't reach out to a third-party server, but return a cached response instead
        $response = $this->forkDeltaAw->getTickerData();
        $this->assertEquals($response, $this->forkDeltaAw->getTickerData());
        $this->assertEquals(1, $this->curlExecCallsCount);
    }

    public function testGetAddress()
    {
        $testCases = [
            'VERI' => '0x8f3470a7388c05ee4e7af3d01d8c722b0ff52374',
            'STORM' => '0xd0a4b8946cb52f0661273bfbc6fd0e0c75fc6433',
            'PPP' => '0xc42209accc14029c1012fb5680d95fbd6036e2a0',
        ];

        foreach ($testCases as $symbol => $expectedAddress) {
            $this->assertEquals($expectedAddress, $this->forkDeltaAw->getAddress($symbol));
        }
    }

    public function testGetDecimals()
    {
        $testCases = [
            'VERI' => 18,
            'STORM' => 17,
            'PPP' => 16,
        ];

        foreach ($testCases as $symbol => $expectedDecimals) {
            $this->assertEquals($expectedDecimals, $this->forkDeltaAw->getDecimals($symbol));
        }
    }

    public function testPrintAddress()
    {
        $testCases = [
            'VERI' => '0x8f3470a7388c05ee4e7af3d01d8c722b0ff52374',
            'STORM' => '0xd0a4b8946cb52f0661273bfbc6fd0e0c75fc6433',
            'PPP' => '0xc42209accc14029c1012fb5680d95fbd6036e2a0',
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printAddress($symbol);
        }
    }

    public function testPrintDecimals()
    {
        $testCases = [
            'VERI' => 18,
            'STORM' => 17,
            'PPP' => 16,
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printDecimals($symbol);
        }
    }

    public function testPrintQuoteVolume()
    {
        $testCases = [
            'VERI' => number_format('6512.045437'),
            'STORM' => number_format('8143792.405'),
            'PPP' => number_format('144064.3272'),
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printQuoteVolume($symbol);
        }
    }

    public function testPrintBaseVolume()
    {
        $testCases = [
            'VERI' => number_format('872.1074800'),
            'STORM' => number_format('391.7164147'),
            'PPP' => number_format('108.0143504'),
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printBaseVolume($symbol);
        }
    }

    public function testPrintLastPrice()
    {
        $testCases = [
            'VERI' => number_format('0.1317504230', 18),
            'STORM' => number_format('0.000048100000010000', 17),
            'PPP' => number_format('0.0007777305760', 16),
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printLastPrice($symbol);
        }
    }

    public function testPrintBidPrice()
    {
        $testCases = [
            'VERI' => number_format('0.131750423', 18),
            'STORM' => number_format('0.0000431440000', 17),
            'PPP' => number_format('0.000777', 16),
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printBidPrice($symbol);
        }
    }

    public function testPrintAskPrice()
    {
        $testCases = [
            'VERI' => number_format('0.133879999', 18),
            'STORM' => number_format('0.000080000', 17),
            'PPP' => number_format('0.0007687438959', 16),
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printAskPrice($symbol);
        }
    }

    public function testPrintUpdated()
    {
        $testCases = [
            'VERI' => '2018-06-11T13:24:22.350387',
            'STORM' => '2018-06-11T13:20:55.839597',
            'PPP' => '2018-06-11T13:20:40.801720',
        ];
        $this->expectOutputString(implode('', $testCases));

        foreach ($testCases as $symbol => $expectedOutput) {
            $this->forkDeltaAw->printUpdated($symbol);
        }
    }

    private function buildCurlExecMock()
    {
        return (new MockBuilder())
            ->setNamespace('ForkDeltaAW')
            ->setName('curl_exec')
            ->setFunction(function ($handle) {
                $this->curlExecCallsCount++;
                $requestedUrl = curl_getinfo($handle, CURLINFO_EFFECTIVE_URL);

                switch ($requestedUrl) {
                    case ForkDeltaAW::SYMBOL_DATA_URL:
                        return file_get_contents(__DIR__ . '/stubs/symbolData.json');
                    case ForkDeltaAW::TICKER_DATA_URL:
                        return file_get_contents(__DIR__ . '/stubs/tickerData.json');
                    default:
                        return '{}'; // an empty JSON object
                }
            })
            ->build();
    }
}

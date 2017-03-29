<?php
namespace Stadskle\PeriscopeData\Tests;

use Stadskle\PeriscopeData\EmbedUrl;

/**
 * Tests based on values given on periscope data wiki: https://doc.periscopedata.com/docv2/embed-api
 */
class EmbedUrlTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @var EmbedUrl
     */
    protected $client;

    protected function setUp()
    {
        $data = [
            'dashboard' => 7863,
            'embed' => 'v2',
            'filters' => [
                [
                    'name' => 'Filter1',
                    'value' => 'value1'
                ],
                [
                    'name' => 'Filter2',
                    'value' => '1234'
                ]
            ]
        ];
        
        $this->client = new EmbedUrl('e179017a-62b0-4996-8a38-e91aa9f1', $data);
    }

    public function testEncoding()
    {
        $this->assertEquals('%7B%22dashboard%22%3A7863%2C%22embed%22%3A%22v2%22%2C%22filters%22%3A%5B%7B%22name%22%3A%22Filter1%22%2C%22value%22%3A%22value1%22%7D%2C%7B%22name%22%3A%22Filter2%22%2C%22value%22%3A%221234%22%7D%5D%7D', $this->client->getEncodedData());
    }

    public function testSignature()
    {
        $this->assertEquals('adcb671e8e24572464c31e8f9ffc5f638ab302a0b673f72554d3cff96a692740', $this->client->getSignature());
    }

    public function testLink()
    {
        $this->assertEquals('https://www.periscopedata.com/api/embedded_dashboard?data=%7B%22dashboard%22%3A7863%2C%22embed%22%3A%22v2%22%2C%22filters%22%3A%5B%7B%22name%22%3A%22Filter1%22%2C%22value%22%3A%22value1%22%7D%2C%7B%22name%22%3A%22Filter2%22%2C%22value%22%3A%221234%22%7D%5D%7D&signature=adcb671e8e24572464c31e8f9ffc5f638ab302a0b673f72554d3cff96a692740', $this->client->getLink());
    }
}
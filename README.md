# Periscope Data embed API
PHP client for working with periscopedata API.

Simple client to work with periscopedata.com embed API. See https://doc.periscopedata.com/docv2/embed-api for details.


Code example showing same example as link above implemented in this client

```php
<?php
use Stadskle\PeriscopeData\EmbedUrl;
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
        
$client = new EmbedUrl('e179017a-62b0-4996-8a38-e91aa9f1', $data);
$url = $client->getLink();
?>
```
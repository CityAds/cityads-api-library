cityads-api
==================

A PHP wrapper around the CityAds REST API

Examples
-------

#### Request access token

* OAuth2

```php
// First step - get OAuth authorization url
$cityAdsApi = new CityAds_Api();
$authUrl = $cityAdsApi->getAuthorizeUrl($clientId, $redirectUri);
// redirect user to authUrl


// Second step - request an access token by OAuth2 code returned from authorization url
$result = $cityAdsApi->requestAccessToken($clientId, $clientSecret, $_GET['code'], $redirectUri);
```

#### Methods
There are 3 common methods to communicate with api:
```php
$cityAdsApi = new CityAds_Api();
$api = $cityAdsApi->setAccessToken( $accessToken );

// get results
$api->get( $methodName, (array)$params);

// create new entity
// $params - contains xml or json string
$api->post( $methodName, (string)$params);

// change entity
// $params - contains xml or json string
$api->put( $methodName, (string)$params);

//for example
$response = $api->setFormat('xml')
                ->get('offers',
                       array('type'      => 'web',
                             'start'     => 0,
                             'limit'     => 30,
                             'linksonly' => 'true'));
```
<?php

require_once dirname(__FILE__) . '/../sources/Api.php';

try {
    $rotatorData = '<createRotatorRequestData><name>ApiTest' . date("Y-m-d") . '</name><type>all</type></createRotatorRequestData>';

    $cityAdsApi = new CityAds_Api();
    $response = $cityAdsApi->setAccessToken('6420072d37bf14f1df182d0fe0efa2d9')
                            ->setFormat('xml')
                            ->post('rotator', $rotatorData);
    header("Content-type: text/xml; charset=utf-8");
    print_r($response);
} catch( Exception $ex ) {
    print_r("Code: " . $ex->getCode() . "; Message: " . $ex->getMessage());
}
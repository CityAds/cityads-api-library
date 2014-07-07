<?php

require_once dirname(__FILE__) . '/../sources/Api.php';

try {
    $cityAdsApi = new CityAds_Api();
    $response = $cityAdsApi->setAccessToken('6420072d37bf14f1df182d0fe0efa2d9')
                            ->setFormat('xml')
                            ->get('offers',
                                array('type' => 'web',
                                    'start' => 0,
                                    'limit' => 30,
                                    'linksonly' => 'true'));
    header("Content-type: text/xml; charset=utf-8");
    print_r($response);
} catch( Exception $ex ) {
    print_r("Code: " . $ex->getCode() . "; Message: " . $ex->getMessage());
}
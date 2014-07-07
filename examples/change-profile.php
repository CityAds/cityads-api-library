<?php

require_once dirname(__FILE__) . '/../sources/Api.php';
try {
    $newProfileData = '<setProfileRequestData><first_name>John</first_name><last_name>Smith</last_name><phone>9991112233</phone></setProfileRequestData>';

    $cityAdsApi = new CityAds_Api();
    $response = $cityAdsApi->setAccessToken('6420072d37bf14f1df182d0fe0efa2d9')
                            ->setFormat('xml')
                            ->put('profile', $newProfileData);
    header("Content-type: text/xml; charset=utf-8");
    print_r($response);
} catch( Exception $ex ) {
    print_r("Code: " . $ex->getCode() . "; Message: " . $ex->getMessage());
}
<?php

class CityAds_Curl {

    private $_userAgent;
    private $_timeout;

    /**
     * @param string $timeout
     * @return $this
     */
    public function setTimeOut( $timeout ) {
        $this->_timeout = $timeout;
        return $this;
    }

    public function getTimeOut() {
        if( !isset($this->_timeout) )
            $this->_timeout = 100;
        return $this->_timeout;
    }

    /**
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent( $userAgent ) {
        $this->_userAgent = $userAgent;
        return $this;
    }

    public function getUserAgent() {
        if( !isset($this->_userAgent) )
            $this->_userAgent = null;
        return $this->_userAgent;
    }

    public function __construct( $timeout = 100 ) {
        $this->setTimeOut($timeout);
        $this->setUserAgent('CityAds Api version 1.2');
    }

    private function initCurl( $url ) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->getUserAgent());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->getTimeOut());
        return $curl;
    }

    private function send($curl) {
        $return = curl_exec($curl);
        if( curl_errno($curl) ) {
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            throw new Exception('Request error: ' . curl_error($curl), $httpCode );
        }
        curl_close($curl);
        return $return;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function get( $url ) {
        $curl = $this->initCurl( $url );
        $return = $this->send( $curl );
        return $return;
    }

    /**
     * @param string $url
     * @param array $data
     * @return mixed
     */
    public function post( $url, $data ) {
        $curl = $this->initCurl( $url );
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $return = $this->send( $curl );
        return $return;
    }

    /**
     * @param string $url
     * @param array $data
     * @return mixed
     */
    public function put( $url, $data ) {
        $curl = $this->initCurl( $url );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $return = $this->send( $curl );
        return $return;
    }
}
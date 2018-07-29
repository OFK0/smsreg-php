<?php

/* 
    sms-reg.com api simple class
    All Methods: https://sms-reg.com/docs/APImethods.html
*/

class SMSREG
{
    private $API_URL = "http://api.sms-reg.com";
    public $api_key = null;

    public function __construct($key){
        if($key !== null){
            $this->api_key = $key;
        }else{
            print "[SMS-REG] API Key Required";
        }
    }

    /* 
        METHOD NAME: getNum
        RETURN: tzid
        Country code, service parameters are here: https://sms-reg.com/docs/APImethods.html?getNum
    */
    public function getNum($service, $country_code = "all", $appid = null){
        return $this->_response(
            $this->_request("getNum", [
                "country"=>$country_code,
                "service"=>$service,
                "appid"=>$app_id
            ]),
            "tzid"
        );
    }

    /* 
        METHOD NAME: setReady
        RETURN: all
    */
    public function setReady($tzid){
        return $this->_response(
            $this->_request("setReady", [
                "tzid"=>$tzid
            ])
        );
    }

    /* 
        METHOD NAME: getState
        RETURN: all
    */
    public function getState($tzid){
        return $this->_response(
            $this->_request("getState", [
                "tzid"=>$tzid
            ])
        );
    }

    /* 
        METHOD NAME: getState
        RETURN: all (operations array)
    */
    public function getOperations($count = 10, $opstate = "active", $output = "array"){
        return $this->_response(
            $this->_request("getOperations", [
                "count"=>$count,
                "opstate"=>$opstate,
                "output"=>$output
            ])
        );
    }

    /* 
        METHOD NAME: setOperationOk
        RETURN: all
    */
    public function setOperationOk($tzid){
        return $this->_response(
            $this->_request("setOperationOk", [
                "tzid"=>$tzid,
            ])
        );
    }

    /* 
        METHOD NAME: getNumRepeat
        RETURN: new tzid
    */
    public function getNumRepeat($tzid, $all = 0){
        return $this->_response(
            $this->_request("getNumRepeat", [
                "tzid"=>$tzid,
            ]),
            ($all == 0 ? "tzid" : null)
        );
    }

    /* 
        METHOD NAME: getNumRepeatOffline
        RETURN: all
    */
    public function getNumRepeatOffline($params){
        return $this->_response(
            $this->_request("getNumRepeatOffline", $params)
        );
    }

    /* 
        METHOD NAME: setOperationUsed
        RETURN: tzid
    */
    public function setOperationUsed($tzid){
        return $this->_response(
            $this->_request("getNumRepeatOffline", [
                "tzid"=>$tzid
            ]),
            "tzid"
        );
    }

    /* 
        METHOD NAME: getBalance
        RETURN: balance
    */
    public function getBalance(){
        return $this->_response(
            $this->_request("getBalance"),
            "balance"
        );
    }

    /* 
        METHOD NAME: setRate
        RETURN: rate
    */
    public function setRate($rate){
        return $this->_response(
            $this->_request("setRate"),
            "rate"
        );
    }

    private function _response($x, $y = null){
        if($y != null){
            if(isset($x->$y)):
                return $x->$y;
            endif;
        }
        return $x;
    }

    private function _request($method_name, $params = null){
        return json_decode(
            $this->_curl(
                $this->_apiUrl($method_name, ($params != null ? http_build_query($params) : null))
            )
        );
    }

    private function _apiUrl($method_name, $query_string = null){
        return $this->API_URL . "/" . $method_name . ".php?apikey=" . $this->api_key . ($query_string != null ? "&" . $query_string : null);
    }

    private function _curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function _debug($things){
        echo '<pre>';
        print_r($things);
        echo '</pre>';
    }

}

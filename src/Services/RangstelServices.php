<?php

namespace Arifsajal\RangstelSmsGateway\Services;

use GuzzleHttp\Client;

class RangstelServices
{
    protected $config;

    protected $username;

    protected $password;

    protected $fullApiUrl = "http://api.rankstelecom.com/api/v3/sendsms/plain";

    protected $contacts;

    protected $message;

    protected $contactsString;

    protected $sender;

    protected $apiResponse;

    protected $formattedServerResponse;

    public function contacts($contacts){
        if(is_string($contacts)):
            $this->contacts = $contacts;
        elseif(is_array($contacts)):
            $this->contacts = $contacts;
        endif;

        if(is_array($contacts) && count($contacts) > 0):
            $string = "";
            foreach($contacts as $contact):
                $string .= $contact.',';
            endforeach;
            $this->contactsString = str_replace('+','',rtrim($string,','));
        else:
            $this->contactsString = str_replace('+','',$contacts);
        endif;

        return $this;
    }

    public function message($message){
        if($message):
            $this->message = $message;
        endif;
        return $this;
    }

    public function sender($sender){
        if($sender):
            $this->sender = $sender;
        endif;
        return $this;
    }

    public function send(){
        $queries = ['GSM'=>$this->contactsString,'SMSText'=>$this->message,'user'=>$this->username,'password'=>$this->password,'output'=>'json'];
        $client = new Client();

        $response = $client->request('GET',$this->fullApiUrl,['query'=>$queries]);
        $this->apiResponse = ['statusCode'=>$response->getStatusCode(),'reasonPhrase'=>$response->getReasonPhrase(),'serverResponse'=>$response->getBody()->getContents()];
        return $this;
    }

    public function config($array){
        $this->__setConfig($array);
        return $this;
    }

    public function formatServerResponse(){
        return json_decode($this->apiResponse['serverResponse']);
    }

    protected function __setConfig($array){
        if(array_key_exists('username',$array) && array_key_exists('password',$array)):
            $this->config = $array;
            $this->username = $array['username'];
            $this->password = $array['password'];

            if(array_key_exists('full_api_url',$array)):
                $this->fullApiUrl = $array['full_api_url'];
            endif;

        endif;
        return $this;
    }
}
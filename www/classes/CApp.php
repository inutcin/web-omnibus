<?php
    require_once("CMessage.php");

    class CApp
    {
        private $answer = [
            "errors"=>[]
        ];

        private $arMethods = [
            "getProjects"=>"__getProjects"
        ];

        function exec($sRequest){
            $arRequest = json_decode($sRequest);
            if(!$arRequest){
                $this->__setError(CMessage::Error("WRONG_JSON_REQUEST"));
                return false;
            }
            $arRequest = json_decode(json_encode((array)$arRequest),TRUE);
            if(!isset($arRequest["METHOD"])){
                $this->__setError('REQUEST_METHOD_NOT_DEFINED');
                return false;
            }
            $sMethod = $arRequest["METHOD"];
            if(!isset($this->arMethods[$sMethod])){
                $this->__setError('REQUEST_UNDEFINED_METHOD');
                return false;
            }
            $this->answer["request"] = $arRequest;
            $sEcexMethod = $this->arMethods[$sMethod];
            $this->__setResult($this->$sEcexMethod($arRequest));
            return true;
        }

        function CheckSubscribe($nAppId,$sSubscribe,$sRequest){
            $arApp = $this->GetById($nAppId);
            $key = $arApp["key"];
            $sNeedSubscribe = hash_hmac (
                "sha256", 
                trim($sRequest),
                $key
            );

            if($sNeedSubscribe!=$sSubscribe){
                $this->__setError(CMessage::Message('REQUEST_SUBSCRIBE_ERROR'));
                return false; 
            }
            return true;
        }

        function Add($sName, $sKey, $arParams=array()){
            return $_SERVER["DB"]->insert(
                "o_O_apps",
                [
                    "name"=>$sName,
                    "key"=>$sKey
                ]
            );
        }

        function GetById($nId){
            if($_SERVER["DB"]->search_one( "o_O_apps",["id"=>$nId]))
                return $_SERVER["DB"]->record;
            return false;
        }

        function getAnswer(){
            return json_encode($this->answer);
        }

        private function __setError($text){
            $this->answer["errors"][] = $text;
        }

        private function __setResult($arResult){
            $this->answer["result"] = $arResult;
        }
        ///////////////////////////////////////////////////////
        private function __getProjects($arRequest){

            $_SERVER["DB"]->search(
                array("a"=>"o_O_projects")
            );

            return [
                "1"=>2
            ];
        }
    }

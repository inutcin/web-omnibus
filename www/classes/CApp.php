<?php
    require_once("CMessage.php");
    require_once("CUser.php");

    class CApp
    {

        private $oUser = [];
        private $answer = [
            "errors"=>[]
        ];

        private $arMethods = [
            "getProjects"   =>  "__methodGetProjects",
            "login"         =>  "__methodLogin",
            "getProfile"    =>  "__methodGetProfile"
        ];

        function __construct(){
            $this->oUser = new CUser;
        }


        function exec($sRequest){
            $arRequest = json_decode($sRequest);
            if(!$arRequest){
                $this->__setError(CMessage::Error("WRONG_JSON_REQUEST"));
                return false;
            }
            $arRequest = json_decode(json_encode((array)$arRequest),TRUE);
            if(!isset($arRequest["METHOD"])){
                $this->__setError(CMessages::Error(
                    'REQUEST_METHOD_NOT_DEFINED'
                ));
                return false;
            }
            $sMethod = $arRequest["METHOD"];
            if(!isset($this->arMethods[$sMethod])){
                $this->__setError(CMessage::Error(
                    'REQUEST_UNDEFINED_METHOD'
                )." &laquo;".$sMethod."&raquo;");
                return false;
            }
            $arUser = [];
            if(
                $sMethod!='login'
                &&
                !$arUser = $this->oUser->getSessionIfNotExpire(
                    $arRequest["SESSION_ID"]
                )
            ){
                $this->__setError(CMessage::Error('SESSION_NOT_FOUND'));
                return false;
            }
            
            if(isset($_GET["debug"]))
                $this->answer["request"] = $arRequest;
            $sEcexMethod = $this->arMethods[$sMethod];

            $this->__setResult($this->$sEcexMethod($arRequest, $arUser));
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
                $this->__setError(CMessage::Error(
                    'REQUEST_SUBSCRIBE_ERROR'
                ));
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

        private function __methodGetProfile($arRequest, $arUser){
            return [
                "id"        =>  $arUser["id"],
                "username"  =>  $arUser["username"],
                "expires_to"=>  $arUser["expires_to"]
            ];
        }


        private function __methodLogin($arRequest){
            if(!$arUser = $this->oUser->CheckAuth(
                $arRequest["USERNAME"],
                $arRequest["PASSWORD"]
            )){
                $this->__setError(CMessage::Error(
                    "LOGIN_INCORRECT"
                ));
                return [];
            }
            $this->oUser->Auth($arUser["id"]);

            $arUser = $this->oUser->getById($arUser["id"]);

            return [
                "session_id"=>$arUser["session_id"]
            ];
        }

        private function __methodGetProjects($arRequest, $arUser){
            require_once("CProjects.php");
            $oProject = new CProject;
            $arParams = [];
            return $oProject->GetList($arParams);
        }
    }

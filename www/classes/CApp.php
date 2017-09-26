<?php
    require_once("CAll.php");
    require_once("CMessage.php");
    require_once("CUser.php");

    class CApp extends CAll
    {

        private $oUser = [];
        private $answer = [
            "errors"=>[]
        ];

        private $arMethods = [
            "getProjects"   =>  "__methodGetProjects",
            "login"         =>  "__methodLogin",
            "getProfile"    =>  "__methodGetProfile",
            "addProject"    =>  "__methodAddProject",
            "getProject"    =>  "__methodGetProject",
            "saveProject"   =>  "__methodSaveProject",
            "deleteProject"   =>  "__methodDeleteProject",
        ];

        function __construct(){
            $this->oUser = new CUser;
        }


        function exec($sRequest){
            $arRequest = json_decode($sRequest);
            if(!$arRequest){
                $this->__setError(CMessage::Error("WRONG_JSON_REQUEST"));
                $this->answer["errors"] = $this->getErrors();
                return false;
            }
            $arRequest = json_decode(json_encode((array)$arRequest),TRUE);
            if(!isset($arRequest["METHOD"])){
                $this->__setError(CMessages::Error(
                    'REQUEST_METHOD_NOT_DEFINED'
                ));
                $this->answer["errors"] = $this->getErrors();
                return false;
            }
            $sMethod = $arRequest["METHOD"];
            if(!isset($this->arMethods[$sMethod])){
                $this->__setError(CMessage::Error(
                    'REQUEST_UNDEFINED_METHOD'
                )." &laquo;".$sMethod."&raquo;");
                $this->answer["errors"] = $this->getErrors();
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
                $this->answer["errors"] = $this->getErrors();
                return false;
            }
            
            if(isset($_GET["debug"]))
                $this->answer["request"] = $arRequest;
            $sEcexMethod = $this->arMethods[$sMethod];

            if(method_exists(__CLASS__,$sEcexMethod)){
                $this->__setResult($this->$sEcexMethod($arRequest, $arUser));
            }
            else{
                $this->__setError(CMessage::Error(
                    "Handler for method not defined"
                ));
                $this->answer["errors"] = $this->getErrors();
                return false;
            }
            $this->answer["errors"] = $this->getErrors();
                
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

        private function __setResult($arResult){
            $this->answer["result"] = $arResult;
        }
        ///////////////////////////////////////////////////////

        private function __methodSaveProject($arRequest, $arUser){
            if(
                !isset($arRequest["ID"])
                ||
                !$arRequest["ID"]
            ){
                $this->__setError(CMessage::Error('Project ID not defined'));
                return false;
            }
            if(
                !isset($arRequest["NAME"])
                ||
                !$arRequest["NAME"]
            ){
                $this->__setError(CMessage::Error('Project name not defined'));
                return false;
            }

            require_once("CProjects.php");
            $oProject = new CProject;
            if(!$arProject=$oProject->Update($arRequest["ID"],[
                "name"=>$arRequest["NAME"]
            ])){
                $this->__setError($oProject->getErrors());
                return false;
            }
 
            return 'success';
        }

        private function __methodDeleteProject($arRequest, $arUser){
            
            if(
                !isset($arRequest["ID"])
                ||
                !$arRequest["ID"]
            ){
                $this->__setError(CMessage::Error('Project ID not defined'));
                return false;
            }

            require_once("CProjects.php");
            $oProject = new CProject;

            if(!$arProject=$oProject->Delete($arRequest["ID"])){
                $this->__setError($oProject->getErrors());
                return false;
            }

            return "success";
        }

        private function __methodGetProject($arRequest, $arUser){
            
            if(
                !isset($arRequest["ID"])
                ||
                !$arRequest["ID"]
            ){
                $this->__setError(CMessage::Error('Project ID not defined'));
                return false;
            }

            require_once("CProjects.php");
            $oProject = new CProject;

            $arProject = [];
            if(!$arProject=$oProject->GetById($arRequest["ID"])){
                $this->__setError($oProject->getErrors());
                return false;
            }

            return $arProject;
        }


        private function __methodAddProject($arRequest, $arUser){
            
            if(
                !isset($arRequest["NAME"])
                ||
                !$arRequest["NAME"]
            ){
                $this->__setError(CMessage::Error('Project name not defined'));
                return false;
            }

            require_once("CProjects.php");
            $oProject = new CProject;
           
            if(!$nId=$oProject->Add([
                "name"=>$arRequest["NAME"]
            ])){
                $this->__setError($oProject->getErrors());
                return false;
            }

            return [
                "id"        =>  $nId,
            ];
        }


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

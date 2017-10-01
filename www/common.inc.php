<?php
    require_once("bootstrap.php");
    require_once("classes/CTemplate.php");
    require_once("classes/CRequest.php");
    require_once("classes/xprint.class.php");
   
    $arResult = array();
    $oTemplate = new CTemplate;
    $oRequest= new CRequest;

    if(isset($_GET["logout"])){
        setCookie(CRequest::cookie_session,"none");
        header("Location: /");
        die;
    }

    if(
        isset($_POST["username"])
        &&
        isset($_POST["password"])
    ){
        $oRequest->clearParams(); 
        $oRequest->setMethod("login");
        $oRequest->addParam('USERNAME',$_POST['username']);
        $oRequest->addParam('PASSWORD',$_POST['password']);
        $arAnswer = $oRequest->request();
        if(
            isset($arAnswer["errors"])
            &&
            is_array($arAnswer["errors"])
            &&
            $arAnswer["errors"]
        ){
            $arResult["ERROR"] = implode("<br>",$arAnswer["errors"]);
        }
        else{
            setCookie(
                CRequest::cookie_session,
                $arAnswer["result"]["session_id"]
            );
            header("Location: ".$_SERVER["REQUEST_URI"]);
        }
        
    }
    else{
        $oRequest->clearParams(); 
        $oRequest->setMethod("getProfile");
        $arAnswer = $oRequest->request();
        if(
            isset($arAnswer["errors"])
            &&
            is_array($arAnswer["errors"])
            &&
            $arAnswer["errors"]
        ){
            $arResult["ERROR"] = implode("<br>",$arAnswer["errors"]);
            $oTemplate->display("login_form", $arResult);
            die;
        }
    }
    


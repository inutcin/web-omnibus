<?php
    require_once("bootstrap.php");
    require_once("classes/CTemplate.php");
    require_once("classes/CRequest.php");
   
    $arResult = array();
    $oTemplate = new CTemplate;
    $oRequest= new CRequest;

    if(isset($_GET["logout"])){
        $_SERVER["USER"]->Logout();
        header("Location: /");
        die;
    }


    if(
        isset($_POST["username"])
        &&
        isset($_POST["password"])
        &&
        $arUserInfo = $_SERVER["USER"]->CheckAuth(
            $_POST["username"],
            $_POST["password"]
        )
    ){
        $_SERVER["USER"]->Auth($arUserInfo["id"]);
		header("Location: ".$_SERVER["REQUEST_URI"]);
		die;
    }
    elseif(
        isset($_POST["username"])
        &&
        isset($_POST["password"])
    ){
        $arResult["ERROR"] = CMessage::Error('AUTH_ERROR');
    }

    if(!$_SERVER["USER"]->getUserInfo()){
        $oTemplate->display("login_form", $arResult);
        die;
    }
    


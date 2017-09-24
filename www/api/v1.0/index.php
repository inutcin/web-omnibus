<?
    require_once(realpath(dirname(__FILE__)."/../..")."/bootstrap.php");
    require_once(realpath(dirname(__FILE__)."/../..")."/classes/CApp.php");

    if(!isset($_GET["appid"]) && !intval($_GET["appid"]))$_GET["appid"] = 1;
    if(!isset($_GET["subscribe"]) && !intval($_GET["subscribe"]))
        $_GET["subscribe"] = '';
    if(!isset($_POST["request"]))$_POST["request"] = '[]';

        

    $oApp = new CApp;
    if(!$oApp->CheckSubscribe(
       $_GET["appid"],
       $_GET["subscribe"],
       $_POST["request"]
    )){
        echo $oApp->getAnswer();
    }
    else{
        
        $oApp->exec($_POST["request"]);
        echo $oApp->getAnswer();
    }

    
    

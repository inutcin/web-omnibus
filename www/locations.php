<?php
    require("common.inc.php");

    $arResult["ACT"] = isset($_GET["act"])?$_GET['act']:'list';

    switch($arResult["ACT"]){
        case 'info':
            $oRequest->clearParams();
            $oRequest->setMethod("infoLocation");
            $oRequest->addParam("ID", intval($_GET["id"]));
            $arAnswer = $oRequest->request();
            if(
                isset($arAnswer["errors"]) 
                && is_array($arAnswer["errors"])
                && $arAnswer["errors"]
                
            ){
                $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
            }
            else{
                $arResult["INFO"] = $arAnswer['result'];
            }
        break;
        default:
        break;
    }



    $oTemplate->display("locations",$arResult);

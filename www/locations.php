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

            if(
                isset($_POST["add_access_type"])
                &&
                !intval($_POST["add_access_type"])
            ){
                $arResult["ERROR"] = CMessage::UI(
                    'Select access type'
                );
            }
            elseif(
                isset($_POST["add_access_name"])
                &&
                !$_POST["add_access_name"]
            ){
                $arResult["ERROR"] = CMessage::UI(
                    'Select access name'
                );
            }
            elseif(
                isset($_POST["add_access_name"])
                &&
                isset($_POST["add_access_type"])
                &&
                isset($_GET["id"])
            ){
                $oRequest->clearParams();
                $oRequest->setMethod("addAccess");
                $oRequest->addParam("LOCATION_ID", intval($_GET["id"]));
                $oRequest->addParam("ACCESS_NAME", 
                    $_POST["add_access_name"]);
                $oRequest->addParam("ACCESS_TYPE", 
                    $_POST["add_access_type"]);
                $arAnswer = $oRequest->request();
                if(
                    isset($arAnswer["errors"]) 
                    && is_array($arAnswer["errors"])
                    && $arAnswer["errors"]
                    
                ){
                    $arResult["ERROR"] = implode("<br/>",
                        $arAnswer["errors"]
                    );
                }
                else{
                    header("Location: /accesses.php?act=edit&id="
                        .$arAnswer["result"]["id"]
                    );
                    die;
                }
            }
        break;
        case 'delete':
            $oRequest->clearParams();
            $oRequest->setMethod("deleteLocation");
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
                header("Location: /projects.php?act=info&id="
                .$arAnswer["result"]["project_id"]);
                die;
            }

        break;
        case 'edit':
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
            $oRequest->clearParams();
            $oRequest->setMethod("getLocationTypes");
            $arAnswer = $oRequest->request();
            if(
                isset($arAnswer["errors"]) 
                && is_array($arAnswer["errors"])
                && $arAnswer["errors"]
                
            ){
                $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
            }
            else{
                $arResult["TYPES"] = $arAnswer['result'];
            }

            if(
                isset($arResult["INFO"]["location"]["id"])
                &&
                $arResult["INFO"]['location']["id"]
                &&
                isset($_POST["name"]) && $_POST["name"]
                &&
                isset($_POST["type_id"]) && $_POST["type_id"]
            ){
                $oRequest->clearParams();
                $oRequest->setMethod("saveLocation");
                $oRequest->addParam("ID", $arResult["INFO"]["location"]["id"]);
                $oRequest->addParam("NAME",$_POST["name"]);
                $oRequest->addParam("TYPE_ID",intval($_POST["type_id"]));
                $arAnswer = $oRequest->request();
                if(
                    isset($arAnswer["errors"]) 
                    && is_array($arAnswer["errors"])
                    && $arAnswer["errors"]
                    
                ){
                    $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
                }
                else{
                    header("Location: /projects.php?act=info&id="
                        .$arResult["INFO"]["project"]["id"]);
                    die;
                }

            }

        break;
        default:
        break;
    }



    $oTemplate->display("locations",$arResult);

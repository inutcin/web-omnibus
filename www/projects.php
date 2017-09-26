<?php
    require("common.inc.php");

    $arResult["ACT"] = isset($_GET["act"])?$_GET['act']:'list';

    switch($arResult["ACT"]){
        case 'list':
            if(isset($_POST["name"]) && $_POST["name"]){
                $oRequest->clearParams();
                $oRequest->setMethod("addProject");
                $oRequest->addParam("NAME", $_POST["name"]);
                $arAnswer = $oRequest->request();
                if(
                    isset($arAnswer["errors"]) 
                    && is_array($arAnswer["errors"])
                    && $arAnswer["errors"]
                    
                ){
                    $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
                }
                elseif(
                    isset($arAnswer["result"]["id"]) 
                    && intval($arAnswer["result"]["id"])
                ){
                    header("Location: /projects.php?act=edit&id=".
                        $arAnswer["result"]["id"]
                    );
                    die;
                }
                else{
                    $arResult["ERROR"] = CMessage::Error(
                        'Unknown project creation error'
                    )
//                    .json_encode($arAnswer);
                    ;
                }
            }
            $oRequest->clearParams();
            $oRequest->setMethod("getProjects");
            $oRequest->addParam("PAGE", 1);
            $arAnswer = $oRequest->request();
            $arResult["PROJECTS"]   = $arAnswer['result']["rows"];
            $arResult["PAGES"]      = $arAnswer['result']['pages'];
        break;
        case 'edit':
            $oRequest->clearParams();
            $oRequest->setMethod("getProject");
            $oRequest->addParam("ID", intval($_GET["id"]));
            $arAnswer = $oRequest->request();
            if(
                isset($arAnswer["errors"]) 
                && is_array($arAnswer["errors"])
                && $arAnswer["errors"]
                
            ){
                $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
            }
			$arResult["PROJECT"] = 
                isset($arAnswer['result'])
                ?
                $arAnswer['result']
                :
                array()
            ;
            if(
                isset($arResult["PROJECT"]["id"])
                &&
                $arResult["PROJECT"]["id"]
                &&
                isset($_POST["name"]) && $_POST["name"]
            ){
                $oRequest->clearParams();
                $oRequest->setMethod("saveProject");
                $oRequest->addParam("ID", intval($_GET["id"]));
                $oRequest->addParam("NAME",$_POST["name"]);
                $arAnswer = $oRequest->request();
                if(
                    isset($arAnswer["errors"]) 
                    && is_array($arAnswer["errors"])
                    && $arAnswer["errors"]
                    
                ){
                    $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
                }
                else{
                    header("Location: /projects.php?act=list");
                    die;
                }

            }
        break;
        case 'delete':
            $oRequest->clearParams();
            $oRequest->setMethod("deleteProject");
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
                header("Location: /projects.php?act=list");
            }
        break;
        case 'info':

            if(
                isset($_POST["add_location_name"])
                &&
                isset($_POST["add_location_type"])
                &&
                isset($_GET["id"])
            ){
                $oRequest->clearParams();
                $oRequest->setMethod("addLocation");
                $oRequest->addParam("PROJECT_ID", intval($_GET["id"]));
                $oRequest->addParam("LOCATION_NAME", 
                    $_POST["add_location_name"]);
                $oRequest->addParam("LOCATION_TYPE", 
                    $_POST["add_location_type"]);
                $arAnswer = $oRequest->request();
                if(
                    isset($arAnswer["errors"]) 
                    && is_array($arAnswer["errors"])
                    && $arAnswer["errors"]
                    
                ){
                    $arResult["ERROR"] = implode("<br/>",$arAnswer["errors"]);
                }
                else{
                    header("Location: /locations.php?act=edit&id="
                        .$arAnswer["result"]["id"]
                    );
                    die;
                }
            }

            $oRequest->clearParams();
            $oRequest->setMethod("infoProject");
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



    $oTemplate->display("projects",$arResult);

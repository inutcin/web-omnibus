<?php
    require("common.inc.php");

    $sAct = isset($_GET["act"])?$_GET['act']:'list';

    switch($sAct){
        case 'list':
            $oRequest->clearParams();
            $oRequest->setMethod("getProjects");
            $oRequest->addParam("PAGE", 1);
            $oRequest->request();
            echo "<pre>";
            print_r($oRequest);
            echo "</pre>";
        break;
        default:
        break;
    }



    $oTemplate->display("projects");

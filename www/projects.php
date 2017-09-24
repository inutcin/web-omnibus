<?php
    require("common.inc.php");
   
    $oRequest->clearParams();
    $oRequest->setMethod("getProjects");
    $oRequest->addParam("PAGE", 1);
    $oRequest->request();
    echo "<pre>";
    print_r($oRequest);
    echo "</pre>";


    $oTemplate->display("projects");

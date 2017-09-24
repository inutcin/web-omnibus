<?php
    class CTemplate
    {
        var $sTmplDir = '';

        function __construct(){
            $this->sTmplDir = $_SERVER["DOCUMENT_ROOT"]."/templates";
        }

        function display(
            $sName,
            $arResult = array()
        ){
            include($this->sTmplDir."/".$sName.".tmpl.php");
        }
    }

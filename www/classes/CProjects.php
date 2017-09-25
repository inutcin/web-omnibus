<?php

    class CProject{

        private $nRecordsOnPage = 20;

        function GetList($arParams){
            if(!isset($arParams["OFFSET"]))
                $arParams["OFFSET"] = 0;
            if(!isset($arParams["RECORDS_ON_PAGE"]))
                $arParams["RECORDS_ON_PAGE"] = $this->nRecordsOnPage;
            if(!isset($arParams["SORTING"]))
                $arParams["SORTING"] = '`a`.`name`';
            if(!isset($arParams["ORDER"]))
                $arParams["ORDER"] = 'ASC';

            $arProjects = $_SERVER["DB"]->search(
                array("a"=>"o_O_projects"),
                array(),
                array()
            );


        }
    }

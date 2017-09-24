<?php

    class CProject{

        private $nRecordsOnPage = 20;

        function GetList(
            $arParams
            $nPage,
            $nRecordsOnPage = ''
        ){
            if(!isset($arParams["OFFSET"]))
                $arParams["OFFSET"] = 0;
            if(!isset($arParams["RECORDS_ON_PAGE"]))
                $arParams["RECORDS_ON_PAGE"] = 20;
            if(!isset($arParams["SORTING"]))
                $arParams["SORTING"] = '`a`.`name`';
            if(!isset($arParams["ORDER"]))
                $arParams["ORDER"] = 'ASC';

            if(!$nRecordsOnPage)
                $nRecordsOnPage = $this->nRecordsOnPage;

            $arProjects = $_SERVER["DB"]->search(
                array("o_O_projects"=>"a"),
                array(),
                array()
            );


        }
    }

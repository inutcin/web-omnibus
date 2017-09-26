<?php
    require_once("CAll.php");

    class CProject extends CAll
    {

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

            $_SERVER["DB"]->search(
                array("a"=>"o_O_projects"),
                array(),
                array()
            );

            return [
                "rows"  =>  $_SERVER["DB"]->rows,
                "pages" =>  $_SERVER["DB"]->pages
            ];
        }

        function Delete($nId){
            $_SERVER["DB"]->delete("o_O_projects",["id"=>$nId]);
            return true;
        }

        function GetById($nId){
            if(!$_SERVER["DB"]->search_one("o_O_projects",[
                "id"=>$nId
            ])){
                $this->__setError(CMessage::Error(
                    'Project #'.$nId.' not found'
                ));
                return false;
            }
            return $_SERVER["DB"]->record;
        }

        function Add($arParams){
            if($nId = $_SERVER["DB"]->insert("o_O_projects", $arParams))
                return $nId;
            $this->__setError(CMessage::Error('Can not create project'));
            return false;
        }

        function Update($nId, $arParams){
            if($nId = $_SERVER["DB"]->update("o_O_projects", $arParams,[
                "id"=>$nId
            ]))return ["id"=>$nId];
            return false;
        }


    }

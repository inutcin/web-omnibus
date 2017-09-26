<?php
    require_once("CAll.php");

    class CLocationType extends CAll{

        function GetList(){
            $_SERVER["DB"]->search(
                ["a"=>"o_O_location_types"]
            );
            return $_SERVER["DB"]->rows;
        }

        function GetById($nId){
            return $_SERVER["DB"]->search_one("o_O_location_types",[
                "id"=>$nId
            ]);
        }
    }
    

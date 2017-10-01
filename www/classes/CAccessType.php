<?php
    
class CAccessType
{
    function GetList(){
        $_SERVER["DB"]->rows = array();
        $_SERVER["DB"]->search(
            ["a"=>"o_O_access_types"],[],[],"","`a`.`order` ASC,`a`.`id` ASC"
        );
        return $_SERVER["DB"]->rows;
    }
}


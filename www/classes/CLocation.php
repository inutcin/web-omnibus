<?php
    require_once("CAll.php");

    class CLocation extends CAll{

        function GetList($nProjectId){
            $_SERVER["DB"]->search(
                [
                    "a"=>"o_O_locations",
                    "b"=>"o_O_location_types",
                ],
                [
                    "`a`.`type_id`=`b`.`id`"=>"LEFT",
                ],
                [
                    "project_id"=>intval($nProjectId),
                ],
                "","",0,0,[
                    "`a`.`id`"      =>  "id",
                    "`a`.`type_id`" =>  "type_id",
                    "`b`.`name`"    =>  "type_name",
                    "`a`.`name`"    =>  "name",
                ]
            );
            return $_SERVER["DB"]->rows;
        }

        function Add($arFields){
            return $_SERVER["DB"]->insert("o_O_locations", $arFields);
        }

        function Update($nId, $arFields){
            return $_SERVER["DB"]->update(
                "o_O_locations", $arFields, ["id"=>$nId]
            );
        }

        function Delete($nId){
            return $_SERVER["DB"]->delete(
                "o_O_locations", ["id"=>$nId]
            );
        }

        function Info($nId){
            $arLocation = $this->GetById($nId);
            require_once("CProjects.php");
            $oProject = new CProject;
            $arProject = $oProject->GetById($arLocation["project_id"]);
            return [
                "project"   =>  $arProject,
                "location"  =>  $arLocation,
                "accesses"  =>  []
            ];
        }

        function GetById($nId){
            if(!$_SERVER["DB"]->search_one("o_O_locations",["id"=>$nId]))
                return false;
            return $_SERVER["DB"]->record;
        }
    }
    

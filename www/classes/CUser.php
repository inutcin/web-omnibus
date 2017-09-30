<?php
    
class CUser{

    private $sessionExpire = 3600; // ExpireTime in seconds
    private $arUserInfo = [];

    function __construct(){
        if($_SERVER["DB"]->search_one("o_O_users", [],
            "
                `session_id`='".session_id()."'
                AND `ip`='".$_SERVER["REMOTE_ADDR"]."'
                AND `expires_to`>'".gmdate("Y-m-d H:i:s")."'
            "
        ))$this->arUserInfo = $_SERVER["DB"]->record;

    }

    function getUserInfo(){
        return $this->arUserInfo;
    }

    /**
        @return массива параметров пользователя , к которому подошли логин и 
        пароль
    */
    function CheckAuth(
        $sUsername,
        $sPassword
    ){
        if($_SERVER["DB"]->search_one(
            "o_O_users",
            [
                "username"=>$sUsername,
                "password"=>$this->__getPasswordHash($sUsername, $sPassword)
            ]
        )){
            $_SERVER["DB"]->Update("o_O_Users",[
                "expires_to"=>gmdate("Y-m-d H:i:s",time()+$this->sessionExpire)
            ],[
                "id"=>$_SERVER["DB"]->record["id"]
            ]);
            return $_SERVER["DB"]->record;
        }
        return false;
    }


    function Add(
        $sUsername,
        $sPassword
    ){
        $arFields = [
            "username"=>$sUsername,
            "password"=>$this->__getPasswordHash($sUsername, $sPassword),
        ];

        $_SERVER["DB"]->insert("o_O_users",$arFields);
        
    }

    function Auth(
        $nUserId
    ){
        $_SERVER["DB"]->Update(
            "o_O_users",
            [
                "session_id"=>sha1(time().rand().$_SERVER["REMOTE_ADDR"]),
                "last_login"=>gmdate("Y-m-d H:i:s"),
                "expires_to"=>gmdate(
                    "Y-m-d H:i:s",
                    time()+$this->sessionExpire
                ),
                "ip"=>$_SERVER["REMOTE_ADDR"]
            ],
            [
                "id"=>$nUserId
            ]
        );

        $this->arUserInfo = $this->getById($nUserId);
    }

    function Logout($nUserId=''){
        if(!$nUserId && isset($this->arUserInfo["id"])){
            $nUserId = $this->arUserInfo["id"];
        }

        if($nUserId)
        $_SERVER["DB"]->Update(
            "o_O_users",
            [
                "session_id"=>'none',
            ],
            [
                "id"=>$nUserId
            ]
        );
    }

    function getById($nUserId){
        if($_SERVER["DB"]->search_one(
            "o_O_users",
            [
                "id"=>$nUserId
            ]
        ))return $_SERVER["DB"]->record;
    }

    function getSessionIfNotExpire($sSessionId){
        if($_SERVER["DB"]->search_one(
            "o_O_users",[],
            "session_id='".$sSessionId."' AND `expires_to`>'"
            .gmdate("Y-m-d H:i:s")."'"
        ))return $_SERVER["DB"]->record;
    }

    function __getPasswordHash($sUsername, $sPassword){
        return sha1($sUsername.$sPassword);
    }
}

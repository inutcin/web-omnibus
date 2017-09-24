<?php
    require_once(realpath(dirname(__FILE__))."/classes/CMessage.php");
    require_once(realpath(dirname(__FILE__))."/classes/CDatabase.php");
    require_once(realpath(dirname(__FILE__))."/classes/CUser.php");

    $_SERVER["DB"]  = new CDatabase;
    $_SERVER["USER"]= new CUser;




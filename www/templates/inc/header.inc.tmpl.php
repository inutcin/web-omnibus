<!DOCTYPE html>
<html lang="ru">
  	<head>
    	<meta charset="utf-8"/>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	    <meta name="HandheldFriendly" content="True"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	    <meta name="format-detection" content="telephone=no"/>
	    <meta name="format-detection" content="address=no"/>
	    <meta name="msapplication-tap-highlight" content="no"/>
	    <meta name="description" content=""/>
	    <meta name="keywords" content=""/>
		<title><?=
            isset($arResult["HEAD"]["TITLE"])
            ?
            $arResult["HEAD"]["TITLE"]
            :
            "Web-omnibus"
		?></title>
        <link href="/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="/bootstrap/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" />
        <link href="/css/jquery-ui.css" type="text/css"  rel="stylesheet" />
        <link href="/css/styles.css" type="text/css"  rel="stylesheet" />

        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery-ui.js"></script>
        <script src="/js/scripts.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
        <div id="error" style="display:none;"></div>

	<div class="main-menu">
        <ul class="nav nav-pills">
            <li class="active">
                <a href=".">
                    Главная
                </a>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" href="/projects.php"><?=
                    CMessage::Message('PROJECT')
                ?></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li>
                        <a href="/projects.php?act=list"><?=
                            CMessage::Message('LIST')
                        ?></a>
                    </li>
                    <li>
                        <a href="/projects.php?act=add"><?=
                            CMessage::Message('ADD')
                        ?></a>
                    </li>
                </ul>
            </li>
            <li class="logout">
                <a href="?logout">
                    Выйти
                </a>
            </li>
        </ul>
	</div>

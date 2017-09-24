<?php
    
    class CMessage{
        static function Error($sConst){
            $arErrorMessages = [
                "AUTH_ERROR"    =>
                    "Ошибка авторизации",
                "WRONG_JSON_REQUEST" => 
                    "Некорректный JSON в запросе",
            ];
            if(isset($arErrorMessages[$sConst]))
                return $arErrorMessages[$sConst];
            else
                return 'Unknown error';
        }

        static function Message($sConst){
            $arMessages = [
                "LOGIN_USERNAME"    =>
                    "Имя пользователя",
                "LOGIN_PASSWORD"    =>
                    "Пароль",
                "LOGIN_ENTER"       =>
                    "Войти",
                "PROJECT"           =>
                    "Проект",
                "PROJECTS"          =>
                    "Проекты",
                "ADD"               =>
                    "Добавить",
                "LIST"              =>
                    "Список",
                "PERMISSIONS"       =>
                    "Права доступа",
                "REQUEST_SUBSCRIBE_ERROR"=>
                    "Ошибка подписи запроса"
            ];
            if(isset($arMessages[$sConst]))
                return $arMessages[$sConst];
            else
                return $sConst;
        }
    }

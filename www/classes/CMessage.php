<?php
    
    class CMessage{
        static function Error($sConst){
            $arErrorMessages = [
                "AUTH_ERROR"    =>
                    "Ошибка авторизации",
                "WRONG_JSON_REQUEST" => 
                    "Некорректный JSON в запросе",
                "LOGIN_INCORRECT"=>
                    "Ошибка авторизации",
                "SESSION_NOT_FOUND"=>
                    "Сессия пользователя истекла или не существует",
                "REQUEST_SUBSCRIBE_ERROR"=>
                    "Ошибка подписи запроса",
                "REQUEST_UNDEFINED_METHOD"=>
                    "Неизвестный метод запроса"
            ];
            if(isset($arErrorMessages[$sConst]))
                return $arErrorMessages[$sConst];
            else
                return $sConst;
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
            ];
            if(isset($arMessages[$sConst]))
                return $arMessages[$sConst];
            else
                return $sConst;
        }

        static function UI($sConst){
            $arUI = [
                "blabla"    =>
                    "Блабла",
            ];
            if(isset($arUI[$sConst]))
                return $arUI[$sConst];
            else
                return $sConst;
        }
    }

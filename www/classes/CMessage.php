<?php
    
    class CMessage{
        static function Error($sConst){
            $arErrorMessages = [
                "AUTH_ERROR"    =>
                    "Ошибка авторизации"
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
                    "Войти"
            ];
            if(isset($arMessages[$sConst]))
                return $arMessages[$sConst];
            else
                return 'Unknown message';
        }
    }

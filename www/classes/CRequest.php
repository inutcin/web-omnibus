<?
    require_once(realpath(dirname(__FILE__)."/CCurl.php"));

    /**
        Класс запроса к API
    */
    class CRequest{
        var $params  = array();     //!< Параметры запроса 
        var $curlStatus = array();  //!< Состояние curl-запроса
        private $secret = '';            //!< Ключ для подписи запросов
        private $appId = '';
        private $baseUrl = '';          //!< Базовый URL мобильного API
        private $errors = array();  
        private $method = "login";
        private $answer = array();
        const cookie_session = 'OMNIBUS_SESSION';

        function __construct(){
            // Получаем из настроек ID приложения и ключ для подписи
            require(realpath(dirname(__FILE__)."/../")."/config.php"); 
            $this->appId = $arSettings["APP_ID"];
            $this->secret = $arSettings["KEY"];
            $this->baseUrl = $arSettings['BASE_URL'];
        }



        /**
            Установка имени и параметоров метода вызова API
            /метод:параметр1:параметр2

            например 

            /user:101 вызывается через setMethod("user",array('101'))
        */
        function setMethod(
            $sName, 
            $arParams = array()
        ){
            $this->method = $sName;
            foreach($arParams as $sParam)$this->method .= ":$sParam";
        }
        /**
            Очистка параметров запроса
        */
        function clearParams(){
            $this->params = array();
        }

        /**
            Добавление параметра запроса
        */
        function addParam($sName,$sValue){
            $this->params[$sName] = $sValue;
        }

        /**
            Установка метода запроса Curl
        */
        function setCurlMethod($sMethod){
            $this->curlMethod = $sMethod;
        }

        /**
            Запрос к API мобильного приложения
            @return тело ответа
        */
        function request(){
            $this->params["METHOD"] = $this->method;
            $sSessionId = 
                isset($_COOKIE[self::cookie_session])
                ?
                $_COOKIE[self::cookie_session]
                :
                '';
            $this->params["SESSION_ID"] = $sSessionId;
            ksort($this->params);
            // Формируем строку подписи
            $sSubscribeString   = json_encode( $this->params);
            
            // Подписываем запрос
            $sSubscribe = hash_hmac (
                "sha256", 
                trim($sSubscribeString),
                $this->secret
            );

            $oCurl = new CCurl;
            $oCurl->url = $this->baseUrl
                ."?appid=" .$this->appId
                ."&subscribe=".$sSubscribe
                ."&debug=1"
            ;
            $oCurl->post_params = [
                "request"=>$sSubscribeString
            ];

            $oCurl->request(); 
            if(intval($oCurl->returned_code)!=200){
                $this->setError(
                    "$sSubscribeString\n"
                    .print_r($oCurl,1)
                ); 
                return false;
            }

            $sAnswer = json_decode($oCurl->content); 
            $this->answer = json_decode(json_encode((array)$sAnswer),TRUE); 
            if(!$this->answer)
            $this->answer = $oCurl->content;



            // Возвращаем ответ в виде массива
            return $this->answer;
        }

        function getAnswer(){
            return $this->answer;
        }

        /**
            Метод обработки ошибок
        */
        function setError($sErrorText){
            $this->errors[] = $sErrorText;
            return false;
        }

        function getErrors(){
            return $this->errors;
        }

    }

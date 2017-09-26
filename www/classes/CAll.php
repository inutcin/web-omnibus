<?php
    
    class CAll{
        private $errors = array();

        function GetErrors(){
            return $this->errors;
        }

        protected function __setError($text){
            if(is_array($text))
                $this->errors = array_merge($this->errors,$text);
            else
                $this->errors[] = $text;
        }

    }

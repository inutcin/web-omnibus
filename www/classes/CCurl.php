<?
    class CCurl{
		var $content		=	'';		//!< Тело ответа
        var $headers        =   array();//!< Заголовки запроса
        var $in_headers_file=   '';     //!< Фалй с заголовками запроса
        var $out_headers_file=  '';     //!< Итоговый файл с заголовками ответа
        var $returned_headers=  array();//!< Массив с заголовками ответа
        var $post_request   =   "";
        var $post_params    =   array();
        var $returned_code  =   0;      //!< Возвращаемый HTTP-код
        var $timeout        =   10;
        var $url            =   '';
        var $only_headers   =   false;
        var $cookiefile     =   '';
        var $cookie         =   '';
        var $http_auth      =   '';		//!< HTTP-авторизация "login:password"  
		var $proxy		=	array(
            "host"          =>  '',
            "port"          =>  '',
            "username"      =>  '',
            "password"      =>  ''
        );
        var $outfile = '';
        var $referer = '';
        var $useragent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 '
            .'(KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 '
            .'Chrome/60.0.3112.113 '
            .'Safari/537.36';
        var $ssl_verify = false;
        var $follow_location = true;
        var $operationInfo  = array();  //!< Массив с информацией об операции
        /*
			"url"
			"content_type"
			"http_code"
			"header_size"
			"request_size"
			"filetime"
			"ssl_verify_result"
			"redirect_count"
			"total_time"
			"namelookup_time"
			"connect_time"
			"pretransfer_time"
			"size_upload"
			"size_download"
			"speed_download"
			"speed_upload"
			"download_content_length"
			"upload_content_length"
			"starttransfer_time"
			"redirect_time"
			"certinfo"
			"primary_ip"
			"primary_port"
			"local_ip"
			"local_port"
			"redirect_url"
			"request_header" (возвращается только при установленной опции 
				CURLINFO_HEADER_OUT с помощью вызова curl_setopt() до 
				выполнения запроса)        
		*/

        function __construct(){
            return true;
        }

        function request(){
            $ch = curl_init();
            if(
                isset($this->proxy['username']) && $this->proxy['username'] && 
                isset($this->proxy['password']) && $this->proxy['password']
            )curl_setopt ($ch, CURLOPT_PROXYUSERPWD, 
                $this->proxy['username'].":".$this->proxy['password']);
            
            if(isset($this->proxy['host']) && $this->proxy['host'] && 
                isset($this->proxy['port']) && $this->proxy['port']){
                curl_setopt ($ch, CURLOPT_PROXY, $this->proxy['host'].":".$this->proxy['port']);
                curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $this->proxy['host'].":".$this->proxy['port']);
            }

            /*
             * Опция для правильной работы с прокси. Нашли два решения
             */
            curl_setopt($ch, CURLOPT_HTTPHEADER,array("Expect:"));
            // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);

            
            curl_setopt ($ch, CURLOPT_URL, $this->url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

            if($this->only_headers){
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
                curl_setopt($ch, CURLOPT_NOBODY, true );
            }
            elseif($this->post_request || $this->post_params){
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_NOBODY, false );
            }
            else{
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_NOBODY, false );
            }

            if($this->post_request){
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $this->post_request);
            }
            elseif($this->post_params){
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $this->post_params);
            }

            if($this->cookiefile){
                curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiefile);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);
            }

            if($this->cookie){
                curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
            }

            if($this->http_auth){
                curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                curl_setopt ($ch, CURLOPT_USERPWD, $this->http_auth);        
            }
            
            if($this->headers){
                curl_setopt ($ch, CURLOPT_HTTPHEADER, $this->headers);
            }

            if($this->outfile){
                $fd = fopen($this->outfile, "w");
                curl_setopt ($ch, CURLOPT_FILE, $fd);
            }

            if($this->out_headers_file){
                $hd = fopen($this->out_headers_file, "w");
                curl_setopt ($ch, CURLOPT_WRITEHEADER, $hd);
            }

            if($this->in_headers_file){
                curl_setopt ($ch, CURLINFO_HEADER_OUT, true);
            }
                
            curl_setopt ($ch, CURLOPT_HEADER, 0);

            curl_setopt ($ch, CURLOPT_REFERER, $this->referer);
            curl_setopt ($ch, CURLOPT_USERAGENT, $this->useragent);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, $this->ssl_verify);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, $this->ssl_verify);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, $this->follow_location);
            curl_setopt ($ch, CURLOPT_TIMEOUT, $this->timeout);
            
            $result = curl_exec ($ch);
            if($this->in_headers_file){
                file_put_contents($this->in_headers_file, curl_getinfo(
                    $ch, CURLINFO_HEADER_OUT
                ));
            }
            $this->returned_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->operationInfo = curl_getinfo($ch);
 
            curl_close($ch);
    
            $this->content = $result;
            $this->returned_headers = array();
            

            if($this->outfile && isset($fd) && $fd)fclose($fd);
            if($this->out_headers_file && isset($hd) && $hd)fclose($hd);

            if($this->returned_code)return 1;
            
        }
    }

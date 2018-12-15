<?php

class HttpClient
{
    //curl
    public static function httpCurl( $url, $params=''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($params){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Content-Length: " . strlen($params)));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    //不适用curl时使用
    public static function httpSocket( $post, $url, $limit = 0, $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE){
        $return = '';
        $uri = parse_url($url);

        isset($uri['host']) || $uri['host'] = '';
        isset($uri['path']) || $uri['path'] = '';
        isset($uri['query']) || $uri['query'] = '';
        isset($uri['port']) || $uri['port'] = '';

        $host = $uri['host'];
        $path = $uri['path'] ? $uri['path'] . ($uri['query'] ? '?' . $uri['query'] : '') : '/';
        $port = !empty($uri['port']) ? $uri['port'] : 80;

        if ($post) {
            if(is_array($post)) $post = http_build_query( $post );
            $out = "POST $path HTTP/1.0\r\n";
            $out .= "Accept: */*\r\n";
            //$out .= "Referer: $boardurl\r\n";
            $out .= "Accept-Language: zh-cn\r\n";
            $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $out .= "Host: $host\r\n";
            $out .= 'Content-Length: ' . strlen($post) . "\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Cache-Control: no-cache\r\n";
            $out .= "Cookie: $cookie\r\n\r\n";
            $out .= $post;
        } else {
            $out = "GET $path HTTP/1.0\r\n";
            $out .= "Accept: */*\r\n";
            //$out .= "Referer: $boardurl\r\n";
            $out .= "Accept-Language: zh-cn\r\n";
            $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Cookie: $cookie\r\n\r\n";
        }

        $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
        if (!$fp) {
            return ''; //note $errstr : $errno \r\n
        } else {
            //集阻塞/非阻塞模式流,$block==true则应用流模式
            stream_set_blocking($fp, $block);
            //设置流的超时时间
            stream_set_timeout($fp, $timeout);
            @fwrite($fp, $out);
            //从封装协议文件指针中取得报头／元数据
            $status = stream_get_meta_data($fp);
            //timed_out如果在上次调用 fread() 或者 fgets() 中等待数据时流超时了则为 TRUE,下面判断为流没有超时的情况
            if (!$status['timed_out']) {
                while (!feof($fp)) {
                    if (($header = @fgets($fp)) && ($header == "\r\n" || $header == "\n")) {
                        break;
                    }
                }

                $stop = false;

                //如果没有读到文件尾
                while (!feof($fp) && !$stop) {
                    //看连接时限是否=0或者大于8192  =》8192  else =》limit  所读字节数
                    $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
                    $return .= $data;
                    if ($limit) {
                        $limit -= strlen($data);
                        $stop = $limit <= 0;
                    }
                }
            }
            @fclose($fp);
            return $return;
        }
    }
}

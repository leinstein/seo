<?php
import("@.Org.Util.Algms");

//header("Content-type: text/html; charset=utf-8"); 

/*
 *   0. 客户端有密钥a， 服务器有密钥b。 
 *   1.请求B。
 *   客户端生成公共参数p, g和A并发送给服务器
 *   服务器获取p，g 生成B返回给客户端
 *   2.生成K1
 *   客户端使用B，a和p，本地计算生成K1
 *   服务器使用A，b和p，本地计算生成K1
 *
 */

/**
 * Description of SecurityModel
 *
 * @author dejax
 */
class SecurityModel{
    
   // private $b=12312345678957; //服务端的secret，,保密，尽量不超过16位未确保安全一般至少大于一百位
    //private $p = '1313995814697153798968303761554187357262073074313048715567746567021558379035589353895273638463737204238446270882039877052664514288179174369608838938902158483049';
    private $b;     //握手协议中 服务器端使用的私有密钥b
    private $k1;    //握手协议后，用于申请令牌的初始通讯密钥K1
    private $Ka;    //最终通讯密钥
    private $AT;    //访问令牌
    private $RT;    //刷新令牌
    
    //
    const SECURITY_CLIENT_MODEL = 'sec_client';
    const SECURITY_GUIDPOOL_MODEL = 'sec_guidpool';
    const SECURITY_APIKEY_MODEL = 'sec_apikey';
    const HANDSHAKE_TIMEOUT = 600;      //握手协议次数的限制时间 单位为秒
    const HANDSHAKE_MAX_COUNT = 10;     //握手协议限制次数
    
    /*
    * 服务器生成DH握手协议私有秘密b，规则使用mt_rand函数生成两个随即的9位数字
    * 并将这两个数字串接成17位的字符串
    */
    public function gentSecretb(){      
        $c = mt_rand(10000000, 99999999);
        $d = mt_rand(100000000, 999999999);
        $this->b = $c.$d;
    }


    /*
     * 数据库中查询clientAPPID的记录
     * 如果存在，返回记录
     * 如果不存在，返回TRUE  *******
     */
    public function getCIDClientInfo($clientappid){
        $map['clientappid'] = $clientappid;
        return M(self::SECURITY_CLIENT_MODEL,null) -> where($map) -> find();      
    }
    
    /*
     * 数据库中查询GID的记录
     * 如果存在，返回记录
     * 如果不存在，返回TRUE  *******
     */
    public function getGIDClientInfo($gid){
        $map['gid'] = $gid;
        return M(self::SECURITY_CLIENT_MODEL,null) -> where($map) -> find();      
    }
    

    /*
     * 根据getClientInfo函数的返回结果执行相关操作
     * 如果getClientInfo结果为FALSE，返回B给客户端
     * 如果getClientInfo结果为TRUE，在client表中为该GID新建一条记录
     */
    public function doGetB($g, $p, $clientappid){
    	$model_client = M(self::SECURITY_CLIENT_MODEL,null);
        //查询当前客户端的信息
        $clientinfo = $this->getCIDClientInfo($clientappid);
        //如果客户端已经注册过，则返回B，否则注册客户端信息并生成B，然后返回
        if( $clientinfo ){
            echo $this->getB($g, $p, $clientinfo);
        }
        else{
            $data['clientappid'] = $clientappid;
            $data['count'] = 0;
            if( $model_client->data($data)->add() ){ 
                $clientinfo = $this->getCIDClientInfo($clientappid);
                echo $this->getB($g, $p, $clientinfo);
            }
            else{
                echo 104;
                log::write("104:".$model_client->getLastSql());
            }
        }
    }
        
        
    /*
     * 根据以下规则向客户端返回B
     *  1.参数均存在且不为空，在600秒（时间可按需配置）内允许10次（次数可按需配置）
     *  2.客户端第一次请求B，设置count = 1，并记录请求时间；增加数据库client表相关记录
     *  3.客户端请求次数未超过10次，且距离第一次请求未超过600秒，次数+1； 返回B，
     *  4.客户端请求次数未超过10次，且距离第一次请求超过600秒， 设置次数为1，记录当前时间为第一次请求时间，更新数据表；返回B
     *  5.客户端请求次数超过10次，且距离第一次请求超过600秒，设置次数为1，记录当前时间为第一次请求时间，更新数据表；返回B
     *  6.客户端请求次数超过10次，且距离第一次请求未超过600秒，次数限定为19，更新数据表；返回B
     */
    public function getB($g, $p, $clientinfo){
        if( !empty($g)  && !empty($p) && !empty($clientinfo) ) {
            //定义模型
            $clientmodel = M(self::SECURITY_CLIENT_MODEL,null);
        //    dump($clientinfo);
            //获取当前握手协议的次数和起始时间
            $count = $clientinfo['count'];
            if( !$clientinfo['hsStartTime'] )
                $clientinfo['hsStartTime'] = time(true);
            $currenttime = time(true);
            
            if( ( $currenttime - $clientinfo['hsStartTime'] ) >= self::HANDSHAKE_TIMEOUT ){ 
                //重新计数
                $count = 1;
                $clientinfo['hsStartTime'] = time(true);
            }else{
                //没超过10次返回错误
                if( $count < self::HANDSHAKE_MAX_COUNT ){
                    $count ++;
                }else{
                    return 102;
                }
             }
            
            //生成服务器端私有秘密b
            $this->gentSecretb();
            $clientinfo['b'] = $this-> b;
            $clientinfo['count']= $count;
            
            //更新客户端信息
            if($clientmodel->save($clientinfo)){            
                $B = $this->mod($g, $this->b, $p);

                return $B;
            }else 
                return 103; 
            
            
            //客户端第一次请求B，设置count = 1，并记录请求时间；增加数据库client表相关记录
            /*
            if( $count == 0 ){
                $starttime = time(true);
                $data['count']= 1;
                $data['hsStartTime'] = $starttime;
                
                if($clientmodel->save($data)){            
                    $B = bcpowmod($g, $this->b, $p);
                    return $B;
                }
                else 
                    return 103; 
            }
            else if( 0 < $count && $count < 10){
                
                //客户端请求次数未超过10次，且距离第一次请求超过600秒， 设置次数为1，记录当前时间为第一次请求时间，更新数据表；返回B
                if(($currenttime - $dbstartTime) >= 600){
                    $data['count']= $count+1;
                    $data['hsStartTime'] = time(true);
                    if($clientmodel->save($data)){            
                        $B = bcpowmod($g, $this->b, $p);
                        return $B;
                    }
                    else 
                        return 103;
               }
               //客户端请求次数未超过10次，且距离第一次请求未超过600秒，次数+1； 返回B，
                else{
                    $data['count']= $count+1;
                    if($clientmodel->save($data)){            
                        $B = bcpowmod($g, $this->b, $p);
                        return $B;
                    }
                    else 
                        return 103;
                }
            }
            else if($count >= 10){
                $currenttime = time(true);
                //客户端请求次数超过10次，且距离第一次请求超过600秒，设置次数为1，记录当前时间为第一次请求时间，更新数据表；返回B
                if(($currenttime - $dbstartTime) >= 6){  //为方便测试，取时间间隔为6，默认为600
                    $count = 1;
                    $data["hsStartTime"] = time(true);
                    $data['count']=$count;                    
                    if($clientmodel->save($data)){            
                        $B = bcpowmod($g, $this->b, $p);
                        return $B;
                    }
                    else 
                        return 103;
                }
                else{
                    //客户端请求次数超过10次，且距离第一次请求未超过600秒，次数限定为19，更新数据表；返回B
                    $data['count']= 19;
                    if($clientmodel->save($data)){            
                        $B = bcpowmod($g, $this->b, $p);
                        return $B;
                    }
                    else 
                        return 103;
                    
                    return 102;
                }
            }
             */
        }
        else{
            return 101;
        }
        

    }
    
    /*
     * 根据参数生成K1
     */
    public function getK1($A, $b, $p){
        return $this->mod($A, $b, $p);
    }

    /*
     * 生成密钥串，生成Ka, AT, RT发送给客户端，并存入数据库
     *      1.先BASE64解码，再用K1解密消息
     *      2.本地生成K1，判断看K1长度：不足16位在前面补零， 超过16位其中16位 
     *      3.用K1解密请求信息，得到相关参数：消息guid，api_key
     *      4.checkGuid(guid)验证消息的合法性
     *      5.检测api_key,若通过，将生成Ka, AT, RT并存入client表中
     *      6.返回Ka, AT, RT给客户端
     */
    public function getTokens($p, $A, $encrypted2, $clientappid){
        $clientinfo = $this->getCIDClientInfo($clientappid);
        //先解码被传输的加密文件
        $encrypted1 = rawurldecode( $encrypted2 );
   ///////////////////////////////////====================     
        //从数据库中取出$c_gid下的服务器端私有秘密b，并计算K1
        $this->b = $clientinfo['b'];
        $this->k1 = $this->getK1($A, $this->b,$p);
 //       $client = M(self::SECURITY_CLIENT_MODEL,null);
 //       $map['gid'] = $cgid;
 //       $ud = $client->where($map)->find();
 //       $this->b = $ud['b'];
 //       $this->k1 = $this->getK1($A, $this->b,$p);

        //当计算K1的K1小于16位，在K1第一位前补0，直到16位
        if(strlen($this->k1) < 16){              
            $privateKey = $this->pad($this->k1,16);
        }
        //当K1大于16位，取其中的16位
        if(strlen($this->k1)>=16){
            $privateKey = substr($this->k1, 7, 16);
        }
        
        
        //解密被加密的函数，并去除解密后产生的多余的空格
        $encryptedData = base64_decode($encrypted1);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $privateKey);
        $decrypted = trim($decrypted);//解密后的数据长度为16的倍数

        
        //解密后的字符串应为52位，如果不是则报错
        if( strlen($decrypted) != 52 ){
            echo 'privateKey'.$this->k1.'.....';
            
            echo 201;
         //   
        }
        else{
            //获取前36位的guid，并检测是否已在guidpool表中存在
            //如果存在，则为重复发送的消息，报错
            //如果不存在，则向guidpool加入该条记录
            $cguid = substr($decrypted, 0,36);
            if(($this->checkGuid($cguid)) == 0){
                $mg = M(self::SECURITY_GUIDPOOL_MODEL,null);
                $data1['guid'] = $cguid;
                $mg->add($data1);
                //从encrypted中获取apikey，并检测是否合法
                //如果合法，则生成Ka, AT, RT存入数据库，并用K1加密，再base64编码发送给客户端
                if($this->checkAPIKey(substr($decrypted,36,16))){
                    $clientinfo['api_key'] = substr($decrypted,36,16);
                    //$data['gid'] = $ud['gid'];
                    $this->Ka = $this->gen_RandPWD(); //存入数据库
                    $clientinfo['Ka'] = $this->Ka;

                    $this->AT = substr(SHA1(time(true)), 0, 16);//存入数据库
                    $clientinfo['AT'] = $this->AT;
                    //AT有效期设定为一个月
                    $clientinfo['AT_Expiration'] = time(true)+2592000;


                    $this->RT = substr(md5(md5(time())),1,16);//存入数据库
                    $clientinfo['RT'] = $this->RT;
                    
                    //定义client model,并更行将$clientinfo加入user表用来更新相关记录
                    $client = M(self::SECURITY_CLIENT_MODEL,null);
                    $client->save($clientinfo);
             //       if($client->save($clientinfo)){
                        $encryKa = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $this->Ka.$this->AT.$this->RT.$clientinfo['gid'], MCRYPT_MODE_CBC, $privateKey);
                        echo (base64_encode($encryKa));
             //       }  else {
             //           echo 206;
             //           echo $client->getLastSql();
              //      }
                }
                else 
                    echo 202;
            
            }
            else{
                echo 400;
            }
        }        
    }
    /*
     * 访问apikey库，检测API_Key的合法性
     */
    public function checkAPIKey($ak){
        $apik =  M(self::SECURITY_APIKEY_MODEL,null);
        $map['api_key'] = $ak;
        $result = $apik->where($map)->find();
        if($result['api_key'] == $ak)
            return true;
        else
            return FALSE;
    }
    
    
    /*
     * 生成16位随机密码
     */
    function gen_RandPWD(){        
        $str = substr(md5(time()), 0, 16);
   
        return $str;
    }
    
    /*
     * 字符串不满16位，在开头用0补全16位
     */
    function pad($num, $n) { 
        $len = strlen($num); 
        while($len < $n) { 
            $num = '0'.$num; 
            $len++; 
        } 
        return $num; 
    }
    
    /*
     * 访问guidpool库，检测客户端发送的guid
     * 如果guid已存在，返回1
     * 如果guid不存在，返回0
     */
    public function checkGuid($guid){
        $gm = M(self::SECURITY_GUIDPOOL_MODEL,null);
        $map['guid'] = ($guid);    
        $s_guid = $gm->where($map)->find();;
        if (empty($s_guid) == false ){
                   //若该消息之前已发送过，返回 1
                return 1;
            }
            else {
                //若该消息之前未发送过，返回 0
                return 0;
            }        
    }
    
    /*
     * 根据gid从数据库client中获取Ka
     */
    public function getKa($c_gid){
        $client = M(self::SECURITY_CLIENT_MODEL,null);
        $map['gid'] = $c_gid;
        $gid = $client->where($map)->find();
        return $gid['Ka'];
    }
    
     /*
     * 根据gid从数据库client中获取AT
     */
    public function getAT($c_gid){
        $client = M(self::SECURITY_CLIENT_MODEL,null);
        $map['gid'] = $c_gid;
        $gid = $client->where($map)->find();
        return $gid['AT'];
    }
    
    /*
     * 根据gid从数据库中client中获取RT
     */
    public function getRT($c_gid){
        $client = M(self::SECURITY_CLIENT_MODEL,null);
        $map['gid'] = $c_gid;
        $gid = $client->where($map)->find();
        return $gid['RT'];
    }
    
    /*
     * 验证AT的时效性（1个月,259200s），如果AT有效，返回true，AT超过时效，返回false
     */
    public function validateAT($atEpir){
      //  $client = M(self::SECURITY_CLIENT_MODEL,null);
      //  $clientinfo = $this->getGIDClientInfo($gid);
        if(time(true) < $atEpir)
            return true;        
        else
            return false;
    }
    
    /*
     * 根据客户端的刷新令牌请求，返回新的令牌AT，RT
     * 请求参数客户端GID，被加密的请求$encrypted
     */
    public function refreshTokens($c_gid, $encrypted){
        //从数据库中获取Ka,RT
        $this->Ka = $this->getKa($c_gid);
        $this->RT = $this->getRT($c_gid);
        //如果请求参数$encrypted不为空，响应请求
        if(empty($encrypted)==0){
            //先解码，再用Ka解密请求参数$encrypted，并去除解密后多余的空格
            $encrypted11 = rawurldecode($encrypted);            
            $encryptedData1 = base64_decode($encrypted11);
            $decrypted1 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->Ka, $encryptedData1, MCRYPT_MODE_CBC, $this->Ka);
            $decrypted1 = trim($decrypted1);
            
            //从解密消息中获取GUID。验证消息的GUID，防止重复发送
            $cguid = substr($decrypted1, 0,36);
            if(($this->checkGuid($cguid)) == 0){
                //获取RT，并验证
                //如果验证成功，生成新的AT，RT，更新数据库，并加密编码返回给客户端
                $RT= substr($decrypted1, 36,16);               
                if(strcmp($RT, $this->RT)==0 ){
                    $client = M(self::SECURITY_CLIENT_MODEL,null);
                    $map['gid'] = $c_gid;
                    $ud = $client->where($map)->find();

                    $data['gid']=$ud['gid'];
                    
                    //生成新的AT，存入数据库
                    $this->AT = substr(SHA1(time()), 0, 16);
                    $data['AT'] = $this->AT;
                    //设置新AT的有效期限
                    $data['AT_Expiration'] = time(true)+2592000;

                    //生成新的AT，存入数据库
                    $this->RT = substr(sha1(md5(time())),0,16);//存入数据库
                    $data['RT'] = $this->RT;
                    
                    if($client->save($data)){   
                        $encryKa = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->Ka, $this->AT.$this->RT, MCRYPT_MODE_CBC, $this->Ka);
                        echo (base64_encode($encryKa));
                    }
                    else
                        echo 205;
                }
                else{
                    echo 203;
                }
            }
            else if((checkGuid($cguid)) == 1){
                echo 400;
            }
        }
        else {
            echo '刷新令牌请求错误';
        }
    }
    
    
    
    
    /*
     * Ka, AT, RT都生成后，检测客户端的API请求消息
     *   1. php使用rawurldecode() 函数解码 由JS encodeURIComponent()编码过的消息，再Base64解码
     *   2. 使用Ka解密得到客户端传递的参数
     *   3. checkGuid(guid)验证消息合法性
     *   4. 验证访问令牌AT的合法性，如果通过，放行请求；不通过，拒绝请求
     *    将检测 guid和AT的合法性
     */
    public function checkSecurity($c_gid, $encrypted, &$parameters){
        $clientinfo = $this->getGIDClientinfo($c_gid);
        $this->Ka = $clientinfo['Ka'];
        $this->AT = $clientinfo['AT'];

        
        if(empty($encrypted)==0){
            $encrypted11 = rawurldecode($encrypted);
            
            $encryptedData1 = base64_decode($encrypted11);
            
            $decrypted1 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->Ka, $encryptedData1, MCRYPT_MODE_CBC, $this->Ka);
            $decrypted1 = trim($decrypted1);
            
            $cguid = substr($decrypted1, 0,36);

            //验证消息的GUID，防止重复发送
            if(($this->checkGuid($cguid)) == 0){
                $AT= substr($decrypted1, 36,16);
                //比较AT，并验证AT的时效性
                if(strcmp($AT, $this->AT)==0 ){
                    if( $this->validateAT($clientinfo['AT_Expiration']) == true){
                    	//取出parameters
                    	parse_str(substr($decrypted1, 52), $parameters);                    	
                        return true;
                    }else
                        return 301;
                }else{
                    return 302;
                }
            }else if((checkGuid($cguid)) == 1){
                return 400;
            }
        }else {
            return 500;
        }
    }
    
    /*
     * 加密函数，以gid和原始数据为参数，密钥默认使用gid对应的Ka
    */ 
    public function encryt($gid, $data){
        $key = $this->getKa($gid);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $key));
        
    }
    /*
     * 解密函数，以gid和被加密后的数据为参数，密钥默认使用gid对应的Ka
    */     
    public function decryt($gid, $data){
        $key = $this->getKa($gid);
        $data1 = base64_decode((rawurldecode($data)));
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data1, MCRYPT_MODE_CBC, $key);        
    }
    
    /*
     * 计算对数取模
     */
    function mod( $gt, $at, $pt){  
        $result = 1;  
        $base = $gt;  
        while($at>0){  
            if( $at & 1==1){
                $result = bcmul($result, $base);
                $result = bcmod($result, $pt);            
            }
        $temp = bcmul($base,$base);                 
        $base = bcmod($temp, $pt);
        $at >>= 1;
        }  
        return $result;  
    }
}
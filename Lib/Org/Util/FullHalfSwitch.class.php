<?php
class FullHalfSwitch {
    //full 2 falf
    public static $charters2half = array(
        '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
        '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
        'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
        'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
        'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
        'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
        'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
        'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
        'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
        'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
        'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
        'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
        'ｙ' => 'y', 'ｚ' => 'z', '　' => ' ',
    );
    //half 2 full
    public static $charters2full;

    //cn 2 en
    public static $marks2En = array(
        "（"=>"(","）"=>")","，"=>",","。"=>".","；"=>";","："=>":",'？' => '?', '！' => '!','＜'=>'<','＞'=>'>'
    );
    //en 2 cn
    public static $marks2Cn;

    private static function initParams(){
        if(!static::$charters2full) static::$charters2full = array_flip(static::$charters2half);
        if(!static::$marks2Cn) static::$marks2Cn = array_flip(static::$marks2En);
    }

    public function __callStatic($funcname, $arguments){
        static::initParams();
        $func_name = "_2".$funcname;
        return static::$func_name($arguments[0]);
    }

    private static function _2Half($str){
        $str = strtr( $str, static::$charters2half );
        return static::_2En($str);
    }

    private static function _2Full($str){
        $str = strtr( $str, static::$charters2full );
        return static::_2Cn($str);
    }

    private static function _2En($str){
        $str = strtr( $str, static::$marks2En );
        return $str;
    }

    private static function _2Cn($str){
        $str = strtr( $str, static::$marks2Cn );
        return $str;
    }

    private static function _2StrArgs($str){
        $args = array();
        $args[] = $str;
        $args[] = static::_2Cn($str);
        $args[] = static::_2En($str);
        $args[] = static::_2Full($str);
        $args[] = static::_2Half($str);
        return array_unique($args);
    }
}
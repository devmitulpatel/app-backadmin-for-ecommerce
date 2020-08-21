<?php
namespace Help;


use phpDocumentor\Reflection\Types\Self_;

class Secret
{

    protected $method = 'idea'; // default cipher method if none supplied
    private $key;



    protected function iv_bytes()
    {
        return openssl_cipher_iv_length($this->method);
    }

    public function __construct($key = FALSE, $method = FALSE)
    {


        if(!$key) {
            $key = php_uname(); // default encryption key if none supplied
        }
        if(ctype_print($key)) {
            // convert ASCII keys to binary format
            $this->key = openssl_digest($key, 'SHA256', TRUE);
        } else {
            $this->key = $key;
        }
        if($method) {
            if(in_array(strtolower($method), openssl_get_cipher_methods())) {
                $this->method = $method;
            } else {
                die(__METHOD__ . ": unrecognised cipher method: {$method}");
            }
        }

        $this->method='AES256';
    }

    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes($this->iv_bytes());
        return bin2hex($iv) . openssl_encrypt($data, $this->method, $this->key, 0, $iv);
    }

    // decrypt encrypted string
    public function decrypt($data)
    {
        $iv_strlen = 2  * $this->iv_bytes();
        if(preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $data, $regs)) {
            list(, $iv, $crypted_string) = $regs;
            if(ctype_xdigit($iv) && strlen($iv) % 2 == 0) {
                return openssl_decrypt($crypted_string, $this->method, $this->key, 0, hex2bin($iv));
            }
        }
        return FALSE; // failed to decrypt
    }

    public static function encode($str,$dv='$'){

        $c=new Self();
        $c1=$c->encrypt($str);


        $syCount=count($c->strpos_all($c1,'='));

//        $strData=[
//            'string'=>$str,
//            'stringCount'=>strlen($str),
//            '= Count'=>$syCount,
//            '= Minus Count'=>strlen($c1)-$syCount,
//            'lvl1'=>$c1,
//            'lvl1Diff'=>strlen($c1)-strlen($str),
//            'lvl2'=>$c->encrypt(str_replace('=','',$c1)),
//            'lvl1by 2'=>strlen(str_replace('=','',$c1))/2,
//            'lvl2Diff'=>strlen($c->encrypt(str_replace('=','',$c1)))-strlen($str),
//
//        ];
        $a=rand(0,99);
        $b=rand(0,99);
        while ($a-$b!=$syCount){
            $b=rand(0,99);
        }

     //   dd($a-$b==$syCount);



        $finalStr= implode('',[$a,$dv,str_replace('=','',$c1),$dv,$b]);

       // $strData['result']=$finalStr;


        return $finalStr;
        return $c->encrypt($str);

    }

    public static function decode($str,$dv='$'){
        $c=new Self();
        $explodeStr=explode($dv,$str);

        $a=reset($explodeStr);
        $b=end($explodeStr);
        $code=$explodeStr[1];
        $syCount=$a-$b;
        $lvl1=implode('',[$str,str_repeat("=", $syCount)]);
        return $c->decrypt($code);



    }

    public function strpos_all($haystack, $needle) {
        $offset = 0;
        $allpos = array();
        while (($pos = mb_strpos($haystack, $needle, $offset)) !== FALSE) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }
        return $allpos;
    }

}

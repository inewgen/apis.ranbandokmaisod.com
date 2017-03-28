<?php namespace Hashing;

class Rc4crypt
{
    public static function encrypt($pwd, $data)
    {
        $cipher      = '';
        $key[]       = '';
        $box[]       = '';
        $pwd_length  = strlen($pwd);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($pwd[$i % $pwd_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j       = ($j + $box[$i] + $key[$i]) % 256;
            $tmp     = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $data_length; $i++) {
            $a       = ($a + 1) % 256;
            $j       = ($j + $box[$a]) % 256;
            $tmp     = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $k       = $box[(($box[$a] + $box[$j]) % 256)];
            ((strlen(dechex(ord($data[$i]) ^ $k)) == 1) ? $Zero = "0" : $Zero = "");
            $cipher = $cipher . $Zero . dechex(ord($data[$i]) ^ $k);
        }

        return $cipher;
    }

    public static function ASC2CHR($inp)
    {
        $TempChar = "";
        $PartStr  = "";
        while (strlen($inp) > 1) {
            $TempChar = substr($inp, 0, 2);
            $inp      = substr($inp, 2, (strlen($inp) - 2));
            $PartStr  = $PartStr . chr(hexdec($TempChar));
        }

        return $PartStr;
    }

    public static function decrypt($key, $data)
    {
        return self::ASC2CHR(self::encrypt($key, self::ASC2CHR($data)));
    }
}

/*
$rc4 = new rc4crypt;
echo $_uniqid=$rc4->encrypt('qwerfdsazxcvbnm','qwertyuqwe|rtyuqwertyuqwe|rtyuqwertyu');
echo bin2hex($_uniqid);
$code=bin2hex($_uniqid);
echo '<hr>';
echo $rc4->decrypt('qwerfdsazxcvbnm',$_uniqid);
*/

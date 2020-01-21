<?php


namespace App\Services\Api;


class RsaServer
{
    /**
     * rsa 公钥路径
     */
    const  RSA_PUBLIC = __DIR__ . '/../../resources/pem/rsa_public_key.pem';
    /**
     * rsa 私钥路径
     */
    const  RSA_PRIVATE = __DIR__ . '/../../resources/pem/rsa_private_key.pem';

    /**RSA算法公钥加密
     * @param string $data
     * @return string
     */
    public function publicEncrypt($data = '')
    {
        $public_key = openssl_pkey_get_public(file_get_contents(self::RSA_PUBLIC));

        if(!$public_key){
            return('公钥不可用');
        }

        //第一个参数是待加密的数据只能是string，第二个参数是加密后的数据,第三个参数是openssl_pkey_get_public返回的资源类型,第四个参数是填充方式
        $return_en = openssl_public_encrypt($data, $crypted, $public_key);

        if(!$return_en){
            return('加密失败,请检查RSA秘钥');
        }

        return base64_encode($crypted);

    }

    /**
     * RSA私钥解密
     * @param string $data
     * @return string
     */
    public function privateDecrypt($data = '')
    {
        $private_key = openssl_pkey_get_private(file_get_contents(self::RSA_PRIVATE));

        if(!$private_key){
            return('私钥不可用');
        }
        $return_de = openssl_private_decrypt(base64_decode($data), $decrypted, $private_key);

        if(!$return_de){
            return('解密失败,请检查RSA秘钥');
        }

        return $decrypted;

    }

    /**
     * RSA私钥加密
     * @param string $data
     * @return string
     */
    public function privateEncrypt($data = '')
    {
        $private_key = openssl_pkey_get_private(file_get_contents(self::RSA_PRIVATE));
        if(!$private_key){
            return('私钥不可用');
        }
        $return_en = openssl_private_encrypt($data, $crypted, $private_key);
        if(!$return_en){
            return('加密失败,请检查RSA秘钥');
        }

        return base64_encode($crypted);

    }

    /**
     * RSA公钥解密
     * @param string $data
     * @return string
     */
    public function publicDecrypt($data = '')
    {
        $public_key = openssl_pkey_get_public(file_get_contents(self::RSA_PUBLIC));
        if(!$public_key){
            return('公钥不可用');
        }
        $return_de = openssl_public_decrypt(base64_decode($data), $decrypted, $public_key);
        if(!$return_de){
            return('解密失败,请检查RSA秘钥');
        }
        return $decrypted;
    }
}

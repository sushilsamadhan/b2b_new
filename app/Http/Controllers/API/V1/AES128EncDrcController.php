<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AES128EncDrcController extends Controller
{
    /**
     * @var string
     */
    private $cipher;
    /**
     * @var string
     */
    private $key;

    /**
     * AES128EncDrcController constructor.
     */
    public function __construct(){
        $this->key = "OLE-B2B-2022#";
        $this->cipher = "AES-128-CBC";
    }

    /**
     * @param int $count
     * @return string
     */
    private function getIV($count = 0){
        $iv = '';
        $i = 0;
        while ($i < $count){
            $iv .= chr(0x0);
            $i++;
        }
        return $iv;
    }

    /**
     * @param $str
     * @return string
     */
    public function encrypt128($str)
    {
        return base64_encode(openssl_encrypt(json_encode($str), $this->cipher, $this->key, OPENSSL_RAW_DATA, $this->getIV(16)));
    }

    /**
     * @param $encrypted
     * @return string
     */
    public function decrypt128(Request $request)
    {
        $encrypted = $request->data;
        $key = $request->key;
        return openssl_decrypt(base64_decode($encrypted), $this->cipher, $key, OPENSSL_RAW_DATA, $this->getIV(16));
    }
}

/*$encrypted = $request->data;
// die('decode/decodes');
return json_decode(openssl_decrypt(base64_decode($encrypted), $this->cipher, $this->key, OPENSSL_RAW_DATA, $this->getIV(16)));
return Response::json(compact('data'), 200);
// print_r($data);*/

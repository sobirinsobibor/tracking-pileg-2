<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function encrypted_id($id){
        $encryptedWord = openssl_encrypt($id, 'AES-128-ECB', 'westhuyt');
        $result = substr($encryptedWord, 0, 16);
        $base64url = strtr(base64_encode($result), '+/', '-_'); // menghilangkan
        return $base64url;
    }
}

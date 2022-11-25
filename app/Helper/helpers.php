<?php 
if (!function_exists('create_reponse')) {
    function create_reponse()
    {
        $response = new stdClass;
        $response->status       = 'error';
        $response->status_code  = 500;
        $response->data         = [];
        $response->message      = 'Terjadi Kesalahan Server';

        return $response;
    }
}

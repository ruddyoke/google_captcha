<?php


class Recaptcha
{
    const CLEF_SECRETE = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

    public function __construct($api_site='XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'){
        $this->api_site = $api_site;
    }

    /**
     * Génère la balise script pour recaptcha
     * @return string
     */
    public function script(){
        return '<script src="//www.google.com/recaptcha/api.js"></script>';
    }

    /**
     * Génère le code html de notre captcha
     * @return string
     */
    public function html(){
        return '<div class="g-recaptcha" data-sitekey="'.$this->api_site.'"></div>';
    }

    /**
     * Verifie la réponse donnée par recaptcha
     * @param $code
     * @param null $ip
     * @return bool
     */
    function isValid($code, $ip = null)
    {
        if (empty($code)) {
            return false; // Si aucun code n'est entré, on ne cherche pas plus loin
        }
        $params = [
            'secret'    => self::CLEF_SECRETE,
            'response'  => $code
        ];
        if( $ip ){
            $params['remoteip'] = $ip;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
            $response = curl_exec($curl);
        } else {
            // Si curl n'est pas dispo, un bon vieux file_get_contents
            $response = file_get_contents($url);
        }

        if (empty($response) || is_null($response)) {
            return false;
        }

        $json = json_decode($response);
//        var_dump($json);
        return $json->success;
    }
}

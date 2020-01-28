<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 20.1.27
 * Time: 21.59
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\Request;

class Recapture
{

    /**
     * @return bool
     */
    public function isVerified(Request $request)
    {

        $token = $request->get('token');
        $action = $request->get('action');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => 'SECRET_KEY', 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        return ($arrResponse["success"] == true && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5);
    }
}
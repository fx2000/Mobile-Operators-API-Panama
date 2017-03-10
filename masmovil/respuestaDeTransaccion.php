<?php
/*
 * QTS: Respuesta de Transacción
 * +Móvil Panamá
 * @copyright Copyright (c) Móviles de Panamá, S.A. (http://www.movilesdepanama.com)
 *
 */

// Session information
$url = "http://201.224.58.242:8080/QTS/Service.asmx/RespuestaDeTransaccion";
$username = 'CWP\\PG_Romsatest';
$password = '882revhL';

/*
 * Operation parameters
 *
 * UniqueKey (String) = GUID que identifica la transacción. Se puede obtener en
 * la respuesta del método HistorialPorMSISDN 
 *
 */
$params = array(
    'UniqueKey' => '1234567890',
);

/*
 * Send transaction using CURL and NTLM Authentication
 */
function sendTransaction($url, $username, $password, $params)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
    curl_setopt($ch, CURLOPT_USERPWD, $username. ':' . $password);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 100);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Stringify the data array (Necessary when calling a .Net Webservice)
    $postArray = '';
    foreach ($params as $key => $value) { 
        $postArray .= $key . '=' . $value . '&'; 
    }
    $postArray = rtrim($postArray, '&');

    curl_setopt($ch,CURLOPT_POST,count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postArray);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec ($ch);
    curl_close ($ch);
    return $response;
}

// Send transaction and store result XML in array
$result = sendTransaction($url, $username, $password, $params);
$xml = simplexml_load_string($result);
$responseArray = json_decode(json_encode($xml), TRUE);

// Display Results
print_r($responseArray);

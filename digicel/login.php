<?php
/*
 * Login (login)
 * Digicel Panamá
 * @copyright Copyright (c) Móviles de Panamá, S.A. (http://www.movilesdepanama.com)
 *
 */

// Session Parameters
$username = 'test_roms';
$password = 'tes7_Rom$';
$url = 'http://64.116.185.75:8001/dts-ws/DirectTopupSystemService?wsdl';

/* Transaction parameters
 *
 * Username (arg0)  = Provided by Digicel
 * Password (arg1)  = Provided by Digicel
 *
 */
$params = array(
    'arg0' => $username,
    'arg1' => $password
);

// Establish connection to WSDL
$client = new SoapClient($url, array("connection_timeout" => 15));

// Call Login method and store results in response array
$responseObject = $client->login($params);
$responseArray = json_decode(json_encode($responseObject), TRUE);

// Display Results
print_r($responseArray);

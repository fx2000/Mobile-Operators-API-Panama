<?php
/*
 * Recarga
 * Movistar Panamá
 * @copyright Copyright (c) Móviles de Panamá, S.A. (http://www.movilesdepanama.com)
 *
 */

// Session Parameters
$url = 'http://10.220.0.132:7005/WSUSSDPM/USSDPM?WSDL';
$msisdn = '123456'
$passcode = '000000';

/* Transaction Parameters
 *
 * MSISDN   = Distributor ID
 * PASSCODE = Distributor Passcode
 * MONTO    = Recharge Amount (###.## 0.25 to 200.00)
 * NUMCELL  = Destination phone number (XXXXXXXX)
 *
 */
$params = array(
    'MSISDN'   => $msisdn,
    'PASSCODE' => $passcode,
    'MONTO'    => '1.00',
    'NUMCELL'  => '69822702'
);

// Establish connection to WSDL
$client = new SoapClient($url, array("connection_timeout" => 30));

// Call RECARGA method and store results in response array
$responseObject = $client->RECARGA($params);
$responseArray = json_decode(json_encode($responseObject), TRUE);

// Display Results
print_r($responseArray);

<?php
/*
 * PHP Socket client experiment
 * Claro Panamá
 */

// Session parameters
$server = '123.456.789.10';
$port = '7032';
$password = '123456';

// Transaction parameters
$params = array(
    'codTransaccion' => '100',
    'tipoId'         => '1',
    'nit'            => '7000000385',
    'min'            => '69822702',
    'numControl'     => '1',
    'numTerminal'    => '72403453',
    'monto'          => '500',
    'password'       => $password,
    'fecha'          => '20170310',
    'hora'           => '115800',
    'nomTerminal'    => 'Club Prepago Celular (Pruebas)',
    'codComercio'    => '12345678',
);

// Compose preliminary recharge message
$preMessage = '|' . $params['codTransaccion'];
$preMessage .= '|' . str_pad($params['tipoId'], 2, 0, STR_PAD_LEFT);
$preMessage .= '|' . $params['nit'];
$preMessage .= '|' . str_pad($params['min'], 12, 0, STR_PAD_LEFT);
$preMessage .= '|' . str_pad($params['numControl'], 12, 0, STR_PAD_LEFT);
$preMessage .= '|' . str_pad($params['numTerminal'], 12, 0, STR_PAD_LEFT);
$preMessage .= '|' . str_pad($params['monto'], 8, 0, STR_PAD_LEFT);
$preMessage .= '|' . $params['password'];
$preMessage .= '|' . $params['fecha'];
$preMessage .= '|' . $params['hora'];
$preMessage .= '|' . str_pad($params['nomTerminal'], 64, ' ', STR_PAD_LEFT);
$preMessage .= '|' . $params['codComercio'];
$preMessage .= '|' . PHP_EOL;

// Calculate message size
$size = strlen($preMessage) + 2;

// Compose final recharge message
$message = $size . $preMessage;

echo 'Message to Server: ' . $message;

// Create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

// Connect to server
$result = socket_connect($socket, $server, $port) or die("Could not connect to server\n");  

// Send message to server
socket_write($socket, ($message), strlen($message)) or die("Could not send data to server\n");

// Get server response
$result = socket_read ($socket, 1024) or die("Could not read server response\n");

// Display server response
echo "Reply From Server  :" . $result;

// Close socket
socket_close($socket);

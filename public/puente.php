<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

// Si es POST, registra asistencia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'] ?? null;
    $tipo = $_POST['tipo'] ?? 'entrada';
    $fecha = date('Y-m-d H:i:s');

    // Guarda respaldo local
    file_put_contents("asistencias_backup.txt", "🕒 $fecha\n🔴 UID: $uid\n📩 Tipo: $tipo\n\n", FILE_APPEND);

    // Guarda el último UID leído para uso desde frontend
    file_put_contents("uid_temp.txt", $uid);

    // Reenvía a Laravel
    $ch = curl_init('https://utmorelia.com/sistemaHumanos/api/asistencia');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'uid' => $uid,
        'tipo' => $tipo
    ]));
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Devuelve respuesta de Laravel
    http_response_code($httpcode);
    header('Content-Type: application/json');
    echo $response;
    exit;
}

// Si es GET, entrega el último UID leído
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists('uid_temp.txt')) {
        $uid = file_get_contents('uid_temp.txt');
        echo trim($uid);
    } else {
        echo '';
    }
    exit;
}

// Si no es GET ni POST
http_response_code(405);
echo json_encode(['status' => 'error', 'mensaje' => 'Método no permitido']);
exit;

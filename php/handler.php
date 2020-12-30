<?php   
    $data = file_get_contents('php://input');

    $ch = curl_init('https://ob-sko.e-health.kz/sko_ob/hs/CTMRI/info');
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $auth =  'Authorization: Basic ' . base64_encode('Ctmri:l4i5JF#VT$YUPq3W');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $auth));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Данные с Ajax запроса
    $result = curl_exec($ch);
    echo $result;

    curl_close($ch);
    echo json_encode($result);
?>
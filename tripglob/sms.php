<?php 

$json='{
    "ver": "1.0",
    "key": "d10lvCQSrDZydhONDE1dnQ==",
    "encrpt":"0",

    "messages": [
        {
            "dest": [
                "918523906512"
            ],
            "text": "Dear user your OTP for logging in to your Admin account is 12345. Embrace the Journey with Tripglobo",
            "send": "TRIPGB",
            "dlt_entity_id": "1001861812287155118",
            "dlt_template_id": "1007481933598187873"
            
        }
    ]
}';


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://japi.instaalerts.zone/httpapi/JsonReceiver',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$json,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic dHJpcGdiOkZhc2hpb25AMTIz'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
 ?>
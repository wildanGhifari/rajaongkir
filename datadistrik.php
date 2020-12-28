<?php
$id_provinsi_terpilih = $_POST["id_provinsi"];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: cee127c76f3c96e79af0061cd32a3b5a"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // dapatnya dalam bentuk JSON
    // Convert ke array
    $array_response = json_decode($response, true);
    $dataDistrik = $array_response["rajaongkir"]["results"];

    echo "<option value=''>Pilih Distrik</option>";

    foreach ($dataDistrik as $distrik) {
        echo "<option value='" . $distrik["city_id"] . "' 
        id_distrik='" . $distrik["city_id"] . "'
        nama_provinsi='" . $distrik["province"] . "'
        nama_distrik='" . $distrik["city_name"] . "'
        tipe_distrik='" . $distrik["type"] . "'
        kodepos='" . $distrik["postal_code"] . "'
        >";
        echo $distrik["city_name"];
        echo "</option>";
    }
}

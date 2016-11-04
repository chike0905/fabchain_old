<?php

namespace App\Libs;

class Common {
  public function PostJson($url,$data) {
    $options = [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_AUTOREFERER => true,
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt_array($ch, $options);
    $res = curl_exec($ch);
    curl_close($ch);

    $error = Null;
    if($res == false){
      $error = curl_error($ch);
    } else {
      $res = json_decode($res,true);
    }
    return ["res" => $res,"error" => $error];
  }
}

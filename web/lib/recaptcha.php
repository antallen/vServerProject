<?php
// 此為非常簡化版的驗證範例, 請斟酌修改
function recaptchacheck(){

    $secret_key = '6LdRmysUAAAAAEcuVqi5maLI9oKDemKHpTxzM_iw'; // 這個變數為申請的 Key, 請依照自己的案例修改
    $url = sprintf('https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s&remoteip=%s', $secret_key, $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    $res = json_decode(file_get_contents($url));
//var_dump($res->success); // true / false

  return ($res->success);
}


?>

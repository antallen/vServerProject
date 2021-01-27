<?php
// 將特殊字元加上跳脫
function escape_specialcharator($str){
  $reture_str = urldecode($str);
  $reture_str = trim($reture_str);
  $reture_str = substr($reture_str,0,50);
  $reture_str = nl2br($reture_str);
  $reture_str = strip_tags($reture_str);
  $reture_str = preg_replace('/s(?=s)/', "", $reture_str);
  $reture_str = preg_replace('/ch(.*?)/',"",$reture_str);
  $reture_str = preg_replace('/([‘’])/',"",$reture_str);
  $reture_str = preg_replace('/([\'])/', '',$reture_str);
  $reture_str = preg_replace('/([""])/', '',$reture_str);
  $reture_str = preg_replace('/([{}])/', '',$reture_str);
  $reture_str = preg_replace('/([!])/', '',$reture_str);
  $reture_str = preg_replace('/([#])/', '',$reture_str);
  $reture_str = preg_replace('/([%])/', '',$reture_str);
  $reture_str = preg_replace('/([$])/', '',$reture_str);
  $reture_str = preg_replace('/([-])/', '',$reture_str);
  $reture_str = preg_replace('/([_])/', '',$reture_str);
  $reture_str = preg_replace('/([*])/', '',$reture_str);
  $reture_str = preg_replace('/([&])/', '',$reture_str);
  $reture_str = preg_replace('/([\^])/', '',$reture_str);
  $reture_str = preg_replace('/([\[\]])/', '',$reture_str);
  $reture_str = preg_replace('/([\(\)])/', '',$reture_str);
  $reture_str = preg_replace('/([^A-Za-z0-9\p{Han}])/ui', '\\\\$1', $reture_str);
  //$reture_str = preg_replace('/([\'])/ui', '\'\'',$reture_str);
  $reture_str = stripslashes($reture_str);
  return $reture_str;
}

function email_check($str1){
  if ((preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$str1))&&(substr_count($str1,'@')==1)){
    return true;
  } else {
    return false;
  }
}
// 濾掉不合法的字元，只保留中文、英文、數字
//preg_replace('/([^A-Za-z0-9\p{Han}])/ui', '',urldecode($_GET['c']));

?>

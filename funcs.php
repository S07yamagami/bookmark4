<?php


// ログインチェク処理 loginCheck()
function loginCheck()
{
  if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
    // ログインを経由してない場合
    exit('LOGIN ERROR');
}

session_regenerate_id(true);
$_SESSION['chk_ssid'] = session_id();  
}
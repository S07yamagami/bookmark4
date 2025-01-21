<?php
try {
    // さくらサーバー用のデータベース接続設定
    $db_name = 'tealtapir84_gs_db';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'mysql3104.db.sakura.ne.jp'; //DBホスト
    $pdo = new PDO('mysql:dbname=tealtapir84_gs_db;charset=utf8;host=mysql3104.db.sakura.ne.jp', );
} catch (PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    exit('不正なリクエストです。');
}


$stmt = $pdo->prepare("DELETE FROM data_image WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('データ削除エラー: ' . htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8'));
} else {
    header('Location: read.php'); 
    exit;
}
?>

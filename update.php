<?php


$name   = $_POST['name'];
$email  = $_POST['email'];
$age    = $_POST['age'];
$content = $_POST['content'];
$id    = $_POST['id'];


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


$stmt = $pdo->prepare('UPDATE kousin 
                    SET 
                        name = :name,
                        email = :email,
                        age = :age,
                        content = :content,
                        indate = sysdate()
                    WHERE 
                        id = :id;
                        ');
    


$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_INT); //PARAM_INTなので注意
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); 
if ($status === false) {
   
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
   
    header('Location: select.php');
    exit();
}

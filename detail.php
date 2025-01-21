<?php

$id = $_GET['id'];
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

$stmt = $pdo->prepare('SELECT * FROM data_image WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
    
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .jumbotron {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
        }
        fieldset {
            border: none;
            text-align: center;
        }
        legend {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>書籍名：<input type="text" name="name"></label>
                <label>URL：<input type="text" name="url"></label>
                <label>コメント：<textarea name="content" rows="4"></textarea></label>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    

</body>

</html>
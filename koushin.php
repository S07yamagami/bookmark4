<?php
session_start();
require_once('funcs.php');
loginCheck();

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

$stmt = $pdo->prepare("SELECT * FROM data_image WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('データ取得エラー: ' . htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8'));
}

$data = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$data) {
    exit('データが見つかりません。');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    $image_path = $data['image']; // 現在の画像パス
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = 'uploads/';
        $uploaded_file = $upload_dir . basename($_FILES['image']['name']);

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
            $image_path = $uploaded_file;
        }
    }

    $updateStmt = $pdo->prepare("UPDATE data_image SET name = :name, url = :url, content = :content, image = :image WHERE id = :id");
    $updateStmt->bindValue(':name', $name, PDO::PARAM_STR);
    $updateStmt->bindValue(':url', $url, PDO::PARAM_STR);
    $updateStmt->bindValue(':content', $content, PDO::PARAM_STR);
    $updateStmt->bindValue(':image', $image_path, PDO::PARAM_STR);
    $updateStmt->bindValue(':id', $id, PDO::PARAM_INT);
    $updateStatus = $updateStmt->execute();

    if ($updateStatus === false) {
        $error = $updateStmt->errorInfo();
        exit('データ更新エラー: ' . htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8'));
    }

    header('Location: read.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ編集</title>
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

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-top: 5px;
            margin-bottom: 15px;
            font-size: 14px;
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
<div class="jumbotron">
    <fieldset>
        <legend>データ編集</legend>
        <form method="post" enctype="multipart/form-data">
            <label>書籍名：<input type="text" name="name" value="<?php echo htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'); ?>"></label>
            <label>URL：<input type="text" name="url" value="<?php echo htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8'); ?>"></label>
            <label>コメント：<textarea name="content" rows="4"><?php echo htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8'); ?></textarea></label>
            <label>現在の画像：<br>
                <?php if (!empty($data['image'])): ?>
                    <img src="<?php echo htmlspecialchars($data['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image" style="max-width:200px;"><br>
                <?php else: ?>
                    画像は登録されていません。
                <?php endif; ?>
            </label>
            <label>画像アップロード：<input type="file" name="image"></label>
            <input type="submit" value="更新">
        </form>
        <p><a href="read.php">一覧に戻る</a></p>
    </fieldset>
</div>
</body>
</html>

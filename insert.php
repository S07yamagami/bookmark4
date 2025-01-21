<?php


$name = isset($_POST['name']) ? $_POST['name'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$today = date('Y-m-d H:i:s'); // 現在日時
$image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

if (!empty($image)) {
    $upload_dir = 'uploads/'; // アップロード先のディレクトリ
    $upload_file = $upload_dir . basename($image);

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
        $image_path = $upload_file;
    } else {
        $image_path = '';
    }
} else {
    $image_path = '';
}

try {
    
    $pdo = new PDO('mysql:dbname=tealtapir84_gs_db;charset=utf8;host=mysql3104.db.sakura.ne.jp', );
} catch (PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}


$stmt = $pdo->prepare("INSERT INTO 
                        data_image (id, name, url, content, image, date) 
                        VALUES (NULL, :name, :url, :content, :image, :date)");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':date', $today, PDO::PARAM_STR);


$status = $stmt->execute();


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク登録結果</title>
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

        .form-item {
            margin-bottom: 15px;
            font-weight: bold;
            text-align: left;
        }

        .form-value {
            margin-bottom: 20px;
            padding: 8px 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        a {
            text-decoration: none;
            color: #4caf50;
            font-weight: bold;
        }

        a:hover {
            color: #388e3c;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="jumbotron">
        <fieldset>
            <legend>ブックマーク登録結果</legend>
            <?php if ($status === false): ?>
                <div class="form-item">データ登録エラー</div>
                <div class="form-value">
                    <?php 
                    $error = $stmt->errorInfo();
                    echo htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8'); 
                    ?>
                </div>
            <?php else: ?>
                <div class="form-item">■ 書籍名</div>
                <div class="form-value"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></div>

                <div class="form-item">■ URL</div>
                <div class="form-value"><?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?></div>

                <div class="form-item">■ コメント</div>
                <div class="form-value"><?php echo nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8')); ?></div>

                <div class="form-item">■ 画像</div>
                <div class="form-value">
                    <?php if (!empty($image_path)): ?>
                        <img src="<?php echo htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8'); ?>" alt="Uploaded Image" style="max-width:100%;">
                    <?php else: ?>
                        画像は登録されていません。
                    <?php endif; ?>
                </div>

                <div class="form-item">■ 送信日時</div>
                <div class="form-value"><?php echo htmlspecialchars($today, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <ul>
                <li><a href="read.php">データを確認する</a></li>
                <li><a href="index.php">フォームに戻る</a></li>
            </ul>
        </fieldset>
    </div>
</body>

</html>

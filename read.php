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


$stmt = $pdo->prepare("SELECT * FROM data_image;");
$status = $stmt->execute();


$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        $view .= '<div class="record">';
        $view .= '<h3>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</h3>';
        $view .= '<p><strong>URL:</strong> <a href="' . htmlspecialchars($row['url'], ENT_QUOTES, 'UTF-8') . '" target="_blank">' . htmlspecialchars($row['url'], ENT_QUOTES, 'UTF-8') . '</a></p>';
        $view .= '<p><strong>コメント:</strong> ' . nl2br(htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8')) . '</p>';
        if (!empty($row['image'])) {
            $view .= '<p><strong>画像:</strong><br><img src="' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') . '" alt="Image" style="max-width:200px;"></p>';
        } else {
            $view .= '<p><strong>画像:</strong> 登録されていません。</p>';
        }
        $view .= '<p><small>登録日時: ' . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . '</small></p>';
        $view .= '<a href="koushin.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary">編集</a> ';
        $view .= '<a href="delete.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '" class="btn btn-danger" onclick="return confirm(\'本当に削除しますか？\')">削除</a>';
        $view .= '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <div class="jumbotron">
        <fieldset>
            <legend>ブックマーク一覧</legend>
            <?php echo $view; ?>
            <a href="index.php" class="back-link">トップに戻る</a>
        </fieldset>
    </div>
</body>

</html>

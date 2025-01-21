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

        .navbar {
            background-color: #4caf50;
            border: none;
            border-radius: 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.2em;
            padding: 10px;
        }

        .navbar-brand:hover {
            color: #c8e6c9 !important;
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
            transition: transform 0.2s, background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        input[type="submit"]:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="read.php">ブックマーク一覧</a>
                    <a class="navbar-brand" href="login.php">ログイン</a>
                    <a class="navbar-brand" href="logout.php">ログアウト</a>
                </div>
            </div>
        </nav>
    </header>

    <form method="post" action="insert.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>書籍名：<input type="text" name="name"></label>
                <label>URL：<input type="text" name="url"></label>
                <label>コメント：<textarea name="content" rows="4"></textarea></label>
                <label>画像アップロード：<input type="file" name="image"></label>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>

</body>

</html>

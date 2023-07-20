<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// MySQLデータベース接続情報
$servername = "localhost"; // データベースサーバーのアドレス
$username = "root"; // データベースのユーザー名
$password = ""; // データベースのパスワード
$dbname = "git-test"; // データベース名

// フォームから送信されたデータを変数に格納
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$destination = $_POST['destination']; // 追加した部分

// MySQLデータベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーの確認
if ($conn->connect_error) {
    die("データベース接続エラー: " . $conn->connect_error);
}

// データベースにデータを挿入するSQLクエリの作成 (宛先を含む)
$sql = "INSERT INTO comments (name, email, message, destination) VALUES ('$name', '$email', '$message', '$destination')";

// クエリの実行と結果の確認
if ($conn->query($sql) === TRUE) {
    echo "データが正常に挿入されました。";
} else {
    echo "データ挿入エラー: " . $conn->error;
}

// データベース接続を閉じる
$conn->close();
?>

</body>
</html>

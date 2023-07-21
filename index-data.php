<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="css/data.css">
</head>
<body>
    <div class="main">
        <div class="header">
            <h2>お問い合わせ一覧</h2>
        </div>

        <?php
        // データベース接続情報
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "git-test";

        // データベースに接続
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 接続エラーの確認
        if ($conn->connect_error) {
            die("データベースへの接続に失敗しました: " . $conn->connect_error);
        }

        // 削除対象のデータの ID を取得
        $id = $_GET['id'] ?? '';

        // ID が指定されている場合はデータを削除
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }

        // データを取得するSQLクエリ
        $sql = "SELECT id, name, email, message FROM comments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='data-table'>";
            echo "<table>";
            echo "<tr><th>ID</th><th>名前</th><th>メールアドレス</th><th>メッセージ</th><th>削除</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['message']."</td>";
                echo "<td><a href='index-data.php?id=".$row['id']."'>削除</a></td>"; // 同じページにリダイレクトする
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>データがありません</p>";
        }

        $conn->close();
        ?>

    </div>
</body>
</html>

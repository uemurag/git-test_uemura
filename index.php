<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title> Git・PHP・SQLテスト課題</title>
</head>
<body>
	<div class="container">
		<h1> Git・PHP・SQLテスト課題</h1>
		<section class="member">
			<h2>Member</h2>
			<div class="uemura">
				<h3>Profile</h3><!-- 上村 -->			
				<img src="kimimaro.jpg" alt="kimimaro"><br><!-- 写真（サイズ何でもOK！） -->
				<b>きみまろ</b><!-- 名前 -->		
				<p>周りの人の幸せが一番</p><!-- 自己紹介 -->		
			</div>
			<div class="wakagi">
				<h3>Profile</h3><!-- 若木さん -->			
				<img src="img/neko.JPEG" alt=""><br><!-- 写真（サイズ何でもOK！） -->
				<b>わかぎ</b><!-- ご自身の名前 -->		
				<p>いい加減</p><!-- 自己紹介 -->		
			</div>
			<div class="yamasaki">
				<h3>Profile</h3><!-- 山崎さん -->			
				<img src="" alt=""><br><!-- 写真（サイズ何でもOK！） -->
				<b></b><!-- ご自身の名前 -->		
				<p></p><!-- 自己紹介 -->		
			</div>
		</section>


		<section class="contact-form">
			<h2>お問い合わせフォーム</h2>
			<form action="send.php" method="POST">
				<div>
					<label for="name">お名前</label><br>
					<input type="text" id="name" name="name" autofocus required >
				</div>
				<div>
					<label for="email">メールアドレス</label><br>
					<input type="email" id="email" name="email" placeholder="fullofdreams@inbothhands.com" required>
				</div>
				<div>
					<label for="">宛先</label><br>
					<select name="subject">
					<option value="destination">選択してください</option>
					<option value="わかぎさん">わかぎ</option>
					<option value="しんちゃん">しんちゃん</option>
					<option value="きみまろ">きみまろ</option>
					</select>
					</div>
				<div>
					<label for="message">お問い合わせ内容</label><br>
					<textarea name="message" id="message" cols="30" rows="10"></textarea>
				</div>
				<div>
					<input type="submit" id="submit" value="送信" >
				</div>		 
			</form>
		</section>

		<section class="comments-received-today">
		<?php
		// MySQLデータベース接続情報
		$servername = "localhost"; // データベースサーバーのアドレス
		$username = "root"; // データベースのユーザー名
		$password = ""; // データベースのパスワード
		$dbname = "git-test"; // データベース名

		// MySQLデータベースへの接続
		$conn = new mysqli($servername, $username, $password, $dbname);

		// 接続エラーの確認
		if ($conn->connect_error) {
				die("データベース接続エラー: " . $conn->connect_error);
		}

		// commentsテーブルから最新の10件のmessageを取得するSQLクエリの作成
		$sql = "SELECT message FROM comments ORDER BY id DESC LIMIT 10";

		// クエリの実行と結果の確認
		$result = $conn->query($sql);

		// データを表示
		if ($result->num_rows > 0) {
				echo '<section class="comments-received-today">';
				echo '<h2>今日もらったコメント</h2>';
				while ($row = $result->fetch_assoc()) {
						// <p>タグを<u>タグでラップして、下線を引く
						echo '<u><p>' . htmlspecialchars($row['message']) . '</p></u>';
				}
				echo '</section>';
		} else {
				echo '<p>まだコメントはありません。</p>';
		}

		// データベース接続を閉じる
		$conn->close();
		?>

		<!-- <?php
			// MySQLデータベース接続情報
			$servername = "localhost"; // データベースサーバーのアドレス
			$username = "root"; // データベースのユーザー名
			$password = ""; // データベースのパスワード
			$dbname = "git-test"; // データベース名

			// MySQLデータベースへの接続
			$conn = new mysqli($servername, $username, $password, $dbname);

			// 接続エラーの確認
			if ($conn->connect_error) {
					die("データベース接続エラー: " . $conn->connect_error);
			}

			// commentsテーブルから最新の10件のmessageを取得するSQLクエリの作成
			$sql = "SELECT message FROM comments ORDER BY id DESC LIMIT 10";

			// クエリの実行と結果の確認
			$result = $conn->query($sql);

			// データを表示
			if ($result->num_rows > 0) {
					echo '<section class="comments-received-today">';
					echo '<h2>今日もらったコメント</h2>';
					while ($row = $result->fetch_assoc()) {
							echo '<p>' . htmlspecialchars($row['message']) . '</p>';
					}
					echo '</section>';
			} else {
					echo '<p>まだコメントはありません。</p>';
			}

			// データベース接続を閉じる
			$conn->close();
			?> -->

	</div>	
</body>
</html>
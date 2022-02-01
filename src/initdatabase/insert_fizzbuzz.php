<?php

try {
    // DB接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=db;dbname=test;',
        // ユーザー名
        'root',
        // パスワード
        'test',
        // レコード列名をキーとして取得させる
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
 
    // SQL文をセット
    $stmt = $pdo->prepare('INSERT INTO FizzBuzz (id, message) VALUES(:id, :message)');
 

    for($i = 1;$i <= 100;$i++){
        $stmt->bindValue(':id',$i);
        if ($i % 3 == 0 && $i % 5 == 0) {
            $stmt->bindValue(':message', 'FizzBuzz');
        } else if ($i % 3 == 0) {
            $stmt->bindValue(':message', 'Fizz');
        } else if ($i % 5 == 0) {
            $stmt->bindValue(':message', 'Buzz');
        } else {
            $stmt->bindValue(':message', 'normal');
        }
        // SQL実行
        $stmt->execute();
    }
 
} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();
 
} finally {
    // DB接続を閉じる
    $pdo = null;
}
?>
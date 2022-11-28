<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="レ　ダット"/>
    <link rel="stylesheet" href="st.css" type="text/css"> 
    <title>ログイン</title>
</head>
<body>
    <div class="loginbox">
        <img src="avatar.png" class="avatar">
        <h1>ログイン</h1>
        <form action="checklogin.php" method="POST">
            <p>ユーザー名:</p>
            <input type="text" name="username" placeholder="Enter Username"></br>
            <p>パスワード:</p>
            <input type="password" name="password" placeholder="Enter Password"></br>
            <input type="submit" value="ログイン">
        </form>
    
    </div>
</body>
</html>
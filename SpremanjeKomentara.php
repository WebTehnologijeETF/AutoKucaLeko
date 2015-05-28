<?php
$pdo = new PDO("mysql:dbname=db_akleko;host=localhost;charset=utf8", "aklekouser", "password");

$sql = "INSERT INTO komentar (id,
            vijest,
            text,
            autor,
            email,
            vrijeme) VALUES (
            NULL, 
            :vijest, 
            :text, 
            :autor, 
            :email,
            CURRENT_TIMESTAMP)";


                                          
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':vijest'=>$_GET['vijest'],
                  ':text'=>$_POST['komentar'],
                  ':autor'=>$_POST['ime'],
                  ':email'=>$_POST['email']));


echo "<p>Vaš komentar je spremljen</p>";
echo "<p>Hvala na komentaru!</p>";

echo "<a href='javascript:history.go(-2)'>Vratite se nazad...</a>";

?>
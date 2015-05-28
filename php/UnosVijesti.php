<?php
if(isset($_POST['submit4']))
{
    $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
    $stmt = $veza->prepare("INSERT INTO vijest (id, naslov, tekst, autor, vrijeme_vijesti) VALUES ('NULL', :atribut1, :atribut2, :atribut3, CURRENT_TIMESTAMP)");

    $stmt->bindParam(':atribut1', $_POST['naslov'], PDO::PARAM_STR);
    $stmt->bindParam(':atribut2', $_POST['tekst'], PDO::PARAM_STR);
	$stmt->bindParam(':atribut3', $_POST['autor'], PDO::PARAM_STR);

	if($stmt->execute()) 
    {
	    echo 'Uspješno ste dodali korisnika';
        header("Location: Admin.php");  
	}
} 
else
{
    echo "<p> Nije uradjena validacija, pretpostavimo da ce tutor unijeti sve kako treba</p>";
    echo "<br><br>";

    echo "<form action='UnosVijesti.php' method='post'>";
    echo "<input type='text' name='autor' placeholder='e.g. Mesud Klisura'>";
    echo "<input type='text' name='naslov' placeholder='e.g. Nslov vijesti'>";
    echo "<input type='text' name='tekst' placeholder='e.g. Neki tekst vijesti'>";
    echo "<input type='submit' id='dugme' name='submit4' value='dodavanje'>";
    echo "</form>";
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>

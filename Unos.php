<?php
if(isset($_POST['submit4']))
{
    $veza = new PDO("mysql:dbname=db_akleko;host=localhost;charset=utf8", "aklekouser", "password");
    $stmt = $veza->prepare("INSERT INTO korisnici (id, korisnickoime, sifra, tip, email) VALUES ('NULL', :atribut1, :atribut2, :atribut3, :atribut4)");

    $stmt->bindParam(':atribut1', $_POST['ime'], PDO::PARAM_STR, 100);
    $stmt->bindParam(':atribut2', $_POST['sifra'], PDO::PARAM_STR, 100);
	$stmt->bindParam(':atribut3', $_POST['tip'], PDO::PARAM_STR, 100);
    $stmt->bindParam(':atribut4', $_POST['email'], PDO::PARAM_STR, 100);

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

    echo "<form action='Unos.php' method='post'>";
    echo "<input type='text' name='ime' placeholder='e.g. mklisura1'>";
    echo "<input type='text' name='sifra' placeholder='e.g. 0802993193037'>";
    echo "<input type='text' name='tip' placeholder='e.g. admin'>";
    echo "<input type='text' name='email' placeholder='e.g. mklisura1@etf.unsa.ba'>";
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

<?php
    
session_start();

if(isset($_POST['submitLogin']))
{
    if(empty($_POST['korisnickoime']) || empty($_POST['sifra']))
    {
        $greska="Neispravno korisnicko ime ili sifra";
    }
    else
    {
        $korisnik=$_POST['korisnickoime'];
        $sifra= $_POST['sifra'];

        $connection = mysql_connect("127.10.214.130", "aklekouser", "password");

        $db = mysql_select_db("db_akleko", $connection);

        $query = mysql_query("select * from korisnici where sifra='$sifra' AND korisnickoime='$korisnik'", $connection);
        $rows = mysql_num_rows($query);


        /*
        $veza = new PDO("mysql:dbname=db_akleko;host=localhost;charset=utf8", "aklekouser", "password");
	    $veza->exec("set names utf8");
        $rezultat = $veza->query("select * FROM korisnici WHERE korisnickoime=".$korisnik." and sifra=".$sifra);
	    $rezultat->execute();
	    $result = $rezultat->fetch(\PDO::FETCH_ASSOC);
        */
        if($rows==1)
        {
            $_SESSION['login_user']=$korisnik;
            header("location: Admin.php");    
        }
        else
        {
            $greska="Neispravno korisničco ime ili sifra";
            echo "<p> Imate grešku u unesenim podacima: ".$greska."";
            echo "<br><br>";
            echo "<a href='index.html'>Povratak nazad...</a>";
            
        }
    }
}

?>



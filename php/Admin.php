<?php
include('Sesija.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="StyleAdmin.css" />
        <title></title>
    </head>
    <body>
        <div >
            <div id="profile">
                <p id="ime">Prijavljeni ste sa nalogom: <?php echo $login_session; ?></p>
                <p id="odjava"><a href="Logout.php">Odjavite se</a></p>
            </div>

            <div id="korisnici">
                <p>Prikaz svih korisnika sistema</p>
<?php
/*Ako se klikne na dugme za izmjenu*/
if(isset($_POST['submit1']))
{
    header("Location: Unos.php");
}
/*Ako se klikne na dugme za brisanje*/
elseif (isset($_POST['submit2']))
{
    $connection = mysql_connect("127.10.214.130", "aklekouser", "password");

    $db = mysql_select_db("db_akleko", $connection);

    $query = mysql_query("select * from korisnici", $connection);
    $rows = mysql_num_rows($query);


    if($rows!=1)
    {
        $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
        $sql = "DELETE FROM korisnici WHERE id =  :id";
        $stmt = $veza->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
        $stmt->execute();
        echo '<script language="javascript">';
        echo 'alert("Uspješno ste obrisali korisnika")';
        echo '</script>';
        
        /*Ponovni ispis (refresh)*/
        $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
        $rezultat = $veza->query("select * from korisnici");
	                         
        if (!$rezultat) {
            $greska = $veza->errorInfo();
	        print "SQL greška: " . $greska[2];
	        exit();
        }

        /*Prikaz korisnika*/
        foreach ($rezultat as $vijest) {

            echo "<div class='Korisnik'>";

            print "<h3>".$vijest['korisnickoime']."<br></h3>";
            echo '<img src="Pictures/User.png" alt="Nema slike"/>';
            print "<h4>".$vijest['tip']."</h4>";
            print "<h3>".$vijest['email']."</h3>";

            echo "<form action='Admin.php' method='post'>";
                echo "<input type='submit' id='dugme' name='submit1' value='promjena'>";
                echo "<input type='submit' id='dugme' name='submit2' value='obrisi'>";
                echo "<input type='hidden' name='id' value='".$vijest['id']."'>";
            echo "</form>";

            echo "</div>";
        }    
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Ne možete obrisati sve korisnike!")';
        echo '</script>'; 
        
        /*ponovni ispis (refresh)*/ 
        $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
        $rezultat = $veza->query("select * from korisnici");
	                         
        if (!$rezultat) {
            $greska = $veza->errorInfo();
	        print "SQL greška: " . $greska[2];
	        exit();
        }

        /*Prikaz korisnika*/
        echo "<form action='Admin.php' method='post'>";
        echo "<input type='submit' id='dugme' name='submit3' value='dodavanje'>";
        echo "</form>";
        foreach ($rezultat as $vijest) {

            echo "<div class='Korisnik'>";

            print "<h3>".$vijest['korisnickoime']."<br></h3>";
            echo '<img src="Pictures/User.png" alt="Nema slike"/>';
            print "<h4>".$vijest['tip']."</h4>";
            print "<h3>".$vijest['email']."</h3>";

            echo "<form action='Admin.php' method='post'>";
                echo "<input type='submit' id='dugme' name='submit1' value='promjena'>";
                echo "<input type='submit' id='dugme' name='submit2' value='obrisi'>";
                echo "<input type='hidden' name='id' value='".$vijest['id']."'>";
            echo "</form>";

            echo "</div>";
        } 
    }

}
elseif (isset($_POST['submit3']))
{
    header("Location: Unos.php");
}




/*Ako nista nije kliknuto, samo prikazivanje*/
else
{

/*Dio za prikaz korisnika*/    
    $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
    $rezultat = $veza->query("select * from korisnici");
	                         
    if (!$rezultat) {
        $greska = $veza->errorInfo();
	    print "SQL greška: " . $greska[2];
	    exit();
    }
    /*Dugme za dodavanje*/
    echo "<form action='Admin.php' method='post'>";
    echo "<input type='submit' id='dugme' name='submit3' value='dodavanje'>";
    echo "</form>";
    /*Prikaz korisnika*/
    foreach ($rezultat as $vijest) {

        echo "<div class='Korisnik'>";

        print "<h3>".$vijest['korisnickoime']."<br></h3>";
        echo '<img src="Pictures/User.png" alt="Nema slike"/>';
        print "<h4>".$vijest['tip']."</h4>";
        print "<h3>".$vijest['email']."</h3>";

        echo "<form action='Admin.php' method='post'>";
            echo "<input type='submit' id='dugme' name='submit1' value='promjena'>";
            echo "<input type='submit' id='dugme' name='submit2' value='obrisi'>";
            echo "<input type='hidden' name='id' value='".$vijest['id']."'>";
        echo "</form>";

        echo "</div>";
    }
}
                        
?>
        
            </div>






            <div id="vijesti">
                <p>Prikaz svih vjesti</p>
<?php
    
/*Dio za prikaz novosti i komentara*/

if(isset($_POST['submit4']))
{
    header("Location: UnosVijesti.php");
}
else if(isset($_POST['submit5']))
{
    $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
    $sql = "DELETE FROM vijest WHERE id =  :id";
    $stmt = $veza->prepare($sql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $stmt->execute();
    echo '<script language="javascript">';
    echo 'alert("Uspješno ste obrisali vijest")';
    echo '</script>';

    /*Ponovni prikaz vijesti*/
    $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
	$veza->exec("set names utf8");
	$rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme_vijesti) vrijeme2, autor from vijest order by vrijeme_vijesti desc");
	      

    /*Prikaz vijesti u klasi Clanak*/
    echo "<form action='Admin.php' method='post'>";
    echo "<input type='submit' id='dugme' name='submit6' value='dodavanje'>";
    echo "</form>";
	foreach ($rezultat as $vijest) 
    {
        echo "<div class='Clanak'>";

        print "<h6>".$vijest['autor']."<br>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</h6>";
        print "<br>";
        print "<h3>".$vijest['naslov']."</h3>";
        echo '<img src="Articles/'.$vijest['id'].'/1.jpg" alt="Vijest nema slike"/>';
        print "<p> ".$vijest['tekst']."</p>";


        echo "<form action='Admin.php' method='post'>";
        echo "<input type='submit' id='dugme' name='submit4' value='promjena'>";
        echo "<input type='submit' id='dugme' name='submit5' value='obrisi'>";
        echo "<input type='hidden' name='id' value='".$vijest['id']."'>";
        echo "</form>";

        echo "</div>";
    }
    
}
elseif (isset($_POST['submit6']))
{
    header("Location: UnosVijesti.php");
}
else
{
    $veza = new PDO("mysql:dbname=db_akleko;host=127.10.214.130;charset=utf8", "aklekouser", "password");
	$veza->exec("set names utf8");
	$rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme_vijesti) vrijeme2, autor from vijest order by vrijeme_vijesti desc");
	                         
    if (!$rezultat) 
    {
	    $greska = $veza->errorInfo();
	    print "SQL greška: " . $greska[2];
	    exit();
	}
    /*Dugme za dodavanje*/
    echo "<form action='Admin.php' method='post'>";
    echo "<input type='submit' id='dugme' name='submit6' value='dodavanje'>";
    echo "</form>";

    /*Prikaz vijesti u klasi Clanak*/
	foreach ($rezultat as $vijest) 
    {
        echo "<div class='Clanak'>";

        print "<h6>".$vijest['autor']."<br>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</h6>";
        print "<br>";
        print "<h3>".$vijest['naslov']."</h3>";
        echo '<img src="Articles/'.$vijest['id'].'/1.jpg" alt="Vijest nema slike"/>';
        print "<p> ".$vijest['tekst']."</p>";


        echo "<form action='Admin.php' method='post'>";
        echo "<input type='submit' id='dugme' name='submit4' value='promjena'>";
        echo "<input type='submit' id='dugme' name='submit5' value='obrisi'>";
        echo "<input type='hidden' name='id' value='".$vijest['id']."'>";
        echo "</form>";

        echo "</div>";
    }
}
?>
            </div>

        </div>

        
    </body>
</html>

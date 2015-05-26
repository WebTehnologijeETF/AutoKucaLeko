<!DOCTYPE HTML>
<HTML>
<HEAD>
    <title>Auto kuća Leko | Novosti</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<link rel="icon" type="image/x-icon" href="Pictures/icon.png">
    <META http-equiv="content-type" content="text/html;charset=utf-8">
</HEAD>
    <BODY id="pocetna">
            <div class="GlavniDio">
            <!--Dio za vijesti i glavno sto se tiče Auto kuće-->
                <div class="DesniDio">
                <!--DesniDio Glavnog dijela-->
                    <div class="Kontakt">
                    <!--Dio za kontakt-->
                        <h2>Kontaktirajte nas</h2>

                        <p>Auto kuća Leko<br><br>Dubrovačka b.b<br>88000 Mostar</p>
                        <img class="SlikaLocation" src="Pictures/location.png" alt="a">

                        <p>Tel.: ++387 36 333 580<br>Fax.: ++387 36 333 549</p>
                        <img class="SlikaTelefon" src="Pictures/phone.png" alt="a">

                        <p>Radno vrijeme: 08:00 - 18:00</p>
                        <img class="SlikaRadnoVrijeme" src="Pictures/lock.png" alt="a">

                        <p>e-mail: info@ao-leko.com</p>
                        <img class="SlikaMail" src="Pictures/mail.png" alt="a">
             
                    </div>

                    <div class="Mapa">
                    <!--Kako doci do nas-->
                    <h2>Kako doći do nas?</h2>
                        
                        <div class="MapaUpute">

                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2901.225189222883!2d17.794570999999994!3d43.351400000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x134b43bdc9a2cf4b%3A0xadbafa9a67c405cf!2sA.O.+Leko!5e0!3m2!1sbs!2sba!4v1427993283220" 
                            width="310" 
                            height="200" 
                            style="border:0"></iframe>
                        
                        </div>
                    </div>

                
                </div>

                <div class="LijeviDio">
                <!--LijeviDio Glavnog dijela--> 
                </div>

                <div class="SredinaDio">
                <!--SrednjiDio Glavnog dijela-->
                    <h2>Zanimljivosti</h2>

                    
                    <?php
                        
                        
                        if(isset($_GET['vijest']))
                        {
    	                    $veza = new PDO("mysql:dbname=db_akleko;host=localhost;charset=utf8", "aklekouser", "password");
	                        /*
                            Spriječen SQL Injection
                            */

                            $unsafe_variable = $_GET['vijest'];
                            $rezultat = $veza->prepare('select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme_vijesti) vrijeme2, autor from vijest where id=:safe_variable');   
                            $rezultat->execute(array('safe_variable' => $unsafe_variable));

	                        if (!$rezultat) {
	                            $greska = $veza->errorInfo();
	                            print "SQL greška: " . $greska[2];
	                            exit();
	                        }
		                    foreach ($rezultat as $vijest) {
                                /*Dio za prikaz vijesti pa onda komentara ispod*/
                                echo "<div class='Clanak'>";

                                print "<h6>".$vijest['autor']."<br>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</h6>";
                                print "<br>";
                                print "<h3>".$vijest['naslov']."</h3>";
                                echo '<img src="Articles/'.$vijest['id'].'/1.jpg" alt="Vijest nema slike"/>';
                                print "<p> ".$vijest['tekst']."</p>";

                                echo "</div>";
                                /*Komentari na odredjenu vijest*/
                                $unsafe_variable = $_GET['vijest'];
                                $komentar2 = $veza->prepare('select * FROM komentar WHERE vijest=:safe_variable order by vrijeme asc');
                                
                                $komentar2->execute(array('safe_variable' => $unsafe_variable));

	                            foreach ($komentar2 as $komentar) {
                                    echo "<div class='Clanak'>";
                                    print "<h6>".$komentar['autor']." -- ".$komentar['email']."<br>".$komentar['vrijeme']."</h6>";
	        	                    print "<p>".$komentar['text']."</p>";
	        	                    
	        	                    print "<br>";

                                    echo "</div>";
	                            }

	                        }
                            
                             /*Dio za ostavljanje komentara*/
                             echo "<div class='Clanak'>";

                             print "<h3>Ostavite i vi svoj komentar</h3>";
                             /*Forma za komentare - KomentarForma */
                             print "<form id='KomentarForma' action='SpremanjeKomentara.php?vijest=".$vijest['id']."' method='POST'>";
                             print "e-mail:<br>";
                             print "<input type='text' name='email' id='email'><br>";
                             print "Ime:<br>";
                             print "<input type='text' name='ime' id='ime'><br>";
                             print "Komentar:<br>";
                             print "<textarea cols='22' rows='7' id='komentar' name='komentar'></textarea><br><br>";
                             print "<input class='submit' type='submit' value='Pošalji'>";
                             print "<input type='hidden' name='vijest' id='vijest' value='".$_GET['vijest']."'>";
                             print "<br><br>";

                             print "</form>";

                             echo "</div>";
                        }
                        else
                        {
    	                    $veza = new PDO("mysql:dbname=db_akleko;host=localhost;charset=utf8", "aklekouser", "password");
	                        $veza->exec("set names utf8");
	                        $rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme_vijesti) vrijeme2, autor from vijest order by vrijeme_vijesti desc");
	                         
                            if (!$rezultat) {
	                             $greska = $veza->errorInfo();
	                             print "SQL greška: " . $greska[2];
	                             exit();
	                        }

                            /*Prikaz vijesti u klasi Clanak*/
	                        foreach ($rezultat as $vijest) {
	     	                    $komentar = $veza->query("select COUNT(*) as broj FROM komentar WHERE vijest=".$vijest['id']);

                        	    echo "<div class='Clanak'>";

                                print "<h6>".$vijest['autor']."<br>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</h6>";
                                print "<br>";
                                print "<h3>".$vijest['naslov']."</h3>";
                                echo '<img src="Articles/'.$vijest['id'].'/1.jpg" alt="Vijest nema slike"/>';
                                print "<p> ".$vijest['tekst']."</p>";
                                                                  

	                            $komentar->execute();
	                            $result = $komentar->fetch(\PDO::FETCH_ASSOC);
                                echo '<img id="slikakomentara" src="Pictures/chat4.png" alt=""/>';

	                            print "<a href='Novosti.php?vijest=".$vijest['id']."'>".$result['broj']."</a>";

                                echo "</div>";
                             }

                        }

                        ?>

                    <??>

                    
                </div>
            
            </div>
        <script src="js/DropDownScript.js"></script>
    </BODY>

</HTML>

<?php

$connection = mysql_connect("127.10.214.130", "aklekouser", "password");
$db = mysql_select_db("db_akleko", $connection);

session_start();
$user_check=$_SESSION['login_user'];
$query = mysql_query("select * from korisnici where korisnickoime='$user_check'", $connection);

$row = mysql_fetch_assoc($query);

$login_session =$row['korisnickoime'];
if(!isset($login_session))
{
    mysql_close($connection);
    header('Location: index.html');
}
?>
<?php
session_start();
  $aikaleima = date("Y-m-d--H-i-s");
  define("BLOGI_FILE", "datadir/$aikaleima.txt");
 
// Lisätään viesti
if(isset($_GET[nappi])) {
 
  // Luetaan vanhat merkinnät talteen
  if (!$fp = @fopen(BLOGI_FILE, "w"))
    {echo "fopen virhe!"; exit();}
 
  // Valmistellaan merkintä
  $_GET[merkinta] = strip_tags(nl2br($_GET['merkinta']), '<a>');
 
  $blogimerkinta = <<<BLOGIMERKINTA
  <div id="posti">
  <h2>{$_SESSION['uid']}</h2>
  <p>{$_GET[merkinta]}</p>
  </div>
  </br>
BLOGIMERKINTA;
  fwrite($fp, $blogimerkinta);
  fclose($fp);
}
 
 
header("Location: http://" . $_SERVER[HTTP_HOST]
                           . dirname($_SERVER[PHP_SELF]) . '/'
                           . "index.php");
exit;
?>

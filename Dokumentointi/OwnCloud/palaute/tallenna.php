<?php
  $aikaleima = date("Y-m-d--H-i-s");
  define("BLOGI_FILE", "datadir/$aikaleima.txt");

// Lisätään viesti
if(isset($_GET[nappi])) {

  // Luetaan vanhat merkinnät talteen
  if (!$fp = @fopen(BLOGI_FILE, "w"))
    {echo "fopen virhe!"; exit();}

  // Valmistellaan merkintä
  $_GET[merkinta] = (nl2br($_GET[merkinta]));

  $blogimerkinta = <<<BLOGIMERKINTA
  <p>{$_GET[merkinta]}</p>
BLOGIMERKINTA;
  fwrite($fp, $blogimerkinta);
  fclose($fp);
}


header("Location: http://" . $_SERVER[HTTP_HOST]
                           . dirname($_SERVER[PHP_SELF]) . '/'
                           . "palaute.php");
exit;
?>
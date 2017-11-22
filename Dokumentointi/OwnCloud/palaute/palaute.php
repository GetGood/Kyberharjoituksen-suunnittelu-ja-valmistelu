<!DOCTYPE html>
<html>
<head>
        <title>Palaute</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<section>
<article>

<h2>Tähän voit jättää rakentavaa palautetta</h2>
<div id=container>
    <?php
    echo "<h3>Viimeisimmät rakentavat palautteet</h3>";

    foreach (glob("datadir/*.txt") as $filename) {
        $filet[] = $filename;
    }

    rsort($filet);

    foreach ($filet as $filename) {
        echo "<div>";
        include($filename);
        echo "</div>\n";
    }

    ?>
</div>

<?php
  $serverpath = dirname($_SERVER[SCRIPT_FILENAME]);
  $urlpath = dirname($_SERVER[SCRIPT_NAME]);
  $datapath = "/datadir/";
  $datadir = "$serverpath" . "$datapath";
  $urldir = "$urlpath" . "$datapath";

  if(isset($_FILES[myfile][tmp_name])) {
    tallenna($datadir, $urldir);
  } else {
  }

  function tallenna($datadir, $webdir) {
    global $finaldir;
    $uploadfile = $datadir . $_FILES[myfile][name];
    $file_ext = strtolower(end(explode(".", $_FILES[myfile][name])));
    if (move_uploaded_file($_FILES[myfile][tmp_name], $uploadfile)) {
      echo "<p>Kopioitiin tiedosto: {$_FILES[myfile][name]}</p>";
      $finaldir = $webdir .$_FILES[myfile][name];
    } else {
      echo "<p>Tiedoston kopioiminen epäonnistui</p>";
    }
  }

?>

<div id=container>
    <?php
    ?>
    <h3>Lisää merkintä</h3>
    <div class="form-box">
        <form action="tallenna.php" method="get">
          Merkintä:<br>
          <textarea cols="30" rows="4" name="merkinta"></textarea><br><br>
          <input type="submit" name="nappi" value="Tallenna">
          <br>
        </form>
    </div>
</div>
</article>
</section>
</body>
</html>
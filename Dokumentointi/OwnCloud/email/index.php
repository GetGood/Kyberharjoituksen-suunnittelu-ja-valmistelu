<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <title>EMAIL</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
      
        <h1>Datacenter<span class="headervari">Email</span></h1>
		<h2><a href="index.html">Etusivulle</a></h2>
</header>
 
<section>
<?php
if (isset($_SESSION['uid'])) {
echo "logged in: " . $_SESSION['uid'];
echo "<a href='logout.php'> [Logout] </a>";
}
?>
<article>
 
<h2>Tervetuloa!</h2>
<div id=container>
    <?php
	if (!isset($_SESSION['uid'])) {
	header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "login.php");
	}
    echo "<h3>Inbox</h3>";
 
    foreach (glob("datadir/*.txt") as $filename) {
        $filet[] = $filename;
    }
 
    rsort($filet);
 
    foreach ($filet as $filename) {
       // echo "<div>";
        include($filename);
        //echo "</div>\n";
    }
 
    ?>
</div>
 
<?php
  $serverpath = dirname($_SERVER['SCRIPT_FILENAME']);
  $urlpath = dirname($_SERVER['SCRIPT_NAME']);
  $datapath = "/datadir/";
  $datadir = "$serverpath" . "$datapath";
  $urldir = "$urlpath" . "$datapath";
 
  if(isset($_FILES['myfile']['tmp_name'])) {
    tallenna($datadir, $urldir);
  } else {
  }
 
  function tallenna($datadir, $webdir) {
    global $finaldir;
    $uploadfile = $datadir . $_FILES['myfile'][name];
    $file_ext = strtolower(end(explode(".", $_FILES['myfile'][name])));
    if (move_uploaded_file($_FILES['myfile'][tmp_name], $uploadfile)) {
      echo "<p>Kopioitiin tiedosto: {$_FILES['myfile'][name]}</p>";
      $finaldir = $webdir .$_FILES['myfile'][name];
    } else {
      echo "<p>Tiedoston kopioiminen epäonnistui</p>";
    }
  }
 
?>
 
<div id=container>
    <h3>Lähetä sähköpostia</h3>
    <div class="form-box">
        <form action="tallenna.php" method="get">
          Teksti:<br>
          <textarea cols="30" rows="4" name="merkinta"></textarea><br><br>
          <input type="submit" name="nappi" value="Lähetä">
          <br>
        </form>
    </div>
</div>
</article>
</section>
  <footer>
      <p>Datacenter</p>
    </footer>
</body>
</html>
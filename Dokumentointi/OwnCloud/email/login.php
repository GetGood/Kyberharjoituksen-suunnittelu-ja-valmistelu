<?php
// login.php
session_start();
$userinfo = array(
                'admin@datacenter.fi'=>'admin66',
                'pomo@datacenter.fi'=>'pomo66',
				'user@joku.fi'=>'user66',
				'asiakas@hottismail.fi'=>'asiakas66',
				'haggerson@hakmail.rus'=>'hagger66'
                );
$errmsg = '';
if(isset($_POST['uid'])) {
    if($userinfo[$_POST['uid']] == $_POST['pwd']) {
        $_SESSION['uid'] = $_POST['uid'];
        header("Location: http://" . $_SERVER['HTTP_HOST']
                                    . dirname($_SERVER['PHP_SELF']) . '/'
                                    . "index.php");
        exit;
    }else {
        $errmsg = '<span style="background: yellow;">Tunnus/Salasana väärin!';
    }
}
         
          
      
 
?>
  
<title>Kirjautusmislomake</title>
  
<?php
if ($errmsg != '') echo $errmsg;
?>
  
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"
style=color:#000;background-color:#eeeeee>
Sähköposti:<br><input type="text" name="uid" size="30"><br>
Salasana:<br><input type="text" name="pwd" size="30"><br>
<input type='submit' name='action' value='Kirjaudu'>
<br>
</form>
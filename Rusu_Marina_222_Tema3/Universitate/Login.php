<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      
    <link rel="stylesheet" href="Styles/login.css">
        <title>Login</title>
    </head>
    <body>
    <form action="Home.php" method="POST" >
  <input type="hidden" name="comanda" value="login">
  <table cellpadding="0" cellspacing="2" align="center" width="168" bgcolor="#eeeeee">
    <tr>
      <td colspan="2"><b>Autentificare:</b></td>
    </tr>
    <tr>
     
      <td width="70">Nume:</td>
      <td><input type="text" name="nume" size="30"></td>
    </tr>
    <tr>
      <td width="70">Parola:</td>
      <td><input type="password" name="parola" size="30" value=""></td>
    </tr>
    <tr>  
      <td colspan="2" align="center"><input type="submit" value="Login"></td>
    </tr>
  </table>
</form>
    </body>
</html>
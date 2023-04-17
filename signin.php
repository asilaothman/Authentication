<?php

function validpw($pass1){
  if(strlen($pass1) >= 8) {
    if(!ctype_upper($pass1) && !ctype_lower($pass1)) {
      return TRUE;

    }
  }
}

$flag = FALSE;

if(isset($_POST['email'])) {
  require_once 'index.php';

  $con = mysqli_connect("localhost","root","","websec");

  $email = mysql_real_escape_string($db, $con, $_POST['email']);
  $pass1 = mysql_real_escape_string($db, $_POST['pass1']);
  $pass2 = $_POST['pass2'];

  if($pass1 == pass2) {
      $flag = TRUE;
  }

  if($flag == TRUE) {
      $sql = "CREATE TABLE IF NOT EXISTS was (
        ID integer not null primary key auto_increment,
        email varchar(128),
        pass1 varchar(256),
        tm timestamp
        )";

        $result = mysqli_query($db, $sql) or die ("Bad query; $sql");

        $salted = "jfe4hr4uf3wuf384".$pass1;

        $hashed = hash('sha512', $salted);

        $sql = "INSERT INTO was (email, pass1) VALUES ('$email', '$hashed')";
        $result = mysqli_query($db, $sql) or die("BAD SQL: $sql");
  }

}//IF isset

require 'login.html';

?>

<h1>SIGN IN</h1>

  <content>

    <form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
      <label>Email:</label> <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
      <label>Password:</label> <input type='password' name='pass1' required><br>
      <labe>Repeat Password:</label> <input type='password' name='pass2' required><br>
      <input type='submit'>
    </form>

  </content>

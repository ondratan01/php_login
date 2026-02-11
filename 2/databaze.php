
<?php
// session_start();
// echo "dostal jsem: " .$_POST ["email"]. "<br>";
// echo "dostal jsem: " .$_POST ["psw"];


// if ($_POST["email"] == "admin" && $_POST["psw"] == "admin")
// {
//     $_SESSION["email"] = $_POST["email"];
//     $_SESSION["psw"] = $_POST["psw"];

//     echo "cau";
// }


// if (isset ($_SESSION["email"]))
// {
//     $pass = $_SESSION["psw"];
//     $user = $_SESSION["email"];

//     echo "<br><br>uživatel $user a heslo $pass"; 



//     echo '
//         <form action="" method="get">
//             <input type="submit" name = "logout" value="Odhlásit se">
//         </form>
//     ';


//     echo isset($_GET["logout"]) ? "odhlásit": "neodhlásit";
//     if(isset($_GET ["logout"]))
//     {
//         session_unset();
//         session_destroy();
//         header("Location: http://localhost/php_login/2/idk.html");
//     }
// }
// else
// {
//     echo "<br><br>UŽIVATEL NENÍ AUTORIZOVANÝ";

// }







$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";
// $connection = new pdo("mysql: $Server,dbname=$db")

try {
    $conn = new PDO("mysql:host=$servername;dbname=,$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  ?>



?>
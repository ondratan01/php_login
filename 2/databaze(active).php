
<?php
// session_start();
echo "dostal jsem: " .$_POST ["email"]. "<br>";
echo "dostal jsem: " .$_POST ["psw"];
$email = $_POST ["email"];

if ($_POST["email"] == "admin" && $_POST["psw"] == "admin")
{
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["psw"] = $_POST["psw"];

    echo "jsi mr admin";
}


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






$dsn = "mysql:host=localhost;dbname=onder;charset=utf8";

$username = "admin";
$psw = "admin";
$users = "users";

// $connection = new pdo("mysql: $Server,dbname=$db")

try {
    $conn = new PDO($dsn, $username, $psw);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $sql = "SELECT Email FROM $users WHERE ID=1";

$stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      echo "uuh.. první uživatel email je: " . $row['Email'];
  } else {
      echo "Nenašel se žádný uživatel s tímto ID.";
  }

  $hashed_password = password_hash($psw, PASSWORD_DEFAULT);

// SQL dotaz pro vložení dat (ID se bude generovat automaticky)
$sql = "INSERT INTO users (Email, Password) VALUES (:email, :psw)";

// Příprava dotazu
$stmt = $conn->prepare($sql);

// Bind parametrů (prevence SQL injection)
$stmt->bindParam(':email', $email);
$stmt->bindParam(':psw', $hashed_password);

// Vykonání dotazu
$stmt->execute();

$sql = "SELECT Email FROM $users WHERE ID>1";

$stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


echo "<br><br>pridan uzivatel: " . $row['Email'];


  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

// function get($table, $id){
//   global $db;

//   $sql = "SELECT * FROM $table WHERE id = :id";
//   $stmt = $db->prepare($sql);
//   $stmt->execute(['id' => $id]);
//   return $stmt->fetch(PDO::FETCH_ASSOC);

// }
// function getAll($table){
//   global $db;

//   $sql = "SELECT * FROM $table";
//   $stmt = $db->prepare($sql);
//   $stmt->execute();

//   return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }





//echo"uuh.. prvni uzivatel email je >> ", "SELECT Email FROM $users WHERE ID=1"



  ?>




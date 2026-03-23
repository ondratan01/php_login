
<?php

if (isset($_POST['open_file'])) {
    $fileName = $_POST['file_name'];
    $filePath = 'poznamky/' . $fileName;

    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        echo $fileName;

        
        echo '
        <div>
            <h3>Upravit obsah souboru</h3>
            <form method="post" action="process.php">
                <textarea name="content">' . '</textarea>
                <input type="hidden" name="file_name" value="' . $fileName . '">
                <button type="submit" name="save">Uložit změny</button>
            </form>
        </div>
        ';


        echo '
        
        <div>
            <h3>Smazat obsah</h3>
            <form method="post" action="process.php">

            <input type="hidden" name="file_name" value="' . htmlspecialchars($fileName) . '">
            <button type="submit" name="smazatobsah">Smazat obsah</button>

            </form>


        </div>
        
        
        
        
        ';



    } else {
        echo '<p>Soubor neexistuje.</p>';
    }







}


if (isset($_POST['smazatobsah'])) {
    // načteme název souboru z hidden inputu
    $fileName = $_POST['file_name'] ?? '';
    $filePath = 'poznamky/' . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        // smažeme obsah souboru
        smazaniObsahu($filePath);
        echo '<p>Obsah souboru <strong>' . htmlspecialchars($fileName) . '</strong> byl smazán.</p>';
    } else {
        echo '<p>Soubor neexistuje nebo nebyl zadán.</p>';
    }
}

// create new file
if (isset($_POST['create_new_file'])) {
    $newFileName = $_POST['new_file_name'];
    $newFilePath = 'poznamky/' . $newFileName;

    // kontrola jestli soubor exstuje
    if (!file_exists($newFilePath)) {
        touch($newFilePath); // create new prazdny file
        echo '<p>Nový soubor byl vytvořen: ' . $newFileName . '</p>';
    } else {
        echo '<p>Soubor již existuje.</p>';
    }
}

// Funkce pro nahrání souboru
if (isset($_POST['upload_file'])) {
    $fileTmpName = $_FILES['file_upload']['tmp_name'];
    $fileName = $_FILES['file_upload']['name'];
    $uploadDir = 'poznamky/';

    // Pokud složka pro nahrání neexistuje, vytvoříme ji
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Uložení souboru
    if (move_uploaded_file($fileTmpName, $uploadDir . $fileName)) {
        echo '<p>Soubor byl úspěšně nahrán: ' . $fileName . '</p>';
    } else {
        echo '<p>Chyba při nahrávání souboru.</p>';
    }
}

// Funkce pro otevření souboru
if (isset($_POST['open_file'])) {
    $fileName = $_POST['file_name'];
    $filePath = 'poznamky/' . $fileName;

    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        echo '<p>Obsah souboru:</p>';
        echo '<pre>' . htmlspecialchars($fileContent) . '</pre>';
    } else {
        echo '<p>Soubor neexistuje.</p>';
    }
}

// Funkce pro uložení změn do souboru¨

if (isset($_POST['save'])) {
    $fileName = $_POST['file_name'];
    $content = $_POST['content'];
    $filePath = 'poznamky/' . $fileName;

    $fileName = $_POST['file_name'] ?? '';

    if (empty($fileName)) {
        echo '<p>Chyba: Nebylo zadáno jméno souboru pro uložení.</p>';
        exit;
    }
    

    // kontrola jestli poznamky existuji
    if (!file_exists('poznamky')) {
        mkdir('poznamky', 0777, true);  // udela slozku kdyz neexistuje
    }

    // kontrola jestli existuje a napisu
    if (file_exists($filePath)) {

        if (file_put_contents($filePath, $content . "\n", FILE_APPEND) !== false) {
            echo '<p>Změny byly úspěšně uloženy do souboru ' . $fileName . '</p>';
        } else {
            echo '<p>Chyba při ukládání souboru. Zkontrolujte oprávnění.</p>';
        }
    } else {
        echo '<p>Soubor neexistuje pro zápis.</p>';
    }
}


function smazaniObsahu($filePath) {
    file_put_contents($filePath, ' ');
}





// nacteni soubor
$filename = 'users.txt';
$filePath = 'db/' . $fileName;

// otevreni souboru na cteni
$lines = file($filePath); 

foreach ($lines as $line) {
    
    $user = explode(";", $line);

    
    echo "ID: " . $user[0] . "<br>";
    echo "Jméno: " . $user[1] . "<br>";
    echo "Email: " . $user[2] . "<br>";
    echo "Věk: " . $user[3] . "<br><br>";
}







?>
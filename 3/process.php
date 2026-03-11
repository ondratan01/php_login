<?php
// Funkce pro vytvoření nového souboru
if (isset($_POST['create_new_file'])) {
    $newFileName = $_POST['new_file_name'];
    $newFilePath = 'poznamky/' . $newFileName;

    // Zkontrolujeme, zda soubor již existuje
    if (!file_exists($newFilePath)) {
        touch($newFilePath); // Vytvoří nový prázdný soubor
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

// Funkce pro uložení změn do souboru
if (isset($_POST['save'])) {
    $fileName = $_POST['file_name'];
    $content = $_POST['content'];
    $filePath = 'poznamky/' . $fileName;

    // Zkontrolujeme, zda složka poznamky existuje
    if (!file_exists('poznamky')) {
        mkdir('poznamky', 0777, true);  // Vytvoří složku, pokud neexistuje
    }

    // Zkontrolujeme, zda soubor existuje, a zapisujeme do něj obsah
    if (file_exists($filePath)) {
        // Pokusíme se zapisovat do souboru
        if (file_put_contents($filePath, $content) !== false) {
            echo '<p>Změny byly úspěšně uloženy do souboru ' . $fileName . '</p>';
        } else {
            echo '<p>Chyba při ukládání souboru. Zkontrolujte oprávnění.</p>';
        }
    } else {
        echo '<p>Soubor neexistuje pro zápis.</p>';
    }
}
?>
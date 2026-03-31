<?php
$message = trim($_POST['message'] ?? '');
if ($message !== '') {
    //ulozeni zpravy do souboru
    file_put_contents('chat.txt', htmlspecialchars($message) . "\n", FILE_APPEND);
}
?>
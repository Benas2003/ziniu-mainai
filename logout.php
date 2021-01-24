<?php
    session_start();
    if(session_destroy())
    {
        header("Location: Prisijungimas.php?logout=success");
    }
?>


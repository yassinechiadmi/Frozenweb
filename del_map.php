<?php
    session_start();
    $map_id = $_GET["map_id"];
    require("backend/interactDB.php");
    delete_map($map_id);
    header("Location:upload.php");
?>
<?php
    include("connection.php");
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = "update appointments set status = 0 where id = $id";
        $conn->query($query);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<?php require("include/head.php"); ?>

<body>
    <?php require("include/nav.php"); ?>

    <div id="case">
        <form method="post" action="" class="logform">

            <h1> Upload a map </h1>
            <input type="text" name="map" placeholder="Map data">
            <input type="text" name="map_name" placeholder="Map name">
            <input type="submit" name="upload" value="Upload map">

        </form>
    </div>

    <?php require("include/foot.php") ?>
</body>

</html>

<?php
if (isset($_POST["upload"])) {
    require("backend/interactDB.php");
    $map = $_POST["map"];
    $map_name = $_POST["map_name"];
    $ret = upload_map($map, $map_name);
    $uid = get_uid();
    if (!$ret) echo "$ret, $uid";
}
?>
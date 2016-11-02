<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Events</title>
</head>
<body>
<h2>Events</h2>
<?php
include "fb_event_download_core.php";
    
if(isset($_POST["pages"])){
    $pages = $_POST["pages"];
    $categories =  $_POST["category"];
    get_events($pages, $categories);
}
else{
    echo "error for page categories or pages";
}
     
?>
</body>
</html>
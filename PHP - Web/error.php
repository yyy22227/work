<?php

require('function.php');

if (isset($_SESSION['message'])) {
    /*?>

    <h1><? echo $_SESSION['message']; ?></h1>
    <?php*/
    echo $_SESSION['message'];
}
else{echo "string";}
?>

<input type ="button" onclick="history.back()" value="回到上一頁"></input>
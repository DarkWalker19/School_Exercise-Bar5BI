<?php
    function error($params = ""){
        header("Location: error.php?err=" . $params);
        exit();
    }
?>
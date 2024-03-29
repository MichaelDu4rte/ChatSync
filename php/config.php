<?php
    $connect = pg_connect("host=localhost dbname=chat user=postgres password=admin");

    if($connect) {
        echo '';
    } else echo 'none';
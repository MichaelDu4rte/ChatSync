<?php


session_start();
include_once('config.php');
$sql = pg_query($connect, "SELECT * FROM users");
$output = "";

if(pg_num_rows($sql) == 1) {
    $output .= "Sem usarios no chat";
} else if (pg_num_rows($sql) > 0) {
    while($row = pg_fetch_assoc($sql)) {
        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] . '" alt="">

                    <div class="details">
                        <span>'. $row['fname'] . " " . $row['lname'] .'</span>
                        
                    </div>
                    </div>

                    
                    </a>';
    }

    echo $output;
} 
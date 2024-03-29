<?php 



session_start();


if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = isset($_POST['incoming_id']) ? $_POST['incoming_id'] : ''; 
    $output = "";
    
    
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = $1 AND incoming_msg_id = $2)
            OR (outgoing_msg_id = $2 AND incoming_msg_id = $1) ORDER BY msg_id";
    
    $stmt = pg_prepare($connect, "", $sql);
    
    if ($stmt) {
        $result = pg_execute($connect, "", array($outgoing_id, $incoming_id));
        
        if ($result) {
            if(pg_num_rows($result) > 0){
                while($row = pg_fetch_assoc($result)){
                    $msg = htmlspecialchars($row['msg']); 
                    if($row['outgoing_msg_id'] === $outgoing_id){
                        $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $msg .'</p>
                                    </div>
                                    </div>';
                    }else{
                        $output .= '<div class="chat incoming">
                                    <img src="php/images/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <p>'. $msg .'</p>
                                    </div>
                                    </div>';
                    }
                }
            }else{
                $output .= '<div class="text">Parece que você não tem mensagens com essa pessoa. Vamos começar?</div>';
            }
        } else {
           
            echo "Erro ao executar a consulta.";
        }
    } else {
        
        echo "Erro ao preparar a consulta.";
    }
    echo $output;

    
}else{
    header("location: ../login.php");
}
?>
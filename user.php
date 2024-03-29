<?php 
    session_start();

    if(!isset($_SESSION['unique_id'])) {
        header("location: login.php");
    }

    include_once("header.php");

?>

<body>
    <div class="wrapper">


        <section class="users">
            <header>

                <?php
                include_once("php/config.php");
                $sql = pg_query($connect, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']} ");

                if(pg_num_rows($sql) > 0) {
                    $row = pg_fetch_assoc($sql);
                }
            ?>

                <div class="content">
                    <img src="php/images/<?php echo $row['img']?> " alt="">

                    <div class="details">
                        <span><?php echo $row['fname']. "" .  $row['lname']?></span>
                        <p>Online</p>
                    </div>
                </div>
                <a href="login.php" class="logout">Sair</a>
            </header>
            <div class="search">
                <span class="text">Contatos Globais | Iniciar conversa</span>



                <input type="text" placeholder="Enter name">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="users-list">

            </div>
        </section>

    </div>

    <script src="js/user.js"></script>
</body>

</html>
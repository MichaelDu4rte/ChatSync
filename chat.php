<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>

<body>

    <div class="wrapper">



        <section class="chat-area">
            <header>
                <?php 
          $user_id = pg_escape_string($connect, $_GET['user_id']);
          $sql = pg_query($connect, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(pg_num_rows($sql) > 0){
            $row = pg_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
                <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>

                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="js/chat.js"></script>

</body>

</html>
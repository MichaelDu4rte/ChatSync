<?php include_once("header.php");?>

<body>
    <div class="wrapper login">
        <section class="form login">
            <header>Chat<span class="blue">Sync</span> | Login</header>

            <form action="#" autocomplete="off">
                <div class="error-text"></div>



                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Seu email">
                </div>

                <div class="field input">
                    <label for="">Senha</label>
                    <input type="password" placeholder="Sua senha" class="password" name="password">
                    <i class="fas fa-eye"></i>
                </div>


                <div class="field btn">
                    <input type="submit" value="Entrar">
                </div>

            </form>
            <div class="link">Nao tem conta? <a href="register.php">Registrar</a></div>
            <div class="link"><a href="index.php">Home</a></div>
        </section>
    </div>

    <script src="js/main.js"></script>
    <script src="js/login.js"></script>
</body>

</html>
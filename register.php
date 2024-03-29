<?php include_once("header.php");?>

<body>
    <div class="wrapper login">
        <section class="form singup">
            <header>Chat<span class="blue">Sync</span> | Nova conta</header>

            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>

                <div class="name-details">
                    <div class="field input">
                        <label for="">Fiist name</label>
                        <input type="text" placeholder="Seu nome" name="fname">
                    </div>

                    <div class="field input">
                        <label for="">Last name</label>
                        <input type="text" placeholder="Seu ultimo nome" name="lname">
                    </div>
                </div>

                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" placeholder="Seu email" name="email">
                </div>

                <div class="field input">
                    <label for="">Senha</label>
                    <input type="password" placeholder="Sua senha" class="password" name="password">
                    <i class="fas fa-eye"></i>
                </div>

                <div class="field image">
                    <label for="">Foto de perfil</label>
                    <input type="file" name="image">
                </div>

                <div class="field btn">
                    <input type="submit" value="Registrar">
                </div>

            </form>
            <div class="link">Ja tem conta? <a href="login.php">Entrar</a></div>
            <div class="link"><a href="index.php">Home</a></div>

        </section>
    </div>

    <script src="js/main.js"></script>
    <script src="js/signup.js"></script>


</body>

</html>
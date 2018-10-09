<?php
// inclui as definições gerais e inicia a sessão
include_once("api/definitions.php");

if(isset($_SESSION['username'])) {
    header("Location: " . DEFAULT_LOGGED_HOME);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login ou Cadastro - Minha rede social</title>
    </head>
    <body>
        <?php
        if(isset($_GET['msg'])) {
        ?>
        <fieldset>
            <?php echo $_GET['msg']; ?>
        </fieldset>
        <?php } ?>

        <h1>Bem vindo à minha rede social!</h1>
        <p>Entre ou cadastre-se para continuar.</p>

        <h2>Login</h2>
        <form action="api?login" method="post">
            <fieldset>
                <label>
                    Nome de usuário:<br/>
                    <input type="text" name="username" placeholder="usuário"/>
                </label><br/>
                <label>
                    Senha:<br/>
                    <input type="password" name="password" placeholder="senha"/>
                </label><br/><br/>
                <input type="submit" value="Entrar!"/>
            </fieldset>
        </form>

        <h2>Cadastro</h2>
        <form action="api?register" method="post">
            <fieldset>
                <label>
                    Nome de usuário:<br/>
                    <input type="text" name="username" placeholder="usuário"/>
                </label><br/>
                <label>
                    Senha:<br/>
                    <input type="password" name="password" placeholder="senha"/>
                </label><br/>
                <label>
                    Senha novamente:<br/>
                    <input type="password" name="password_again" placeholder="senha"/>
                </label><br/><br/>
                <input type="submit" value="Cadastrar e entrar!"/>
            </fieldset>
        </form>
    </body>
</html>

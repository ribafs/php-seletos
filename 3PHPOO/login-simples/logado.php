<?php

session_start();

/**/
require_once "classes/Conexao.php";
require_once "classes/Login.php";

if(isset($_GET['logout'])):
    if($_GET['logout']== 'ok'):
       Login::deslogar();
    endif;
endif;

if(isset($_SESSION['logado'])):
    ?>

    <!--informo o campo que utilizarei para mostra quem se encontra logado-->
    BEM VINDO <?php echo $_SESSION['usuario'];?>

    <br />
    <a href="logado.php?logout=ok">Sair do Sistema</a>

<?php

    else:
        echo "Você não esta logado ou Não tem acesso tente novamente";?>
        <a href="index.php">Inicio</a>
        <?php
endif;


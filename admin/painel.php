<?php
ob_start();
session_start();
require('../_app/config.inc.php');

$login = new Login(3);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Admin - Tarja Consultoria</title>
        <!--[if lt IE 9]>
            <script src="../_cdn/html5.js"></script> 
         <![endif]-->

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?=INCLUDE_PATH;?>/css/reset.css" />
        <link rel="stylesheet" href="css/admin.css" />   
    </head>

    <body class="painel">

        <header id="navadmin">
            <div class="content">

                <h1 class="logomarca">Tarja Consultoria em TI e Marketing Digital</h1>

                <ul class="systema_nav radius">
                    <li class="username"><?= $userlogin['user_name']; ?> <?= $userlogin['user_lastname']; ?></li>
                    <li><a class="icon profile radius" href="painel.php?exe=users/profile">Perfíl</a></li>
                    <li><a class="icon users radius" href="painel.php?exe=users/users">Usuários</a></li>
                    <li><a class="icon logout radius" href="painel.php?logoff=true">Sair</a></li>
                </ul>

                <nav>
                    <h1><a href="painel.php" title="Painel de Controle"><img alt="Painel de Controle" title="Painel de Controle" src="<?= HOME;?>/admin/images/home.png" style="img_home"/></a></h1>

                    <?php
                    //ATIVA MENU
                    if (isset($getexe)):
                        $linkto = explode('/', $getexe);
                    else:
                        $linkto = array();
                    endif;
                    ?>

                    <ul class="menu">
                        <li class="li<?php if (in_array('posts', $linkto)) echo ' active'; ?>"><a class="opensub" href="painel.php?exe=posts/index">Posts</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=posts/create">Criar Post</a></li>
                                <li><a href="painel.php?exe=categories/create">Cadastrar Categoria</a></li>
                                <li><a href="painel.php?exe=categories/index">Listar Categorias</a></li>
                            </ul>
                        </li>

                        <li class="li<?php if (in_array('cursos', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Cursos</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=cursos/create">Cadastrar curso</a></li>
                                <li><a href="painel.php?exe=categories/index">Listar cursos</a></li>
                            </ul>
                        </li> 
                        
                        <li class="li<?php if (in_array('servicos', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Serviços</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=servicos/create">Criar Serviços</a></li>
                                <li><a href="painel.php?exe=servicos/index">Listar Serviços</a></li>
                            </ul>
                        </li> 
                        <li class="li<?php if (in_array('portifolio', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Portifolio</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=portifolio/create">Criar portifolio</a></li>
                                <li><a href="painel.php?exe=portifolio/index">Listar portifolio</a></li>
                            </ul>
                        </li>
                      <li class="li<?php if (in_array('projetos', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Projetos</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=projetos/create">Criar projetos</a></li>
                                <li><a href="painel.php?exe=projetos/index">Listar projetos</a></li>
                            </ul>
                        </li>
                        <li class="li<?php if (in_array('empresas', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Empresas</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=empresas/create">Cadastrar Empresa</a></li>
                                <li><a href="painel.php?exe=empresas/index">Listar / Editar Empresas</a></li>
                            </ul>
                        </li>
                      <li class="li<?php if (in_array('aempresa', $linkto)) echo ' active'; ?>"><a class="opensub" href="painel.php?exe=aempresa">A empresa</a>
                            
                        </li>
                        
                    </ul>
                </nav>

                <div class="clear"></div>
            </div><!--/CONTENT-->
        </header>

        <div id="painel">
            <?php
          
            //QUERY STRING
            if (!empty($getexe)):
                $includepatch = __DIR__ . '/system/' . strip_tags(trim($getexe) . '.php');
            else:
                $includepatch = __DIR__ . '/system/home.php';
            endif;
          

            if (file_exists($includepatch)):
                require_once($includepatch);
            else:
                echo "<div class=\"content notfound\">";
                WSErro("<b>Erro ao incluir tela:</b> /{$getexe}.php!", WS_ERROR);
                echo "</div>";
            endif;
            ?>
        </div> <!-- painel -->

        <footer class="main_footer">
            <a href="https://www.mi-agenciaweb.com" target="_blank" title="MI Agencia web">MI AGÊNCIA WEB - Richard de Deus - Todos os Direitos Reservados</a>
        </footer>

    </body>

    <script src="../_cdn/jquery.js"></script>
    <script src="../_cdn/jmask.js"></script>
    <script src="../_cdn/combo.js"></script>
    <script src="__jsc/tiny_mce/tiny_mce.js"></script>
    <script src="__jsc/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
    <script src="__jsc/admin.js"></script>

</html>
<?php
ob_end_flush();
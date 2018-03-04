<?php
ob_start();
require('./_app/config.inc.php');
//$Session = new Session;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!--[if lt IE 9]>
            <script src="../../_cdn/html5.js"></script>
         <![endif]-->  
        <?php
        $Link = new Link;
        $Link->getTags();
        ?>
        <!-- CORE CSS -->
		    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/plugins/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/reset.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css">
        <link rel="stylesheet" href="<?= HOME; ?>/_cdn/shadowbox/shadowbox.css">
      
        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href='https://fonts.googleapis.com/css?family=Baumans%7COpen+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700' rel='stylesheet' type='text/css'>
        
        
		


    </head>
    <body>

        <?php
        require(REQUIRE_PATH . '/inc/header.inc.php');

          if (!require($Link->getPatch())):
            WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
          endif;

        require(REQUIRE_PATH . '/inc/footer.inc.php');
        ?>

    </body>

    <script src="<?= HOME ?>/_cdn/jquery.js"></script>
    <script src="<?= HOME ?>/_cdn/jcycle.js"></script>
    <script src="<?= HOME ?>/_cdn/jmask.js"></script>
    <script src="<?= HOME ?>/_cdn/shadowbox/shadowbox.js"></script>
    <script src="<?= HOME ?>/_cdn/_plugins.conf.js"></script>
    <script src="<?= HOME ?>/_cdn/_scripts.conf.js"></script>
		<script src="<?= HOME ?>/_cdn/combo.js"></script>
</html>
<?php
ob_end_flush();
?>
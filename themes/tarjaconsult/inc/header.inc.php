<header class="main-header">
  <div class="container">
  <hgroup>
      <h1>Tarja Consultoria em TI e Marketing Digital - Manutenção de Computadores, Aulas Particulares, Desenvolvimento de sites e Marketing Digital</h1>
      <h2>Descomplicando e servindo a Informática para você</h2>
  </hgroup>

  <div class="header-banner">
    <a class="" href="https://www.superdominios.org/home/aff.php?aff=1170" title="<?= SITENAME;?>" target="_blank">
      <img src="<?= INCLUDE_PATH; ?>/images/hospedagem.png" alt="banner" width="468" height="60"  alt="Hospedagem de site ilimitada" />
    </a>
  </div><!-- banner -->

        <nav class="main-nav">

            <ul class="top">
                <li><a href="<?= HOME ?>" title="">Pág Inicial</a></li>
                <li><a href="<?= HOME ?>/sobre" title="">Sobre</a>
                    <ul class="sub">
                        <li><a href="<?= HOME ?>/sobre/historico" title="">Histórico</a></li> 
                        <li><a href="<?= HOME ?>/sobre/formacao" title="">Formação</a></li> 
                        <li><a href="<?= HOME ?>/sobre/cursos" title="">Cursos</a></li> 
                    </ul>                
                </li>
                <li><a href="<?= HOME ?>/servicos" title="">Serviços</a></li>
                <li><a href="<?= HOME ?>/portifolio" title="">Portifolio</a></li>
                <li><a href="<?= HOME ?>/projetos" title="">Projetos</a></li>
                <li><a href="<?= HOME ?>/blog" title="">Blog</a></li>
                <li><a href="<?= HOME ?>/contato" title="">Contato</a></li>
                

                <li class="search">
                    <?php
                    $search = filter_input(INPUT_POST, 's', FILTER_DEFAULT);
                    if (!empty($search)):
                        $search = strip_tags(trim(urlencode($search)));
                        header('Location: ' . HOME . '/pesquisa/' . $search);
                    endif;
                    ?>

                    <form name="search" action="" method="post">
                        <input class="fls" type="text" name="s" />
                        <input class="btn" type="submit" name="sendsearch" value="" />
                    </form>
                </li>

            </ul>

            </ul>
        </nav> <!-- main nav -->
        
    </div><!-- Container Header -->
</header> <!-- main header -->
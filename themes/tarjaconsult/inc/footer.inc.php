<footer class="main-footer" id="contato">
    <section class="container">                
        <section>
            <h3 class="line_title"><span>Nosso Ideal:</span></h3>
            <p>Somos compromissados com o atendimento ao nossos clientes, buscando as melhores soluções em informática.</p>
            <p>Este site resume nossa experiência e conhecimentos acumulados nesses 30 anos de atividade.</p>
            <p>Estamos a sua disposição.</a></p>
        </section>
        
        <nav>
            <h3 class="line_title"><span>Links Diversos</span></h3>
            <ul>
                <li><a href="#" title="" target="_blank">Upinside</a></li>
                <li><a href="#" title="" target="_blank"></a></li>
                <li><a href="#" title="" target="_blank"></a></li>
                <li><a href="<?= HOME ?>" title="Home">Voltar a Página Inicial</a></li>
            </ul>
        </nav>

        <section class="footer_contact">
            <h3 class="line_title"><span>Contato Rápido:</span></h3>
          <?php
            $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if($Contato && $Contato['SendFormContato']):
              unset($Contato['SendFormContato']);
              $Contato['Assunto'] = "Mensagem via site Tarjaconsult.com";
              $Contato['DestinoNome'] = "Richard de Deus - Tarja Consultoria";
              $Contato['DestinoEmail'] = "atendimento@tarjaconsult.com";
              $SendMail = new Email;
              $SendMail->Enviar($Contato);
                
              if($SendMail->getError()):
                  WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
              endif;

             
              
            endif;
            ?>
            <form name="FormContato" action="#contato" method="post">
                <label>
                    <span>nome:</span>
                    <input type="text" title="Informe seu nome" name="RemetenteNome" required />
                </label>

                <label>
                    <span>e-mail:</span>
                    <input type="email" title="Informe seu e-mail" name="RemetenteEmail" required />
                </label>

                <label>
                    <span>mensagem:</span>
                    <textarea title="Envie sua mensagem" name="Mensagem" required rows="3"></textarea>
                </label>

                <input type="submit" value="Enviar" name="SendFormContato" class="btn">                        
            </form>
        </section>
        <div class="clear"></div>
    </section><!-- /ontainer -->

    <div class="footer_logo">Tarja Consultoria em TI e Marketing Digital</div><!-- footer logo -->
</footer>
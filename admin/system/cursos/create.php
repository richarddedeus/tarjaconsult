<div class="content form_create">

    <article>

        <header>
            <h1>Cadastrar Curso:</h1>
        </header>

        <?php
        $Curso = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($curso) && $curso['SendCursoForm']):
            //$curso['cursos_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
            $curso['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null );
            unset($post['SendPostForm']);

            require('_models/AdminPost.class.php');
            $cadastra = new AdminPost;
            $cadastra->ExeCreate($post);

            if ($cadastra->getResult()):

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;

                header('Location: painel.php?exe=posts/update&create=true&postid=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>


        <form name="CursoForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="cursos_capa" />
            </label>
          <div class="label_line">
            <label class="label_small">
                <span class="field">Curso:</span>
                <input type="text" name="cursos_nome" value="<?php if (isset($curso['cursos_nome'])) echo $curso['cursos_nome']; ?>" />
            </label>
            <label class="label_small">
                  <span class="field">Abreviação:</span>
                  <input type="text" name="cursos_abrv" value="<?php if (isset($curso['cursos_abrv'])) echo $curso['cursos_abrv']; ?>" />
              </label>
            <label class="label_small">
                  <span class="field">Área:</span>
                  <input type="text" name="cursos_area" value="<?php if (isset($curso['cursos_area'])) echo $curso['cursos_area']; ?>" />
              </label>
          </div>
          <label class="label">
                <span class="field">Escola:</span>
                <input type="text" name="cursos_escola" value="<?php if (isset($curso['cursos_escola'])) echo $curso['cursos_escola']; ?>" />
            </label>
          <label class="label">
                <span class="field">professor:</span>
                <input type="text" name="cursos_professor" value="<?php if (isset($curso['cursos_professor'])) echo $curso['cursos_professor']; ?>" />
            </label>
          <div class="label_line">
          <label class="label_small">
                <span class="field">Duração:</span>
                <input type="text" name="cursos_duracao" value="<?php if (isset($curso['cursos_duracao'])) echo $curso['cursos_duracao']; ?>" />
            </label>
             <label class="label_small" style="width:65%;">
                <span class="field">Link Projeto Final:</span>
                <input type="text" name="cursos_projeto_final" style="width:95%" value="<?php if (isset($curso['cursos_projeto_final'])) echo $curso['cursos_projeto_final']; ?>" />
            </label>
          </div>
            <label class="label">
                <span class="field">Matéria:</span>
                <textarea class="js_editor" name="cursos_materia" rows="10"><?php if (isset($curso['cursos_materia'])) echo htmlspecialchars($curso['cursos_materia']); ?></textarea>
            </label>
<div class="label_line">
          <label class="label_small">
                <span class="field">Certificado:</span>
                <input type="file" name="cursos_certificado" />
            </label>
             <label class="label_small" style="width:65%;">
                <span class="field">Link curso:</span>
                <input type="text" name="cursos_link" style="width:95%" value="<?php if (isset($curso['cursos_link'])) echo $curso['cursos_link']; ?>" />
            </label>
          </div>
            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data Matrícula:</span>
                    <input type="text" class="formDate center" name="cursos_data_matr" value="<?php
                    if (isset($curso['cursos_data_matr'])): echo $curso['cursos_data_matr'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>
              <label class="label_small">
                    <span class="field">Data Início:</span>
                    <input type="text" class="formDate center" name="cursos_data_inicio" value="<?php
                    if (isset($curso['cursos_data_inicio'])): echo $curso['cursos_data_inicio'];
                    else: echo "";
                    endif;
                    ?>" />
                </label>
              <label class="label_small">
                    <span class="field">Data Final:</span>
                    <input type="text" class="formDate center" name="cursos_data_final" value="<?php
                    if (isset($curso['cursos_data_final'])): echo $curso['cursos_data_final'];
                    else: echo "";
                    endif;
                    ?>" />
                </label>
           
            </div><!--/line-->

            
            <input type="submit" class="btn blue" value="Cadastrar" name="SendCursoForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendCursoForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
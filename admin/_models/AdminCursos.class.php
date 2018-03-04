<?php

/**
 * AdminCursos.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os cursos no Admin do sistema!
 * 
 * @copyright (c) 2017, Richard de Deus MI Agência WEB
 */
class AdminPost {

    private $Data;
    private $Curso;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'ws_cursos';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para cadastrar um curso, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['cursos_capa']):
                $upload = new Upload;
                $upload->Image($this->Data['cursos_capa'], $this->Data['cursos_nome']);
            endif;
            if ($this->Data['cursos_certificado']):
                $upload2 = new Upload;
                $upload2->Image($this->Data['cursos_certificado'], $this->Data['cursos_nome']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['cursos_capa'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['cursos_capa'] = null;
                $_SESSION['errCapa'] = "<b>ERRO AO ENVIAR CAPA:</b> Tipo de arquivo inválido, arquivos permitidos: JPG,PNG, GIF OU BMP.";
                $this->Create();
            endif;
            if (isset($upload2) && $upload2->getResult()):
                $this->Data['cursos_certificado'] = $upload2->getResult();
                $this->Create();
            else:
                $this->Data['cursos_certificado'] = null;
                $_SESSION['errCert'] = "<b>ERRO AO ENVIAR Certificado:</b> Tipo de arquivo inválido, arquivos permitidos: JPG,PNG, GIF OU BMP.";
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Curso:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * curso para atualiza-lo na tabela!
     * @param INT $CursoId = Id do post
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($CursoId, array $Data) {
        $this->Curso = (int) $CursoId;
        $this->Data = $Data;
        $this->setData();
        $this->setName();

            if (is_array($this->Data['cursos_capa'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE cursos_id = :curso", "curso={$this->Curso}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['cursos_capa'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['cursos_capa'], $this->Data['cursos_nome']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['cursos_capa'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['cursos_capa']);
                WSErro("<b>ERRO AO ENVIAR CAPA:</b> ".$uploadCapa->getError(), E_USER_WARNING);
                $this->Update();
            endif;
      
      if (is_array($this->Data['cursos_certificado'])):
                $readCertificado = new Read;
                $readCertificado->ExeRead(self::Entity, "WHERE cursos_id = :curso", "curso={$this->Curso}");
                $certificado = '../uploads/' . $readCertificado->getResult()[0]['cursos_certificado'];
                if (file_exists($certificado) && !is_dir($certificado)):
                    unlink($certificado);
                endif;

                $uploadCertificado = new Upload;
                $uploadCertificado->Image($this->Data['cursos_certificado'], $this->Data['cursos_nome']);
            endif;

            if (isset($uploadCertificado) && $uploadCertificado->getResult()):
                $this->Data['cursos_certificado'] = $uploadCertificado->getResult();
                $this->Update();
            else:
                unset($this->Data['cursos_certificado']);
                WSErro("<b>ERRO AO ENVIAR CERTIFICADO:</b> ".$uploadCertificado->getError(), E_USER_WARNING);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Curso:</b> Informe o ID do curso a ser removido para que esse método realize uma checagem de
     * pastas excluindo todos os dados necessários!
     * @param INT $CursoId = Id do curso
     */
    public function ExeDelete($CursoId) {
        $this->Curso = (int) $CursoId;

        $ReadCurso = new Read;
        $ReadCurso->ExeRead(self::Entity, "WHERE cursos_id = :curso", "curso={$this->Curso}");

        if (!$ReadCurso->getResult()):
            $this->Error = ["O curso que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $CursoDelete = $ReadCurso->getResult()[0];
            if (file_exists('../uploads/' . $CursoDelete['cursos_capa']) && !is_dir('../uploads/' . $CursoDelete['cursos_capa'])):
                unlink('../uploads/' . $PostDelete['cursos_capa']);
            endif;
            if (file_exists('../uploads/' . $CursoDelete['cursos_certificado']) && !is_dir('../uploads/' . $CursoDelete['cursos_certificado'])):
                unlink('../uploads/' . $PostDelete['cursos_capa']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE cursos_id = :cursoid", "cursoid={$this->Curso}");

            $this->Error = ["O curso <b>{$PostDelete['cursos_nome']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

   
    /**
     * <b>Verificar Cadastro:</b> Retorna ID do registro se o cadastro for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = InsertID or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com uma mensagem e o tipo de erro.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Valida e cria os dados para realizar o cadastro
    private function setData() {
        $Capa = $this->Data['cursos_capa'];
        $Materia = $this->Data['cursos_materia'];
        $Materia = $this->Data['cursos_materia'];
        unset($this->Data['cursos_capa'], $this->Data['cursos_materia']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['cursos_nome'] = Check::Name($this->Data['cursos_nome']);
        $this->Data['cursos_abrv'] = Check::Name($this->Data['cursos_abrv']);
      //adicionar mais campo
        $this->Data['cursos_data_matr'] = Check::Data($this->Data['cursos_data_matr']);
        
        $this->Data['cursos_capa'] = $Capa;
        $this->Data['cursos_materia'] = $Materia;
        
    }

    //Obtem o ID da categoria PAI
    private function getCatParent() {
        $rCat = new Read;
        $rCat->ExeRead("ws_categories", "WHERE category_id = :id", "id={$this->Data['post_category']}");
        if ($rCat->getResult()):
            return $rCat->getResult()[0]['category_parent'];
        else:
            return null;
        endif;
    }

    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "post_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} post_title = :t", "t={$this->Data['post_title']}");
        if ($readName->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O post {$this->Data['post_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE post_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O post <b>{$this->Data['post_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

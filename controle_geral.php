<?php
if($sis->url(1)=='sair'){
    if(isset($_SESSION['EMPRESA'])){
        unset($_SESSION['EMPRESA']);
        unset($_SESSION['EMPRESA_NOME_FANTASIA']);
    }
    header('Location:'.$sis->url_base());
}

if(isset($_GET['seleciona_empresa'])){
    $id_empresa = (int)$_GET['seleciona_empresa'];
    $getEmpresa = $sis->select("SELECT e.*, c.* FROM empresa e INNER JOIN cidade c ON c.EMPRESA=e.EMPRESA AND c.CIDADE=e.CIDADE WHERE e.EMPRESA='$id_empresa'");
    if(count($getEmpresa)>0){
        $empresa = $getEmpresa[0];
        $_SESSION['EMPRESA'] = $id_empresa;
        $_SESSION['EMPRESA_NOME_FANTASIA'] = $empresa->NOME_FANTASIA;
        header('Location:'.$sis->url_base('empresa'));
    }else{
        header('Location:' . $sis->url_base('empresas').'?erro=Empresa Não Encontrada.');
    }
}

if(isset($_POST['acao']) && $_POST['acao']=='delete_produto'){
    $PRODUTO = $_POST['PRODUTO'];
    $EMPRESA = $_SESSION['EMPRESA'];
    $delete = $sis->updateDelete("DELETE FROM produto WHERE EMPRESA='$EMPRESA' AND PRODUTO='$PRODUTO'");
    if($delete){
        header('Location:'.$sis->url_base('produtos').'?sucesso=Produto Excluído com sucesso.');
    }else{
        $erro = "Falha ao Excluir este produto.";
    }
}

if(isset($_POST['EMPRESA']) && isset($_POST['PRODUTO'])){
    $EMPRESA                = (int)$_POST['EMPRESA'];
    $PRODUTO                = (int)$_POST['PRODUTO'];
    $APELIDO_PRODUTO        = addslashes($_POST['APELIDO_PRODUTO']);
    $DESCRICAO_PRODUTO      = addslashes($_POST['DESCRICAO_PRODUTO']);
    $GRUPO_PRODUTO          = (int)$_POST['GRUPO_PRODUTO'];
    $SUBGRUPO_PRODUTO       = (int)$_POST['SUBGRUPO_PRODUTO'];
    $SITUACAO               = addslashes($_POST['SITUACAO']);
    $PESO_LIQUIDO           = addslashes($_POST['PESO_LIQUIDO']);
    $CLASSIFICACAO_FISCAL   = addslashes($_POST['CLASSIFICACAO_FISCAL']);
    $CODIGO_BARRAS          = addslashes($_POST['CODIGO_BARRAS']);
    $COLECAO                = addslashes($_POST['COLECAO']);
    
    $erro = "";
    foreach($_POST as $chave=>$valor){
        if($_POST[$chave] == ""){
            $erro .= "O Campo ".$chave." é obrigatório.<br>";
        }
    }
    
    
    if(empty($erro)){
        if($_POST['ACAO']=='cadastrar'){
            $campos = [
                "EMPRESA"=> $EMPRESA,
                "PRODUTO"=> $PRODUTO,
                "DESCRICAO_PRODUTO"=> $DESCRICAO_PRODUTO,
                "APELIDO_PRODUTO"=> $APELIDO_PRODUTO,
                "GRUPO_PRODUTO"=> $GRUPO_PRODUTO,
                "SUBGRUPO_PRODUTO"=> $SUBGRUPO_PRODUTO,
                "SITUACAO"=> $SITUACAO,
                "PESO_LIQUIDO"=> $PESO_LIQUIDO,
                "CLASSIFICACAO_FISCAL"=> $CLASSIFICACAO_FISCAL,
                "CODIGO_BARRAS"=> $CODIGO_BARRAS,
                "COLECAO"=> $COLECAO
            ];
            $check_prod = $sis->select("select * from produto WHERE EMPRESA=$EMPRESA AND PRODUTO='$PRODUTO'");
            if(count($check_prod)==0){
                $insert = $sis->insert("produto", $campos);
                if($insert){
                    $sucesso = 'Produto cadastrado com sucesso.';
                    unset($_POST);
                }else{
                    $erro = 'Produto não cadastrado. Tente novamente em instantes.';
                }
            }else{
                $erro = 'Este Código de Produto já existe, tente outro.';
            }
        }elseif($_POST['ACAO']=='editar'){
            $campos = "
                EMPRESA = '$EMPRESA',
                PRODUTO = '$PRODUTO',
                DESCRICAO_PRODUTO = '$DESCRICAO_PRODUTO',
                APELIDO_PRODUTO = '$APELIDO_PRODUTO',
                GRUPO_PRODUTO = '$GRUPO_PRODUTO',
                SUBGRUPO_PRODUTO = '$SUBGRUPO_PRODUTO',
                SITUACAO = '$SITUACAO',
                PESO_LIQUIDO = '$PESO_LIQUIDO',
                CLASSIFICACAO_FISCAL = '$CLASSIFICACAO_FISCAL',
                CODIGO_BARRAS = '$CODIGO_BARRAS',
                COLECAO = '$COLECAO'
            ";
            $update = $sis->updateDelete("UPDATE produto SET $campos WHERE EMPRESA=$EMPRESA AND PRODUTO=$PRODUTO");
            if($update){
                $sucesso = 'Produto Atualizado com sucesso.';
            }else{
                $erro = 'Falha ao atualizar o produto, tente novamente em instantes.';
            }
        }
    }
}
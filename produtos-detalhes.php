<?php
if (!isset($_SESSION['EMPRESA'])) {
    header('Location:' . $sis->url_base().'?erro=Selecione uma empresa.');
}

$id_empresa = (int)$_SESSION['EMPRESA'];
$PRODUTO = $sis->url(2);
$getProduto = $sis->select("SELECT p.*, g.*, c.* FROM produto p"
        . " INNER JOIN grupo_produto g ON g.GRUPO_PRODUTO=p.GRUPO_PRODUTO AND g.EMPRESA=p.EMPRESA"
        . " INNER JOIN tipo_complemento c ON c.EMPRESA=p.EMPRESA AND c.TIPO_COMPLEMENTO=g.TIPO_COMPLEMENTO"
        . " WHERE p.EMPRESA='$id_empresa' AND p.PRODUTO='$PRODUTO'");
if(count($getProduto)>0){
    $produto = $getProduto[0];
}else{
    header('Location:' . $sis->url_base('produtos').'?erro=Produto Não Encontrado.');
}
?>
<?php include'inc/head.php';?>
<div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('')?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('empresa')?>"><?php echo $_SESSION['EMPRESA_NOME_FANTASIA']?></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('produtos')?>">Produtos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $produto->DESCRICAO_PRODUTO?></li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <h2>Produto: <?php echo $produto->PRODUTO?> | Apelido: <?php echo $produto->APELIDO_PRODUTO?></h2>
        </div>
        <div class="col-lg-12">
            <p><b>Descrição:</b> <?php echo $produto->DESCRICAO_PRODUTO?></p>
        </div>
        <div class="col-lg-6 col-md-6 col-md-12 col-xs-12">
            <p><b>Grupo:</b> <?php echo $produto->GRUPO_PRODUTO?> - <?php echo $produto->DESCRICAO_GRUPO_PRODUTO?>
            <br><b>Subgrupo:</b> <?php echo $produto->SUBGRUPO_PRODUTO?>
            <br><b>Situação:</b> <?php if($produto->SITUACAO=='A'){echo "ATIVO";}elseif($produto->SITUACAO=='I'){echo "INATIVO";}?>
            <br><b>Peso:</b> <?php echo $produto->PESO_LIQUIDO?></p>
        </div>
        <div class="col-lg-6 col-md-6 col-md-12 col-xs-12">
            <p><b>Classificação Fiscal:</b> <?php echo $produto->CLASSIFICACAO_FISCAL?>
            <br><b>Código de Barras:</b> <?php echo $produto->CODIGO_BARRAS?>
            <br><b>Coleção:</b> <?php echo $produto->COLECAO?>
            <br><b>Tipo Complemento:</b> <?php echo $produto->TIPO_COMPLEMENTO?> - <?php echo $produto->DESCRICAO_TIPO_COMPLEMENTO?></p>
        </div>
        <div class="col-lg-12">
            <form action="<?php echo $sis->url_base('produtos')?>" method="POST" class="delete_produto">
                <a href="<?php echo $sis->url_base('produtos')?>" class="btn btn-success btn-sm">Voltar para a Lista de Produtos</a>
                <a href="<?php echo $sis->url_base('produto/'.$produto->PRODUTO.'/editar')?>" class="btn btn-info btn-sm">Editar Produto</a>
                <input type="hidden" name="PRODUTO" value="<?php echo $produto->PRODUTO;?>">
                <button type="submit" name="acao" value="delete_produto" id="<?php echo $produto->PRODUTO;?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir este Produto</button>
            </form>
            
        </div>
    </div>
</div>
<?php include'inc/footer.php';?>
<?php
if (!isset($_SESSION['EMPRESA'])) {
    header('Location:' . $sis->url_base().'?erro=Selecione uma empresa.');
}

$id_empresa = (int)$_SESSION['EMPRESA'];
$getEmpresa = $sis->select("SELECT e.*, c.* FROM empresa e INNER JOIN cidade c ON c.EMPRESA=e.EMPRESA AND c.CIDADE=e.CIDADE WHERE e.EMPRESA='$id_empresa'");
if(count($getEmpresa)>0){
    $empresa = $getEmpresa[0];
}else{
    header('Location:' . $sis->url_base().'?erro=Empresa Não Encontrada.');
}
?>
<?php include'inc/head.php';?>
<div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('')?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $empresa->NOME_FANTASIA?></li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <h2><?php echo $empresa->NOME_FANTASIA?></h2>
            <p><b>Razão Social:</b> <?php echo $empresa->RAZAO_SOCIAL?> <b>| CNPJ:</b> <?php echo $empresa->CNPJ?> <b>| I.E:</b> <?php echo $empresa->IE?></p>
        </div>
        <div class="col-lg-6 col-md-6 col-md-12 col-xs-12">
            <p><strong>Endereço: </strong> <?php echo $empresa->ENDERECO?>
            <br><strong>Bairro: </strong> <?php echo $empresa->BAIRRO?>
            <br><strong>CEP: </strong> <?php echo $empresa->CEP?> </p>
        </div>
        <div class="col-lg-6 col-md-6 col-md-12 col-xs-12">
            <p><strong>Cidade/UF: </strong> <?php echo $empresa->DESCRICAO_CIDADE?>-<?php echo $empresa->UF?>
            <br><strong>Pais: </strong> <?php echo $empresa->PAIS?>
            <br><strong>Telefone: </strong> <?php echo $empresa->TELEFONE?> </p>
        </div>
    </div>
</div>
<?php include'inc/footer.php';?>
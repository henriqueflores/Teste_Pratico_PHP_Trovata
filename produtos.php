<?php
if (!isset($_SESSION['EMPRESA'])) {
    header('Location:' . $sis->url_base().'?erro=Selecione uma empresa.');
}

$id_empresa = (int)$_SESSION['EMPRESA'];
$produtos = $sis->select("SELECT p.*, g.* FROM produto p"
        . " INNER JOIN grupo_produto g ON g.GRUPO_PRODUTO=p.GRUPO_PRODUTO AND g.EMPRESA=p.EMPRESA"
        . " WHERE p.EMPRESA='$id_empresa'");

if(isset($_GET['erro']) && !empty($_GET['erro'])){
    $erro = $_GET['erro'];
}
if(isset($_GET['sucesso']) && !empty($_GET['sucesso'])){
    $sucesso = $_GET['sucesso'];
}
?>
<?php include'inc/head.php';?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('')?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('empresa')?>"><?php echo $_SESSION['EMPRESA_NOME_FANTASIA']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                </ol>
            </nav>
            
            <h4>Lista de Produtos</h4>
            <hr>
            <?php if(isset($erro) && !empty($erro)){?><p class="alert alert-danger"><?php echo $erro;?></p><?php }?>
            <?php if(isset($sucesso) && !empty($sucesso)){?><p class="alert alert-success"><?php echo $sucesso;?></p><?php }?>
            
            <?php if (count($produtos) > 0) {?>  
                <div class="table-responsive">
                    <table class="table table-striped" id="empresas">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Descrição Produto</th>
                                <th scope="col">Apelido</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Situação</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos as $produto){?>
                                <tr>
                                    <th scope="row"><?php echo $produto->PRODUTO?></th>
                                    <td><a class="link" href="<?php echo $sis->url_base('produto/'.$produto->PRODUTO)?>"><?php echo $produto->DESCRICAO_PRODUTO?></a></td>
                                    <td><?php echo $produto->APELIDO_PRODUTO?></td>
                                    <td><?php echo $produto->DESCRICAO_GRUPO_PRODUTO?></td>
                                    <td><?php if($produto->SITUACAO=='A'){echo "ATIVO";}elseif($produto->SITUACAO=='I'){echo "INATIVO";}?></td>
                                    <td><a href="<?php echo $sis->url_base('produto/'.$produto->PRODUTO)?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detalhes">Detalhes</a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
            <p>Não exitem produtos cadastrados.</p>

            <?php } ?>
        </div>
    </div>
</div>
<?php include'inc/footer.php';?>
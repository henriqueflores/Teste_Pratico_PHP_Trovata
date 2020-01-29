<?php

$empresas = $sis->select("select e.EMPRESA, e.NOME_FANTASIA, e.RAZAO_SOCIAL, "
        . "c.DESCRICAO_CIDADE, c.UF, c.PAIS from empresa e "
        . "INNER JOIN cidade c ON c.CIDADE=e.CIDADE AND c.EMPRESA=e.EMPRESA");

?>
<?php include'inc/head.php';?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
            
            <h4>Selecione a empresa que deseja administrar.</h4>
            <hr>
            <?php if (count($empresas) > 0) {?>  
                <div class="table-responsive">
                    <table class="table table-striped" id="empresas">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Razão Social</th>
                                <th scope="col">Nome Fantasia</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">UF</th>
                                <th scope="col">País</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($empresas as $empresa){?>
                                <tr>
                                    <th scope="row"><?php echo $empresa->EMPRESA?></th>
                                    <td><a class="link" href="<?php echo $sis->url_base('empresas?seleciona_empresa='.$empresa->EMPRESA)?>"><?php echo $empresa->RAZAO_SOCIAL?></a></td>
                                    <td><?php echo $empresa->NOME_FANTASIA?></td>
                                    <td><?php echo $empresa->DESCRICAO_CIDADE?></td>
                                    <td><?php echo $empresa->UF?></td>
                                    <td><?php echo $empresa->PAIS?></td>
                                    <td><a href="<?php echo $sis->url_base('empresas?seleciona_empresa='.$empresa->EMPRESA)?>" class="btn btn-sm btn-info">Selecionar</a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
            <p>Não exitem empresas cadastradas.</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php include'inc/footer.php';?>
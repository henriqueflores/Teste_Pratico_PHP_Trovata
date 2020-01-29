<?php
if (!isset($_SESSION['EMPRESA'])) {
    header('Location:' . $sis->url_base() . '?erro=Selecione uma empresa.');
}
$id_empresa = (int) $_SESSION['EMPRESA'];
$grupo_produto = $sis->select("select * from grupo_produto where EMPRESA='$id_empresa'");
?>
<?php include'inc/head.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('empresa')?>"><?php echo $_SESSION['EMPRESA_NOME_FANTASIA']?></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $sis->url_base('produtos')?>">Produtos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastrar Produtos</li>
                </ol>
            </nav>

            <h4>Cadastro de Novos Produtos</h4>
            <hr>
            <?php if(isset($erro) && !empty($erro)){?><p class="alert alert-danger"><?php echo $erro;?></p><?php }?>
            <?php if(isset($sucesso) && !empty($sucesso)){?><p class="alert alert-success"><?php echo $sucesso;?></p><?php }?>
            
            <form action="" method="POST">
                <input type="hidden" name="ACAO" value="cadastrar">
                <input type="hidden" name="EMPRESA" value="<?php echo $id_empresa?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código do Produto:</label>
                        <input type="text" class="form-control" id="codigo" placeholder="Código do Produto" maxlength="15" name="PRODUTO" value="<?php if(isset($_POST['PRODUTO'])){echo $_POST['PRODUTO'];}?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apelido">Apelido do Produto:</label>
                        <input type="text" class="form-control" id="apelido" placeholder="Apelido Produto" maxlength="100" name="APELIDO_PRODUTO" value="<?php if(isset($_POST['APELIDO_PRODUTO'])){echo $_POST['APELIDO_PRODUTO'];}?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição do Produto:</label>
                    <textarea class="form-control" id="descricao" placeholder="Descreva seu produto" maxlength="250" name="DESCRICAO_PRODUTO"><?php if(isset($_POST['DESCRICAO_PRODUTO'])){echo $_POST['DESCRICAO_PRODUTO'];}?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="grupo">Grupo:</label>
                        <select id="grupo" class="form-control" name="GRUPO_PRODUTO">
                            <option value="">--Selecione--</option>
                            <?php if(count($grupo_produto)>0){
                                foreach($grupo_produto as $grupo_p){?>
                                    <option value="<?php echo $grupo_p->GRUPO_PRODUTO ?>" <?php if(isset($_POST['GRUPO_PRODUTO']) && $_POST['GRUPO_PRODUTO']==$grupo_p->GRUPO_PRODUTO){echo 'selected="selected"';}?>><?php echo $grupo_p->DESCRICAO_GRUPO_PRODUTO ?></option>
                                <?php }?>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="subgrupo">Subgrupo:</label>
                        <select id="subgrupo" class="form-control" name="SUBGRUPO_PRODUTO">
                            <option value="">--Selecione--</option>
                            <?php if(count($grupo_produto)>0){
                                foreach($grupo_produto as $subgrupo){?>
                                    <option value="<?php echo $subgrupo->GRUPO_PRODUTO ?>" <?php if(isset($_POST['SUBGRUPO_PRODUTO']) && $_POST['SUBGRUPO_PRODUTO']==$subgrupo->GRUPO_PRODUTO){echo 'selected="selected"';}?>><?php echo $subgrupo->DESCRICAO_GRUPO_PRODUTO ?></option>
                                <?php }?>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="situacao">Situação:</label>
                        <select id="situacao" class="form-control" name="SITUACAO">
                            <option value="">--Selecione--</option>
                            <option value="A" <?php if(isset($_POST['SITUACAO']) && $_POST['SITUACAO']=='A'){echo 'selected="selected"';}?>>Ativo</option>
                            <option value="I" <?php if(isset($_POST['SITUACAO']) && $_POST['SITUACAO']=='I'){echo 'selected="selected"';}?>>Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="peso">Peso Líquido:</label>
                        <input type="text" class="form-control" id="peso" maxlength="12" name="PESO_LIQUIDO" value="<?php if(isset($_POST['PESO_LIQUIDO'])){echo $_POST['PESO_LIQUIDO'];}?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="classificacao">Classificação Fiscal:</label>
                        <input type="text" class="form-control" id="classificacao" maxlength="10" name="CLASSIFICACAO_FISCAL" value="<?php if(isset($_POST['CLASSIFICACAO_FISCAL'])){echo $_POST['CLASSIFICACAO_FISCAL'];}?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="codigobarras">Código Barras:</label>
                        <input type="text" class="form-control" id="codigobarras" maxlength="50" name="CODIGO_BARRAS" value="<?php if(isset($_POST['CODIGO_BARRAS'])){echo $_POST['CODIGO_BARRAS'];}?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="colecao">Coleção:</label>
                        <input type="text" class="form-control" id="colecao" maxlength="100" name="COLECAO" value="<?php if(isset($_POST['COLECAO'])){echo $_POST['COLECAO'];}?>">
                    </div>
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                </p>
                
            </form>
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?>
<?php require_once 'hf_class.php';
$sis = new hf();?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /* SELECT 
        $produtos = $sis->select("select * from produto"); 
        foreach($produtos as $produto){
            echo '<pre>';
            print_r($produto);
            echo '</pre>';
        }*/
        
        /* INSERT 
        $check_prod = $sis->select("select * from produto WHERE EMPRESA=1 AND PRODUTO=6");
        if(count($check_prod)==0){
            $campos = [
                "EMPRESA"=> '1',
                "PRODUTO"=> '6',
                "DESCRICAO_PRODUTO"=> '4',
                "APELIDO_PRODUTO"=> '4',
                "GRUPO_PRODUTO"=> '4',
                "SUBGRUPO_PRODUTO"=> '4',
                "SITUACAO"=> '4',
                "PESO_LIQUIDO"=> '4',
                "CLASSIFICACAO_FISCAL"=> '4',
                "CODIGO_BARRAS"=> '4',
                "COLECAO"=> '4',
            ];
            $insert = $sis->insert("produto", $campos);
            if($insert){
                echo 'Produto cadastrado com sucesso.<br>';
            }else{
                echo 'Produto não cadastrado.';
            }
        }else{
            echo 'Já existe!';
        }*/
        
        /* UPDATE 
        $update = $sis->updateDelete("UPDATE produto SET DESCRICAO_PRODUTO='kkkasdk' WHERE EMPRESA=1 AND PRODUTO=6");
        if($update){
            echo 'Atualizado com sucesso.';
        }else{
            echo 'Não atualizou.';
        }*/
        
        /* DELETE 
        $update = $sis->updateDelete("DELETE FROM produto WHERE EMPRESA=1 AND PRODUTO=6");
        if($update){
            echo 'Deletado com sucesso.';
        }else{
            echo 'Não atualizou.';
        }*/
        
        $check_prod = $sis->select("select * from produto WHERE EMPRESA=1 AND PRODUTO=6");
        if(count($check_prod)>0){
            echo '<pre>';
            print_r($check_prod[0]);
            echo '</pre>';
        }else{
            echo 'Produto não encontrado.';
        }
        
        ?>
        
        
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- Datatables Produtos e Empresas -->
        <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <!-- Mascara para Decimais do Peso -->
        <script src="<?php echo $sis->url_base('js/jquery.maskMoney.min.js')?>" type="text/javascript"></script>
        <title><?php echo $sis->titulo; ?></title>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".delete_produto").submit(function(){
                    if(confirm("Você tem certeza de que deseja remover este produto?")){
                        return true;
                    }else{
                        return false;
                    };
                });
                
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                });
                  
                $("#peso").maskMoney({
                    prefix: "",
                    decimal: ".",
                    precision: 3,
                    thousands: ""
                });
                
                $('#empresas').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    }
                });
            });
        </script>


    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-light">
                        <div class="row">
                            <div class="col-lg-3 text-center">
                                <a class="navbar-brand" href="<?php echo $sis->url_base() ?>"><img src="https://trovata.com.br/wp-content/uploads/2018/09/logo_trovata.png" class="img-fluid" alt="Logo Trovata" title="Catálogo de Produtos - Trovata"></a>
                            </div>
                            <div class="col-lg-9">
                                <?php if (isset($_SESSION['EMPRESA'])) { ?>
                                    <p class="text-center" style="padding-top: 5px;">
                                        Você está conectado na empresa: 
                                        <a class="link" href="<?php echo $sis->url_base('empresa') ?>"><?php echo $_SESSION['EMPRESA_NOME_FANTASIA'] ?></a><br>
                                        <a href="<?php echo $sis->url_base()?>" class="btn btn-sm btn-success">Trocar Empresa</a>
                                        <a href="<?php echo $sis->url_base('produtos')?>" class="btn btn-sm btn-info">Listar Produtos</a>
                                        <a href="<?php echo $sis->url_base('produtos-cadastro')?>" class="btn btn-sm btn-warning">Cadastrar Produtos</a>
                                        <a href="<?php echo $sis->url_base("sair")?>" class="btn btn-sm btn-danger">Sair</a>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

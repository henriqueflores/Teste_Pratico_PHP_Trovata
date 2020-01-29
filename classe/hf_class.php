<?php 
/*
 * 
 * HF Class - Henrique Flores 
 * Classe em PHP e Firebird Criada para o Teste Prático para Vaga de PHP Trovata
 * Data criação: 27/01/2019
 * 
 */

class hf{
    private $base_path = "127.0.0.1:C:/db/CATALOGO.FDB";
    private $base_user = "SYSDBA";
    private $base_pass = "masterkey";
    
    private $_url = "http://localhost/Teste/";
    public $titulo = "Teste Prático PHP - Trovata Birigui";
    
    public function select($sql){
        $conecta = ibase_connect($this->base_path, $this->base_user, $this->base_pass) or die ("Erro ao conectar ao banco de dados.");
        $qry = ibase_query($conecta, $sql);
        $retorno = [];
        while ( $row = ibase_fetch_assoc( $qry ) ){
            $retorno[] = (object)$row;
        }
        ibase_free_result($qry);
        ibase_close($conecta);
        return $retorno;
    }
    
    public function insert($tabela,$campos){
        $conecta = ibase_connect($this->base_path, $this->base_user, $this->base_pass) or die ("Erro ao conectar ao banco de dados.");
        $colunas = "";
        $values = "";
        foreach($campos as $chave=>$valor){
            $colunas .= $chave.',';
            $values .= "'$valor',";
        }
        $sql = "INSERT INTO $tabela (".substr($colunas, 0, -1).") VALUES (".substr($values, 0, -1).")";
        $qry = ibase_query($conecta, $sql);
        if($qry && ibase_commit()){
            ibase_close($conecta);
            return true;
        }else{
            ibase_close($conecta);
            return false;
        }
    }
    
    public function updateDelete($sql){
        $conecta = ibase_connect($this->base_path, $this->base_user, $this->base_pass) or die ("Erro ao conectar ao banco de dados.");
        $qry = ibase_query($conecta, $sql);
        if($qry){
            ibase_close($conecta);
            return true;
        }else{
            ibase_close($conecta);
            return false;
        }
    }
    
    public function url_base($caminho=""){
        $url = strtolower($this->_url.$caminho);
        return $url;
    }
    
    public function url($int){
        if(isset($_SERVER['REDIRECT_URL'])){
            $url_base = str_replace(['http://','https://'], ['',''], strtolower($this->_url));
            $url_atual = str_replace('//','/', strtolower($_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']));
            $segmentos = str_replace($url_base,'',$url_atual);
            $explode = explode("/", $segmentos);
            $n=1;
            foreach($explode as $exp){
                $return[$n] = $exp;
                $n++;
            }
            if(isset($return[$int])){
                return $return[$int];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}


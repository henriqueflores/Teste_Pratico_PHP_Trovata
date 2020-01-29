<?php session_start();
require_once 'classe/hf_class.php';
$sis = new hf();

include'controle_geral.php';

if(!$sis->url(1)){
    include 'home.php';
}else{
    if($sis->url(3)=='editar' && $sis->url(1)=='produto'){
        include 'produtos-editar.php';
    }elseif($sis->url(2)!=false && $sis->url(1)=='produto'){
        include 'produtos-detalhes.php';
    }elseif($sis->url(1)!=false && file_exists($sis->url(1).'.php')){
        include $sis->url(1).'.php';
    }else{
        include '404.php';
    }
}
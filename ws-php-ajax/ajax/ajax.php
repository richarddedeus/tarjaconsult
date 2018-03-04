<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);


$Action = $Post['action'];
$jSon = array();
unset($Post['action']);

switch ($Action):
case 'create':
  $jSon['success'] = "Cadastro com sucesso";
  break;
  default:
    $jSon['error'] = "Erro ao selecionar ação";
endswitch;


echo json_encode($jSon);


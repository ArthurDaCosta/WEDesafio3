<?php

function WebServiceExec($params, $data){ 
    
    $pg = intval($data['pagina']) - 1 < 1 ? 1 : intval($data['pagina']);
    
    $select = Db::readOnly()
        ->select([
            'idproduto',
            'dscproduto',
            'preco',
            'ativo',
            'imagem',
            'modalidade'
        ])
        ->from('pdv_produto')
        ->whereAND(['ativo' => true]);
    
    if(!empty($data['dscproduto'])) {
        $select = $select->whereANDLike('dscproduto', $data['dscproduto']);
    }
    
    if(!empty($data['modalidade'])) {
        $select = $select->whereAND(['modalidade' => $data['modalidade']]);
    }
    
    $select = $select->fetchAll();
    
    $totalPaginas = ceil(count($select) / 25);
    $produtos = we_paginateArray($select, $pg, 25);
                 
    return [
        'resultado' => $produtos,
        'totalPaginas' => $totalPaginas
    ]; 
}
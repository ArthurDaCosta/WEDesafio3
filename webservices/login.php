<?php

function WebServiceExec($params, $data){ 
    
    if(empty($data['cpf'])||empty($data['email']))
        throw new Exception('Os campos não podem estar vazios');
       
    $select = Db::ReadOnly()
        ->select([
            'pes.idpessoa',
            'pes.nome'
        ])
        ->from('base_pessoa pes')
        ->whereAND([
            'cpf' => $data['cpf'],
            'email' => $data['email']
        ])
        ->fetch();
       
   if(!$select)
       throw new Exception('CPF ou E-Mail incorreto');
    
    return $select; 
}
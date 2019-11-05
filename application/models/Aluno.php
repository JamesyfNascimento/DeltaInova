<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Model{

    // retorna  todos os alunos  do banco de dados
    public function getAlunos(){
        $query = $this->db->get('Alunos');
        return $query->result();
    }
}

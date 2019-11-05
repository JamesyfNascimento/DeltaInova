<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Model{

    // retorna  todos os alunos  do banco de dados
    public function getAlunos(){
        $query = $this->db->get('Alunos');
        return $query->result();
    }

    // persiste o aluno no banco
    public function  addAlunos($data = NULL){
        if($data != NULL){
            $this->db->insert('Alunos', $data);
        }
    }
}

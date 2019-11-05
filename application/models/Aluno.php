<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Model{

    // retorna  todos os alunos  do banco de dados
    public function getAlunos(){
        $query = $this->db->get('Alunos');
        return $query->result();
    }

    //get aluno pela matricula
    public function getAlunoByMatricula($matricula=NULL){
        if ($matricula != NULL){
            //Verifica se a matricula no banco de dados
            $this->db->where('matricula', $matricula);        
            //limita para apenas um regstro    
            $this->db->limit(1);
            //pega o aluno
            $query = $this->db->get("Alunos");        
            //retornamos o aluno
            return $query->row();   
        }
    } 

    // persiste o aluno no banco
    public function  addAlunos($data = NULL){
        if($data != NULL){
            $this->db->insert('Alunos', $data);
        }
    }

    //Atualizar um aluno na tabela Alunos
    public function editarAluno($data=NULL, $matricula=NULL){
        //Verifica se foi passado $data e $matricula    
        if ($data != NULL && $matricula != NULL){
            //Se foi passado ele vai a atualização
            $this->db->update('Alunos', $data, array('matricula'=>$matricula));      
        }
    } 

     // remove um aluno dado uma matricula
     public function removerAluno($matricula = NULL){
        if($matricula != NULL){
            $this->db->delete('Alunos', array('matricula' => $matricula));
        }
    }

}

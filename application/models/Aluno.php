<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Model{

    public function __construct(){
        parent::__construct();
        try{
            $this->load->database();
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
	}

    // retorna  todos os alunos  do banco de dados
    public function getAlunos(){
        try{
            $query = $this->db->get('Alunos');
            if($query){
                return $query->result();
            }
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
    }

    //get aluno pela matricula
    public function getAlunoByMatricula($matricula=NULL){
        try{
            if ($matricula != NULL){
                //Verifica se a matricula no banco de dados
                $this->db->where('matricula', $matricula);        
                //limita para apenas um regstro    
                $this->db->limit(1);
                //pega o aluno
                $query = $this->db->get('Alunos');        
                //retornamos o aluno
                return $query->row();   
            }
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
    } 

    // persiste o aluno no banco
    public function  addAlunos($data = NULL){
        if($data != NULL){
            $this->db->insert('Alunos', $data);
            $result = array(
                'Success' => true,
                'mensagem' => "Aluno cadastrado com sucesso",
     
            );
            return $result;  
        }
        $result = array(
            'Success' => false,
            'mensagem' => "Erro ao cadastrar Aluno",
 
        );
        return $result;
    }

    //Atualizar um aluno na tabela Alunos
    public function editarAluno($data=array(), $matricula=NULL){
        try{
            //Verifica se foi passado $data e $matricula    
            if ($data != NULL && $matricula != NULL){
                //Se foi passado ele vai a atualização
                $this->db->where("matricula",$matricula);
                //$this->db->from("Alunos");
                $this->db->update("Alunos",$data);
                $result = array(
                    'Success' => true,
                    'mensagem' => "Aluno alterado com sucesso",
         
                );
                return $result;      
            }
            $result = array(
                'Success' => false,
                'mensagem' => "Erro ao alterar Aluno",
     
            );
            return $result;  
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
    } 

     // remove um aluno dado uma matricula
     public function removerAluno($matricula = NULL){
        try{
            if($matricula != NULL){
                $this->db->delete('Alunos', array('matricula' => $matricula));
            }
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
    }

}

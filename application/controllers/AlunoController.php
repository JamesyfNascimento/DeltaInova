<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class AlunoController extends REST_Controller {

	public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'OPTIONS') {
            die();
        }
        parent::__construct();
        $this->load->model('Aluno' , 'Aluno');
	}
		
	//retorna a lista dos alunos
	public function listarTodos_get(){
        $data = $this->Aluno->getAlunos();
        $this->response($data, REST_Controller::HTTP_OK);
        
    }

    public function aluno_get($matricula){
        $data = $this->Aluno->getAlunoByMatricula($matricula);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function adicionarAluno_post(){
        $input = $this->input->post();
        $this->Aluno->addAlunos($input);
        $this->response(['Aluno cadastrado.'], REST_Controller::HTTP_OK);
    } 

    public function editarAluno_put($matricula){
        $input = $this->put();
        $this->Aluno->editarAluno($input, array('matricula'=>$matricula));
        $this->response(['Aluno alterado.'], REST_Controller::HTTP_OK);

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

    public function removerAluno_post(){
        try{
            $matricula = $this->uri->segment('3');
            $this->Aluno->removerAluno($matricula);
            if($this->getAlunoByMatricula($matricula)){
                $this->response(['Aluno removido.'], REST_Controller::HTTP_OK);
            }else{
                throw new Exception("Erro ao deletar aluno");
            }
        }catch(Exception $e){
            $errorMessage =  $e->getMessage();
            throw new Exception($errorMessage);
        }
    }
    
}

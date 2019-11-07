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
        $this->response($data , REST_Controller::HTTP_OK);
    }

    public function adicionarAluno_post(){
        $post = $this->post();
        $input = json_decode($post[0], true);
        $aluno = array(
            'nome' => $input['nome'],
            'avatar' => $input['avatar']
 
        );
        $result = $this->Aluno->addAlunos($aluno);
        $this->response($result, REST_Controller::HTTP_OK);
    } 

    public function editarAluno_post(){
        $post = $this->post();
        $input = json_decode($post[0], true);
        $matricula = $input['matricula'];
        $result = $this->Aluno->editarAluno($input, $matricula);
        $this->response($result, REST_Controller::HTTP_OK);


    }  

    public function removerAluno_post(){
        try{
            $matricula = $this->uri->segment('3');
            $this->Aluno->removerAluno($matricula);
            if($this->Aluno->getAlunoByMatricula($matricula)){
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

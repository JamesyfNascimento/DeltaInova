<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	exit;
}

class AlunoController extends REST_Controller {

	public function __construct(){
            parent::__construct();
			$this->load->model('Aluno' , 'Aluno');
	}
		
	//retorna a lista dos alunos
	public function index_get($matricula = 0){
        if(!empty($matricula)){
            $data = $this->Aluno->getAlunoByMatricula($matricula);
        }else{
            $data = $this->Aluno->getAlunos();
        }

        $this->response($data, REST_Controller::HTTP_OK);
        
    }

    public function index_post(){
        $input = $this->input->post();
        $this->Aluno->addAlunos($input);
        $this->response(['Aluno cadastrado.'], REST_Controller::HTTP_OK);
    } 

    public function index_put($matricula){
        $input = $this->put();
        $this->Aluno->editarAluno($input, array('matricula'=>$matricula));
        $this->response(['Aluno alterado.'], REST_Controller::HTTP_OK);

    }

    public function index_delete($matricula){
        $this->Aluno->removerAluno($matricula);
        $this->response(['Aluno removido.'], REST_Controller::HTTP_OK);
    }
    
}

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
	public function index_get(){
        $data = $this->Aluno->getAlunos();
        print_r($data);
		if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array(), 200);
        }
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
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AlunosController extends REST_Controller {

	public function __construct(){
			parent::__construct();
			$this->load->model('Alunos' , 'Alunos');
	}
		
	//retorna a lista dos alunos
	public function getAlunos(){
        $data = $this->Alunos->getAlunos();
        print_r($data);
		if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array(), 200);
        }
	}
}

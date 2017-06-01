<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palestras extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('participantes_model', 'participantes');
        $this->participantes->loggedParticipante();
    }
	
	public function cadastrar()
	{
		$data['conteudo'] = 'sist/acoes';
		$this->load->view('tpllogin', $data);
	}
	
	
}

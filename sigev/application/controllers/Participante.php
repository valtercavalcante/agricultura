<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participante extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('participantes_model', 'participantes');
        $this->participantes->loggedParticipante();
    }

	
	public function formcadastro()
	{
		$data['conteudo'] = 'sist/cadastro_participante';
		$this->load->view('tpllogin', $data);
		
	}
	
}

<?php
class Participantes_model extends CI_Model{
    public function buscaPorParticipante(){
    	
        $this->db->where('cpf', $this->input->post('cpf')); 
        $this->db->where("senha", md5($this->input->post('senha')));
        $visitante = $this->db->get("participante")->row_array();
        return $visitante;

	}
	function loggedParticipante() {
        $logged = $this->session->userdata('logged');
        if (!isset($logged) || $logged != true) {
        	echo '<script type="text/javascript">alert("Você não está logado!");window.location.href=\''.base_url().'login/index\';
    			</script>';
            //echo  "<script>alert('Você não está logado');</script>";
			//redirect('/login/index/', 'refresh');
			//die();
        }
    }
	
	function insereParticipante(){
		
		$data = array(
   			'nome' => mb_strtoupper($this->input->post('nome'), 'UTF-8'),
   			'email' => $this->input->post('email'),
   			'senha' => md5($this->input->post('senha')),
   			'telefone' => $this->input->post('telefone'),
   			'cpf' => $this->input->post('cpf'),
   			'ocupacao' => $this->input->post('ocupacao'),
   			'cidade' => $this->input->post('cidade'),
   			'estado' => $this->input->post('estado'),
		);
		if($this->db->insert('participante', $data)){
			return TRUE;
		}
		
	}
	function resetaSenha(){
		
		$data = array(
   			'nome' => mb_strtoupper($this->input->post('nome'), 'UTF-8'),
   			'email' => $this->input->post('email'),
   			'senha' => md5($this->input->post('senha')),
   			'telefone' => $this->input->post('telefone'),
   			'cpf' => $this->input->post('cpf'),
   			'vinculo' => $this->input->post('vinculo'),
   			'cidade' => $this->input->post('cidade'),
   			'estado' => $this->input->post('estado'),
		);
		if($this->db->insert('participante', $data)){
			return TRUE;
		}
		
	}
}
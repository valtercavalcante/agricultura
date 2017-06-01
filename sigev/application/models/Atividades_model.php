<?php
class Atividades_model extends CI_Model{
    
	function insereAtividade(){
		$this->load->helper('date');
		$stringdedata = "Y-m-d";
		$data = array(
   			'nome' => mb_strtoupper($this->input->post('nome'), 'UTF-8'),
   			'palestrante' => mb_strtoupper($this->input->post('palestrante'), 'UTF-8'),
   			'hora_inicio' => $this->input->post('hora_inicio'),
   			'hora_final' => $this->input->post('hora_final'),
   			'data' => implode('-', array_reverse(explode('/', $this->input->post('data')))),
   			'tipo' => $this->input->post('tipo'),
		);
   		if($this->db->insert('atividade', $data)){
			return TRUE;
		}
		
	}
}
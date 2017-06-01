<?php
class Comboselect_model extends CI_Model{
    //put your code here
    public function getEstados() {
        $this->db->order_by('nome', 'asc');
        $estados = $this->db->get('estados');
        
        if($estados->num_rows() > 0){
            return $estados->result();
        }
    }
    
    public function getCiudades($idEstado) {
        $this->db->where('estado', $idEstado);
        $this->db->order_by('nome', 'asc');
        $ciudades = $this->db->get('cidade');
        
        if($ciudades->num_rows() > 0){
            return $ciudades->result();
		}
    }
}
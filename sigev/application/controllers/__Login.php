<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
		$data['conteudo'] = 'login/login';
		$this->load->view('tpllogin', $data);
		
	}
	public function autenticar(){
		//$data['mensagem'] = '';
 		$this->load->library('form_validation');
		$this->form_validation->set_rules('cpf', 'cpf', 'required', array('required' => "Você precisa inserir um %s."));
		$this->form_validation->set_rules('senha', 'senha', 'required', array('required' => "Você precisa inserir uma %s."));
		$this->form_validation->set_error_delimiters('<p class="bg-danger text-danger" align="center">', '</p>');
		
		if(isset($_POST['cpf'])){
			$_POST['cpf'] = str_replace(".", "", $_POST['cpf']);
 			$_POST['cpf'] = str_replace("-", "", $_POST['cpf']);
 		}
		if ($this->form_validation->run() == FALSE)
        {
        	$data['conteudo'] = 'login/login';
			$this->load->view('tpllogin', $data);
        }
		else{
	        $this->load->model("participantes_model");// chama o modelo usuarios_model
	        //$usuario = $this->input->post("usuario");
			//$senha = $this->input->post("senha"); // pega via post a senha que venho do formulario
	        $data['usuario'] = $this->participantes_model->buscaPorParticipante(); // acessa a função buscaPorEmailSenha do modelo
	 
	        if($data['usuario']){
	        	if($data['usuario']['resetasenha'] == 1){
	        		$data['usuario']['logged']= true;
	            	$this->session->set_userdata($data['usuario']);
	        		$data['conteudo'] = 'sist/trocasenha';
					$this->load->view('tpllogin', $data);
	        	}
				else{
	        	$data['usuario']['logged']= true;
	            $this->session->set_userdata($data['usuario']);
	         	$data['mensagem'] = "Logado com sucesso!";
				$data['conteudo'] = 'sist/bemvindo';
			    $this->load->view('tplsist', $data);
				}
				 
	        }else{
	            $data['erro'] = "<p class='bg-danger text-danger' align='center'> Usuário ou senha incorretos <br /> Se não possui usuário e senha efetue o cadastro!</p>";
				$data['conteudo'] = 'login/login';
				$this->load->view('tpllogin', $data);
	        }
	 
	       
		}
    }

	public function cadastroParticipante()
	{
		$this->db->select('*');
		$this->db->from('profissoes');
		$this->db->order_by("nomeprofissao", "desc");
		$profissoes = $this->db->get()->result();
		$data['profissoes'] = '';
		foreach ($profissoes as $profissao) {
			$data['profissoes'] = '<option value="'.$profissao->idprofissao.'">'.$profissao->nomeprofissao.'</option>'.$data['profissoes'];
		}
		$this->db->select('*');
		$this->db->from('estado');
		$this->db->order_by("nome", "desc");
		$estados = $this->db->get()->result();
		$data['estados'] = '';
		foreach ($estados as $estado) {
			$data['estados'] = '<option value="'.$estado->id.'">'.$estado->nome.'</option>'.$data['estados'];
		}
		$data['conteudo'] = 'sist/cadastro_participante';
		$this->load->view('tpllogin', $data);
	}
	public function buscaCidade() {
        $idEstado = $this->input->post('idEstado');
        if($idEstado){
            $this->load->model('comboselect_model');
            $cidades = $this->comboselect_model->getCiudades($idEstado);
            //echo '<option value="0">'.$idEstado.'</option>';
            foreach($cidades as $cidade){
                echo '<option value="'. $cidade->id .'">'. $cidade->nome .'</option>';
            }
        }else {
            echo '<option value="0">Escolha uma cidade</option>';
        }
    }
    
	public function efetuaCadastroParticipante()
	{
		$this->load->library('form_validation');
        //$this->form_validation->set_rules('nome', 'Nome ', 'required|is_unique[membership.username]',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('nome', 'Nome ', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('cpf', 'CPF ', 'required|valid_cpf|is_unique[participante.cpf]',array('required' => "O campo %s é obrigatório",'valid_cpf' => "O CPF informado &eacute; inv&aacute;lido",'is_unique' => "CPF já cadastrado"));
		$this->form_validation->set_rules('email', 'E-mail ', 'required',array('required' => "O campo %s é obrigatório"));
        $this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmsenha]',array('required' => "O campo %s é obrigatório", 'matches' => "Senha e Confirmação de Senha não coincidem"));
		$this->form_validation->set_rules('confirmsenha', 'Confirmação de Senha', 'required',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('ocupacao', 'Ocupa&ccedil;&atilde;o', 'required',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('cidade', 'Cidade', 'required',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('estado', 'Estado', 'required',array('required' => "O campo %s é obrigatório"));
        $this->form_validation->set_error_delimiters('<p class="bg-danger text-danger" align="center">', '</p>');
		
		if(isset ($_POST['cpf'])){
 			$_POST['cpf'] = str_replace(".", "", $_POST['cpf']);
 			$_POST['cpf'] = str_replace("-", "", $_POST['cpf']);
 		}
		
		if ($this->form_validation->run() == FALSE)
        {
        	$this->db->select('*');
			$this->db->from('profissoes');
			$this->db->order_by("nomeprofissao", "desc");
			$profissoes = $this->db->get()->result();
			$data['profissoes'] = '';
			foreach ($profissoes as $profissao) {
			$data['profissoes'] = '<option value="'.$profissao->idprofissao.'">'.$profissao->nomeprofissao.'</option>'.$data['profissoes'];
			}
			$this->db->select('*');
			$this->db->from('estado');
			$this->db->order_by("nome", "desc");
			$estados = $this->db->get()->result();
			$data['estados'] = '';
			foreach ($estados as $estado) {
				$data['estados'] = '<option value="'.$estado->id.'">'.$estado->nome.'</option>'.$data['estados'];
			}
        	$data['conteudo'] = 'sist/cadastro_participante';
			$this->load->view('tpllogin', $data);
        }
		else{
		$this->load->model("participantes_model");// chama o modelo usuarios_model
		
	       if($this->participantes_model->insereParticipante()){
	       		echo '<script type="text/javascript">alert("Inscrição Realizada com sucesso!");window.location.href=\''.base_url().'login/\';
    			</script>';
				//echo  "<script>alert('Inscrição realizada com sucesso!');</script>";
				//redirect('/login/', 'refresh');
				//die();
			}else {
				echo  "<script>alert('Aconceteu um erro no cadastro, tente novamente!');</script>";
				$this->db->select('*');
				$this->db->from('profissoes');
				$this->db->order_by("nomeprofissao", "desc");
				$profissoes = $this->db->get()->result();
				$data['profissoes'] = '';
				foreach ($profissoes as $profissao) {
					$data['profissoes'] = '<option value="'.$profissao->idprofissao.'">'.$profissao->nomeprofissao.'</option>'.$data['profissoes'];
				}
				$this->db->select('*');
				$this->db->from('estado');
				$this->db->order_by("nome", "desc");
				$estados = $this->db->get()->result();
				$data['estados'] = '';
				foreach ($estados as $estado) {
					$data['estados'] = '<option value="'.$estado->id.'">'.$estado->nome.'</option>'.$data['estados'];
				}
				$data['conteudo'] = 'sist/cadastro_participante';
				$this->load->view('tpllogin', $data);
			}
		}
	}
	function destroy_session(){
		$this->session->sess_destroy();
		redirect('/login/', 'refresh');
	}
}

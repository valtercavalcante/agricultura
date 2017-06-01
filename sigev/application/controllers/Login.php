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
	       		
			
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that



$this->load->library('My_PHPMailer');
//Create a new PHPMailer instance
	$mail = new My_PHPMailer();
    $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
    $mail->SMTPAuth = true; //Habilitamos a autenticação do SMTP. (true ou false)
    $mail->SMTPSecure = "ssl"; //Estabelecemos qual protocolo de segurança será usado.
    $mail->Host = "smtp.gmail.com"; //Podemos usar o servidor do gMail para enviar.
    $mail->Port = 465; //Estabelecemos a porta utilizada pelo servidor do gMail.
    $mail->Username = "valtinholima@gmail.com"; //Usuário do gMail
    $mail->Password = "MINHABENGA26"; //Senha do gMail
    $mail->SetFrom('valtinholima@gmail.com', 'Valter'); //Quem está enviando o e-mail.
    //$mail->AddReplyTo("valter.cavalcante@ifpi.edu.br","Valter Cavalcante"); //Para que a resposta será enviada.
    $mail->Subject = "Assunto"; //Assunto do e-mail.
    $mail->Body = "Corpo do e-mail em HTML.<br />";
    $mail->AltBody = "Corpo em texto puro.";
    $destino = "valter.cavalcante@ifpi.edu.br";
    $mail->AddAddress($destino, "Nicholas Lopes Leite");
 
 
    if(!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        echo "Mensagem enviada com sucesso!";
    }


			
	/*
		
			$this->email->subject('Cadastro I SEMPREIFPI');
			$this->email->message('<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
									 <tr>
									  <td>
									  	<img src="http://www.sempreifpi.com/sigev/assets/images/feira-do-empreendedor-2016-400.png" alt="Logomarca SEMPREIFPI" width="400" height="110" style="display: block;" />
									  </td>
									 </tr>
									 <tr>
									  <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
									 <table border="0" cellpadding="0" cellspacing="0" width="100%">
									  <tr>
									   <td>
									   	<strong>Bem vindo ao I SEMPREIFPI </strong><br /> Você acaba de se cadastrar no nosso Sistema de Gerenciamento de Eventos - SIGEV 
									   	<br /><br /> Acesse o sistema e se inscreva nas atividades de seu interesse.
									   </td>
									  </tr>
									  <tr>
									   <td>
									   	<br /><strong>CPF: </strong>'.$_POST['cpf'].'
									   </td>
									  </tr>
									  <tr>
									   <td>
									  <strong>Senha: </strong>'.$_POST['senha'].'
									   </td>
									  </tr>
									 </table>
									</td>
									 </tr>
									 <tr>
									  <td>
									   A Coordenação do I SEMPREIFPI agradece sua presença.
									  </td>
									 </tr>
									</table>');
		if($this->email->send()){
			$this->email->print_debugger();
			//echo '<script type="text/javascript">alert("Inscrição Realizada com sucesso!");window.location.href=\''.base_url().'login/\';
    			//</script>';
		}
		else{
			$this->email->print_debugger();
			//echo '<script type="text/javascript">alert("Inscrição Realizada com sucesso!");window.location.href=\''.base_url().'login/\';
    			///</script>';-->
		}
	*/
			}else {
				echo  "<script>alert('Aconteceu um erro no cadastro, tente novamente!');</script>";
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

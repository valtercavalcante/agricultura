<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sist extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('participantes_model', 'participantes');
        $this->participantes->loggedParticipante();
    }
	
	public function home_sist() {
		$data['conteudo'] = 'sist/bemvindo';
		$this->load->view('tplsist', $data);
	}
	
	
	public function form_inscricao(){
		$this->load->helper('date');
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('tipo','2');
		$this->db->order_by('data desc , hora_inicio desc');
		$minicursos = $this->db->get()->result();
		$data['minicursos'] = "";
		foreach ($minicursos as $minicurso){
			$this->db->select('*');
			$this->db->from('inscricoes');
			$this->db->where('id_atividade',$minicurso->id);
			$numinscritos = $this->db->get()->num_rows();
				if ($numinscritos>$minicurso->vagas || $numinscritos==$minicurso->vagas){
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
				}
				else{
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
					//$botao = anchor('sist/realiza_inscricao/'.$minicurso->id, 'Realizar Inscrição', array('class' => 'btn btn-primary btn-sm'));
				}
			$stringdedata = "d/m/Y";
			$minicurso->data = date($stringdedata, strtotime($minicurso->data));
			$data['minicursos']= "<tr><td>".$minicurso->nome."</td><td>".$minicurso->palestrante."</td><td align=\"center\">".$minicurso->data."</td><td align=\"center\">".substr($minicurso->hora_inicio, 0,5)
			."</td><td align=\"center\">".substr($minicurso->hora_final, 0,5)."</td><td>".$botao."</td></tr>".$data['minicursos'];
		}
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('tipo','1');
		$this->db->order_by('data desc , hora_inicio desc');
		$palestras = $this->db->get()->result();
		$data['palestras'] = "";
		foreach ($palestras as $palestra){
			$this->db->select('*');
			$this->db->from('inscricoes');
			$this->db->where('id_atividade',$palestra->id);
			$numinscritos = $this->db->get()->num_rows();
				if ($numinscritos>$palestra->vagas || $numinscritos==$palestra->vagas){
					//$botao = anchor('sist/form_inscricao', 'Vagas Esgotadas', array('class' => 'btn btn-danger btn-sm','disabled'=>'disabled'));
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
				}
				else{
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
					//$botao = anchor('sist/realiza_inscricao/'.$palestra->id, 'Realizar Inscrição', array('class' => 'btn btn-primary btn-sm'));
				}
			$stringdedata = "d/m/Y";
			$palestra->data = date($stringdedata, strtotime($palestra->data));
			//$dtcurso = date($stringdedata, $minicurso->data);
			$data['palestras']= "<tr><td>".$palestra->nome."</td><td>".$palestra->palestrante."</td><td align=\"center\">".$palestra->data."</td><td align=\"center\">".substr($palestra->hora_inicio, 0,5).
			"</td><td align=\"center\">".substr($palestra->hora_final, 0,5)."</td><td>".$botao."</td></tr>".$data['palestras'];		
		}
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('tipo','3');
		$this->db->order_by('data desc , hora_inicio desc');
		$oficinas = $this->db->get()->result();
		$data['oficinas'] = "";
		foreach ($oficinas as $oficina){
			$this->db->select('*');
			$this->db->from('inscricoes');
			$this->db->where('id_atividade',$oficina->id);
			$numinscritos = $this->db->get()->num_rows();
				if ($numinscritos>$oficina->vagas || $numinscritos==$oficina->vagas){
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
				}
				else{
					$botao = '<button type="button" class="btn btn-danger btn-sm" disabled="disabled">Inscrições Encerradas</button>';
					//$botao = anchor('sist/realiza_inscricao/'.$oficina->id, 'Realizar Inscrição', array('class' => 'btn btn-primary btn-sm'));
				}
			$stringdedata = "d/m/Y";
			$oficina->data = date($stringdedata, strtotime($oficina->data));
			//$dtcurso = date($stringdedata, $minicurso->data);
			$data['oficinas']= "<tr><td>".$oficina->nome."</td><td>".$oficina->palestrante."</td><td align=\"center\">".$oficina->data."</td><td align=\"center\">".substr($oficina->hora_inicio, 0,5).
			"</td><td align=\"center\">".substr($oficina->hora_final, 0,5)."</td><td>".$botao."</td></tr>".$data['oficinas'];		
		}
		$data['conteudo'] = 'sist/form_inscricao';
		$this->load->view('tplsist', $data);
	}
	public function realiza_inscricao($id_atividade) {
		//seleciona as informações da atividade o usuário pretende se inscrever	
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('id',$id_atividade);
		$atividade = $this->db->get()->row();
		//seleciona todas as incrições que o usuário logado possui	
		$this->db->select('*');
		$this->db->from('inscricoes');
		$this->db->where('id_participante',$this->session->userdata('id'));
		$inscricoes_do_participante = $this->db->get();
		//verifica se ele já está incrito em alguma atividade
		if($inscricoes_do_participante->num_rows() == 0){ //se não possuir insere sua primeira atividade 
			$this->db->insert('inscricoes',array('id_atividade'=>$id_atividade,'id_participante' => $this->session->userdata('id')));
			echo '<script type="text/javascript">alert("Inscrição Realizada com sucesso!");window.location.href=\''.base_url().'sist/form_inscricao\';
    		</script>';
			//echo  "<script>alert('Inscrição Realizada com sucesso!');</script>";
			//redirect('/sist/form_inscricao/', 'refresh');
			//die();	
		}
		else{ //se já possuir inscrições 
			$this->db->select('*');
			$this->db->from('inscricoes');
			$this->db->where('id_atividade',$id_atividade);
			$this->db->where('id_participante',$this->session->userdata('id'));
			$inscricoes = $this->db->get();
			if($inscricoes->num_rows() !=0){ //verifica se já está inscrito no curso pretendido
			echo '<script type="text/javascript">alert("Você já está inscrito neste curso!");window.location.href=\''.base_url().'sist/form_inscricao/\';
    		</script>';
				//echo  "<script>alert('Você já está inscrito neste curso!');</script>";
				//redirect('/sist/form_inscricao/', 'refresh');
				//die();	
			}
			else{ //se não estiver inscrito no curso pretendido
				$verfifica_horario = TRUE;
				foreach ($inscricoes_do_participante -> result() as $inscricao){ //verifica se a data e horário do curso pretendido estão batendo com algum dos cursos já inscritos
					$this->db->select('*');
					$this->db->from('atividade');
					$this->db->where('id',$inscricao->id_atividade);
					$dados_inscricao = $this->db->get()->row();
					if (($dados_inscricao->data != $atividade->data) || (($atividade->hora_inicio < $dados_inscricao->hora_inicio && $atividade->hora_inicio < $dados_inscricao->hora_final &&
						   $atividade->hora_final <= $dados_inscricao->hora_inicio && $atividade->hora_final < $dados_inscricao->hora_final) ||
						   ($atividade->hora_inicio > $dados_inscricao->hora_inicio && $atividade->hora_inicio >= $dados_inscricao->hora_final &&
						   $atividade->hora_final > $dados_inscricao->hora_inicio && $atividade->hora_final > $dados_inscricao->hora_final)))
					{
						$verfifica_horario = $verfifica_horario;
					}
					else{
						$verfifica_horario = FALSE;
					}
				}
				if($verfifica_horario){
					$this->db->insert('inscricoes',array('id_atividade'=>$id_atividade,'id_participante' => $this->session->userdata('id')));
					echo '<script type="text/javascript">alert("Inscrição Realizada com sucesso!");window.location.href=\''.base_url().'sist/form_inscricao/\';
    				</script>';
					//echo  "<script>alert('Inscrição Realizada com sucesso!');</script>";
					//redirect('/sist/form_inscricao/', 'refresh');	
				}
				else{
					echo '<script type="text/javascript">alert("Você já está inscrito num curso com data e horários conscidentes com este!");window.location.href=\''.base_url().'sist/form_inscricao/\';
    				</script>';
					//echo  "<script>alert('Você já está inscrito num curso com data e horários conscidentes com este!');</script>";
					//redirect('/sist/form_inscricao/', 'refresh');
					//die();
				}
			}
		}
	}
	public function minhas_inscricoes() {
		$this->load->helper('date');
		$data['inscricoes'] ="";
		/*$this->db->select('id');
		$this->db->from('inscricoes');
		$this->db->where('id_participante',$this->session->userdata('id'));
		if($this->db->get()->num_rows()>0){
			$data['inscricoes']= "<tr><td>CERTIFICADO DE PARTICIPAÇÃO GERAL</td><td align=\"center\"></td><td align=\"center\"></td><td align=\"center\"></td><td>".anchor('sist/gera_certificados/43/'.$this->session->userdata('id'), 'Gerar Certificado', array('class' => 'btn btn-success btn-xs'))."</td></tr>".$data['inscricoes'];
		}
		*/
		$this->db->select('atividade.*,inscricoes.*,inscricoes.id as id_inscricao');
		$this->db->from('inscricoes');
		$this->db->join('atividade', 'inscricoes.id_atividade = atividade.id');
		$this->db->order_by('atividade.data desc , atividade.hora_inicio desc');
		$this->db->where('id_participante',$this->session->userdata('id'));
		//$this->db->order_by('hora_inicial','desc');
		$inscricoes = $this->db->get()->result();
		//$data['inscricoes'] ="";
		foreach ($inscricoes as $inscricao){
			$stringdedata = "%d/%m/%Y";
			$inscricao->data = mdate($stringdedata, strtotime($inscricao->data));
			if($inscricao->participou == 1){
				$data['inscricoes']= "<tr><td>".$inscricao->nome."</td><td align=\"center\">".$inscricao->data."</td><td align=\"center\">".substr($inscricao->hora_inicio, 0,5)
			."</td><td align=\"center\">".substr($inscricao->hora_final, 0,5)."</td><td>".anchor('sist/gera_certificados/'.$inscricao->id_atividade.'/'.$inscricao->id_participante, 'Gerar Certificado', array('class' => 'btn btn-success btn-xs'))."</td></tr>".$data['inscricoes'];
			}else{
			$data['inscricoes']= "<tr><td>".$inscricao->nome."</td><td align=\"center\">".$inscricao->data."</td><td align=\"center\">".substr($inscricao->hora_inicio, 0,5)
			."</td><td align=\"center\">".substr($inscricao->hora_final, 0,5)."</td><td><button type='button' class='btn btn-danger btn-xs' disabled='disabled'>Participação não confirmada</button></td></tr>".$data['inscricoes'];
			}
		}
		$data['conteudo'] = 'sist/minhas_inscricoes';
		$this->load->view('tplsist', $data);
	}
	public function relatorio_inscricoes() {
		//seleciona todos as inscrições cadastradas, fazendo um inner join com as tabelas participante e atividade
		$this->db->select('atividade.*,inscricoes.status,inscricoes.id as id_inscricao,participante.nome as nomeparticipante');
		$this->db->from('inscricoes');
		$this->db->join('atividade', 'inscricoes.id_atividade = atividade.id');
		$this->db->join('participante', 'inscricoes.id_participante = participante.id');
		$inscricoes = $this->db->get()->result();
		$data['inscricoes'] ="";
		//percorre o array resultante do select e monta a tabela de inscrições
		foreach ($inscricoes as $inscricao){
			$stringdedata = "d/m/Y";
			$inscricao->data = date($stringdedata, strtotime($inscricao->data));
			
			$data['inscricoes']= "<tr><td>".$inscricao->nomeparticipante."</td><td>".$inscricao->nome."</td><td align=\"center\">".$inscricao->data."</td><td align=\"center\">".substr($inscricao->hora_inicio, 0,5)
			."</td><td align=\"center\">".substr($inscricao->hora_final, 0,5)."</td><td align=\"center\">".anchor('sist/deleta_inscricao_relatorio/'.$inscricao->id_inscricao, 'Deletar Inscrição', array('class' => 'btn btn-danger btn-xs','onclick'=>"return excluir()"))."</td></tr>".$data['inscricoes'];
		}
		//seleciona todos os participantes cadastrados
		$this->db->select('*');
		$this->db->from('participante');
		$participantes = $this->db->get()->result();
		$data['conteudo'] = 'sist/relatorio_inscricoes';
		$this->load->view('tplsist', $data);
	}
	public function relatorio_participantes() {
		//seleciona todos os participantes cadastrados
		$this->db->select('*');
		$this->db->from('participante');
		$participantes = $this->db->get()->result();
		//percorre o array resultante do select e monta a tabela de participantes
		$data['participantes'] ="";
		foreach ($participantes as $participante){
			$data['participantes']= "<tr><td>".$participante->nome."</td><td>".$participante->cpf."</td><td align=\"center\">".$participante->email."</td><td align=\"center\">".$participante->telefone
			."</td><td align=\"center\">".$participante->ocupacao."</td><td align=\"center\">".anchor('sist/deleta_participante/'.$participante->id, 'Deletar Participante', array('class' => 'btn btn-danger btn-xs',
			'onclick'=>'return excluir()')).anchor('sist/torna_administrador/'.$participante->id, 'Tornar ADM', array('class' => 'btn btn-warning btn-xs')).
			anchor('sist/reseta_senha/'.$participante->id, 'Resetar Senha', array('class' => 'btn btn-info btn-xs')).
			"</td></tr>".$data['participantes'];
		}
		
		$data['conteudo'] = 'sist/relatorio_participantes';
		$this->load->view('tplsist', $data);
	}

	public function deleta_inscricao_relatorio($id) {
		$this->db->where('id', $id);
		if($this->db->delete('inscricoes')){
			//echo  "<script>alert('Inscrição deletada com sucesso!');</script>";
			//redirect('/sist/relatorio_inscricoes/', 'refresh');
			//die();
			echo '<script type="text/javascript">alert("Inscrição deletada com sucesso!");window.location.href=\''.base_url().'sist/relatorio_inscricoes/\';
    		</script>';
		}
	}
	public function deleta_inscricao_minhas_inscricoes($id) {
		$this->db->where('id', $id);
		if($this->db->delete('inscricoes')){
			//echo  "<script>alert('Inscrição deletada com sucesso!');</script>";
			 echo '<script type="text/javascript">alert("Inscrição deletada");window.location.href=\''.base_url().'sist/minhas_inscricoes/\';
    		</script>';
			//redirect('/sist/minhas_inscricoes/');
			//die();
		}
	}
	public function deleta_participante($id) {
		$this->db->where('id', $id);
		if($this->db->delete('participante')){
			//echo  "<script>alert('Participante deletado com sucesso!');</script>";
			//redirect('/sist/relatorio_participantes/', 'refresh');
			//die();
			 echo '<script type="text/javascript">alert("Participante deletado com sucesso!");window.location.href=\''.base_url().'sist/relatorio_participantes/\';
    		</script>';
		}
	}
	public function torna_administrador($id) {
		//$this->db->update('participante', array('status'=> 1), array('id' => $id));
		if($this->db->update('participante', array('status'=> 2), array('id' => $id))){
			//echo  "<script>alert('Participante alterado com sucesso!');</script>";
			//redirect('/sist/relatorio_participantes/', 'refresh');
			//die();
			echo '<script type="text/javascript">alert("Participante alterado com sucesso!");window.location.href=\''.base_url().'sist/relatorio_participantes/\';
    		</script>';
		}
	}
	public function reseta_senha($id) {
		//$this->db->update('participante', array('status'=> 1), array('id' => $id));
		if($this->db->update('participante', array('resetasenha'=> 1, 'senha'=>'20e7cc4213f0e19a7e907435eb2ca44a'), array('id' => $id))){
			//echo  "<script>alert('Senha resetada com sucesso!');</script>";
			//redirect('/sist/relatorio_participantes/', 'refresh');
			//die();
			echo '<script type="text/javascript">alert("Senha resetada com sucesso!");window.location.href=\''.base_url().'sist/relatorio_participantes/\';
    		</script>';
		}
	}
	public function atualiza_senha() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmsenha]',array('required' => "O campo %s é obrigatório", 'matches' => "Senha e Confirmação de Senha não coincidem"));
		$this->form_validation->set_rules('confirmsenha', 'Confirmação de Senha', 'required',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_error_delimiters('<p class="bg-danger text-danger" align="center">', '</p>');
		if ($this->form_validation->run() == FALSE)
        {
        	$data['conteudo'] = 'sist/cadastro_participante';
			$this->load->view('tpllogin', $data);
        }
		else{
			if($this->db->update('participante', array('resetasenha'=> 0, 'senha'=>md5($_POST['senha'])), array('id' => $_POST['id']))){
				echo '<script type="text/javascript">alert("Senha atualizada com sucesso!");window.location.href=\''.base_url().'sist/home_sist/\';
    		</script>';
			//echo  "<script>alert('Senha atualizada com sucesso!');</script>";
			//redirect('/sist/home_sist/', 'refresh');
			//die();
			}
		}
	}
	public function cadastros() {
		$data['conteudo'] = 'sist/cadastros';
		$this->load->view('tplsist', $data);
	}

	public function crachas_participantes() {
		/*
			function geraCodigoBarra($numero){
			$fino = 2;
			$largo = 4;
			$altura = 80;
			
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
			
			for($f1 = 9; $f1 >= 0; $f1--){
				for($f2 = 9; $f2 >= 0; $f2--){
					$f = ($f1*10)+$f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
			}
			
			echo '<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			
			echo '<img ';
			
			$texto = $numero;
			
			if((strlen($texto) % 2) <> 0){
				$texto = '0'.$texto;
			}
			
			while(strlen($texto) > 0){
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
				
				if(isset($barcodes[$i])){
					$f = $barcodes[$i];
				}
				
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
	  					$f1 = $fino ;
	  				}else{
	  					$f1 = $largo ;
	  				}
	  				
	  				echo 'src="'.base_url().'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
	  				echo '<img ';
	  				
	  				if(substr($f, $i, 1) == '0'){
						$f2 = $fino ;
					}else{
						$f2 = $largo ;
					}
					
					echo 'src="'.base_url().'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
					echo '<img ';
				}
			}
			echo 'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
		}
		*/
		function geraCodigoBarra($numero){
			$fino = 2;
			$largo = 4;
			$altura = 80;
			
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
			
			for($f1 = 9; $f1 >= 0; $f1--){
				for($f2 = 9; $f2 >= 0; $f2--){
					$f = ($f1*10)+$f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
			}
			$barcode ='';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			
			$barcode = $barcode.'<img ';
			
			$texto = $numero;
			
			if((strlen($texto) % 2) <> 0){
				$texto = '0'.$texto;
			}
			
			while(strlen($texto) > 0){
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
				
				if(isset($barcodes[$i])){
					$f = $barcodes[$i];
				}
				
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
	  					$f1 = $fino ;
	  				}else{
	  					$f1 = $largo ;
	  				}
	  				
	  				$barcode = $barcode.'src="'.base_url().'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0" />';
	  				$barcode = $barcode.'<img ';
	  				
	  				if(substr($f, $i, 1) == '0'){
						$f2 = $fino ;
					}else{
						$f2 = $largo ;
					}
					
					$barcode = $barcode.'src="'.base_url().'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0" />';
					$barcode = $barcode.'<img ';
				}
			}
			//$barcode = 'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />'.$barcode;
			$barcode = $barcode.'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
			return $barcode;
		}
		$this->db->select('b.status,b.id, b.nome, b.cpf, a.id_participante,c.nome as nomecidade,d.uf,e.nomeprofissao');
		$this->db->distinct('id_participante');
		$this->db->from('inscricoes as a');
		$this->db->join('participante as b', 'a.id_participante = b.id');
		$this->db->join('cidade as c', 'c.id = b.cidade');
		$this->db->join('estado as d', 'd.id = c.estado');
		$this->db->join('profissoes as e', 'e.idprofissao = b.ocupacao');
		$this->db->where('b.status = 0');
		$this->db->order_by('b.nome desc');
		$crachas = $this->db->get()->result();
		$data['inscricoes'] ="";
		foreach ($crachas as $cracha){
			$cracha->nome = explode(' ',$cracha->nome);
			$contanome = count($cracha->nome);
			if ($cracha->nome[$contanome-1]==""){
				$cracha->nome = $cracha->nome[0]." ".$cracha->nome[$contanome-2];
			}
			else{
				$cracha->nome = $cracha->nome[0]." ".$cracha->nome[$contanome-1];
			}
			
				$data['inscricoes'] = "<div style=\"float: left; margin: 0 0 25 9\">
				<div id=\"barcode\">".geraCodigoBarra($cracha->id)."</div>
				<img id=\"imagem\" src=".base_url()."assets/images/cracha_participante.jpg \" />	
				<div id=\"textonome\"><strong>".$cracha->nome."</strong></div>
				<div id=\"textocidade\"><strong>".$cracha->nomecidade.' - '.$cracha->uf."</strong></div>
				<div id=\"textoprofissao\"><strong>".$cracha->nomeprofissao."</strong></div>		
				<div id=\"cpf\"><strong>".$cracha->id."</strong></div>
				</div>".$data['inscricoes'];	
		}
		
		$this->load->view('sist/crachas', $data);
	}
	public function crachas_organizacao() {
		/*
			function geraCodigoBarra($numero){
			$fino = 2;
			$largo = 4;
			$altura = 80;
			
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
			
			for($f1 = 9; $f1 >= 0; $f1--){
				for($f2 = 9; $f2 >= 0; $f2--){
					$f = ($f1*10)+$f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
			}
			
			echo '<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			
			echo '<img ';
			
			$texto = $numero;
			
			if((strlen($texto) % 2) <> 0){
				$texto = '0'.$texto;
			}
			
			while(strlen($texto) > 0){
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
				
				if(isset($barcodes[$i])){
					$f = $barcodes[$i];
				}
				
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
	  					$f1 = $fino ;
	  				}else{
	  					$f1 = $largo ;
	  				}
	  				
	  				echo 'src="'.base_url().'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
	  				echo '<img ';
	  				
	  				if(substr($f, $i, 1) == '0'){
						$f2 = $fino ;
					}else{
						$f2 = $largo ;
					}
					
					echo 'src="'.base_url().'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
					echo '<img ';
				}
			}
			echo 'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="'.base_url().'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
		}
		*/
		function geraCodigoBarra($numero){
			$fino = 2;
			$largo = 4;
			$altura = 80;
			
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
			
			for($f1 = 9; $f1 >= 0; $f1--){
				for($f2 = 9; $f2 >= 0; $f2--){
					$f = ($f1*10)+$f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
			}
			$barcode ='';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			
			$barcode = $barcode.'<img ';
			
			$texto = $numero;
			
			if((strlen($texto) % 2) <> 0){
				$texto = '0'.$texto;
			}
			
			while(strlen($texto) > 0){
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
				
				if(isset($barcodes[$i])){
					$f = $barcodes[$i];
				}
				
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
	  					$f1 = $fino ;
	  				}else{
	  					$f1 = $largo ;
	  				}
	  				
	  				$barcode = $barcode.'src="'.base_url().'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0" />';
	  				$barcode = $barcode.'<img ';
	  				
	  				if(substr($f, $i, 1) == '0'){
						$f2 = $fino ;
					}else{
						$f2 = $largo ;
					}
					
					$barcode = $barcode.'src="'.base_url().'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0" />';
					$barcode = $barcode.'<img ';
				}
			}
			//$barcode = 'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />'.$barcode;
			$barcode = $barcode.'src="'.base_url().'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			$barcode = $barcode.'<img src="'.base_url().'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
			return $barcode;
		}
		$this->db->select('a.status,a.id, a.nome, a.cpf, c.nome as nomecidade,d.uf,e.nomeprofissao');
		$this->db->distinct('id_participante');
		$this->db->from('participante as a');
		//$this->db->join('participante as b', 'a.id_participante = b.id');
		$this->db->join('cidade as c', 'c.id = a.cidade');
		$this->db->join('estado as d', 'd.id = c.estado');
		$this->db->join('profissoes as e', 'e.idprofissao = a.ocupacao');
		$this->db->where('a.status = 1 or a.status=2');
		$this->db->order_by('a.nome desc');
		$crachas = $this->db->get()->result();
		$data['inscricoes'] ="";
		foreach ($crachas as $cracha){
			$cracha->nome = explode(' ',$cracha->nome);
			$contanome = count($cracha->nome);
			if ($cracha->nome[$contanome-1]==""){
				$cracha->nome = $cracha->nome[0]." ".$cracha->nome[$contanome-2];
			}
			else{
				$cracha->nome = $cracha->nome[0]." ".$cracha->nome[$contanome-1];
			}
			
				$data['inscricoes'] = "<div style=\"float: left; margin: 0 0 25 9\">
				<div id=\"barcode\">".geraCodigoBarra($cracha->id)."</div>
				<img id=\"imagem\" src=".base_url()."assets/images/cracha_organização.jpg \" />		
				<div id=\"textonome\"><strong>".$cracha->nome."</strong></div>
				<div id=\"textocidade\"><strong>".$cracha->nomecidade.' - '.$cracha->uf."</strong></div>
				<div id=\"textoprofissao\"><strong>".$cracha->nomeprofissao."</strong></div>						
				<div id=\"cpf\"><strong>".$cracha->id."</strong></div>
				</div>".$data['inscricoes'];
				
		}
		
		$this->load->view('sist/crachas', $data);
	}
	public function cadastra_atividade()
	{
		$this->load->library('form_validation');
        //$this->form_validation->set_rules('nome', 'Nome ', 'required|is_unique[membership.username]',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('nome', 'Nome ', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('hora_inicio', 'Hora de Inicio', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('hora_final', 'Hora de Final', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('data', 'Data', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('tipo', 'Tipo', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		$this->form_validation->set_rules('palestrante', 'Palestrante', 'required|prep_for_form',array('required' => "O campo %s é obrigatório"));
		//$this->form_validation->set_rules('hora_inicio', 'V&iacute;nculo', 'required',array('required' => "O campo %s é obrigatório"));
        $this->form_validation->set_error_delimiters('<p class="bg-danger text-danger" align="center">', '</p>');
 		
		if ($this->form_validation->run() == FALSE)
        {
        	$data['conteudo'] = 'sist/cadastros';
			$this->load->view('tplsist', $data);
        }
		else{
		$this->load->model("atividades_model");// chama o modelo usuarios_model
		
	       if($this->atividades_model->insereAtividade()){
	       		
				//echo  "<script>alert('Inscrição realizada com sucesso!');</script>";
				//redirect('/sist/cadastros', 'refresh');
				//die();
				echo '<script type="text/javascript">alert("Inscrição realizada com sucesso!");window.location.href=\''.base_url().'sist/cadastros\';</script>';
			}else {
				echo  "<script>alert('Aconceteu um erro no cadastro, tente novamente!');</script>";
				$data['conteudo'] = 'sist/cadastros';
				$this->load->view('tplsist', $data);
			}
		}	
		//$data['conteudo'] = 'sist/cadastros';
		//$this->load->view('tplsist', $data);
	}
	public function envia_email()
	{
		$teste = 60051095378;
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('coordenacao@sempreifpi.com', 'Coordenação SEMPREIFPI');
		$this->email->to('valter.cavalcante@ifpi.edu.br');
		
		//$this->email->cc('victor.menezes@ifpi.edu.br');
		//$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email de teste');
		$this->email->message('<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
 <tr>
  <td>
  	<img src="http://www.sempreifpi.com/sigev/assets/images/feira-do-empreendedor-2016-400.png" alt="LOGO SEMPREIFPI" width="400" height="110" style="display: block;" />
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
   	CPF:'.$teste.'
   </td>
  </tr>
  <tr>
   <td>
   SENHA:
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
		
		$this->email->send();
		echo "email enviado-----------------------";
		echo $this->email->print_debugger(); 
	}
	public function escolhe_atividade()
	{
		$this->load->helper('date');
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->order_by('data desc , hora_inicio desc');
		$atividades = $this->db->get()->result();
		$data['atividades'] = "";
		foreach ($atividades as $atividade){
			//$botao = '<button type="button" class="btn btn-success btn-sm">Cadastrar Confirmações</button>';
			$botao =  anchor('sist/lista_de_confirmacao/'.$atividade->id, 'Cadastrar Confirmações', array('class' => 'btn btn-success btn-xs'));
			$stringdedata = "d/m/Y";
			$atividade->data = date($stringdedata, strtotime($atividade->data));
			//$dtcurso = date($stringdedata, $minicurso->data);
			$data['atividades']= "<tr><td>".$atividade->nome."</td><td>".$atividade->palestrante."</td><td align=\"center\">".$atividade->data."</td><td align=\"center\">".substr($atividade->hora_inicio, 0,5).
			"</td><td align=\"center\">".substr($atividade->hora_final, 0,5)."</td><td>".$botao."</td></tr>".$data['atividades'];		
		}
		$data['conteudo'] = 'sist/escolhe_atividade';
		$this->load->view('tplsist', $data);
	}
	public function lista_de_confirmacao($id_atividade)
	{
		$this->load->helper('date');
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('id',$id_atividade);
		$atividade = $this->db->get()->row();
		$stringdedata = "d/m/Y";
		$atividade->data = date($stringdedata, strtotime($atividade->data));
		$data['atividade'] =  $atividade->nome." ".$atividade->palestrante." ".$atividade->data;
		$data['id_atividade'] = $id_atividade;
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->order_by('nome desc');
		$participantes = $this->db->get()->result();
		$data['participantes'] = "";
		foreach ($participantes as $participante){
			$this->db->select('*');
			$this->db->from('inscricoes');
			$this->db->where('id_atividade',$id_atividade);
			$this->db->where('id_participante',$participante->id);
			$this->db->where('participou',1);
			$inscricao = $this->db->get()->row();
			if($inscricao){//verifica se já tem a inscrição no curso e está com a inscrição confirmada
				$data['participantes']= "<tr><td><div class='checkbox '><label><input checked type='checkbox' name='participantes[]' value='".$participante->id."'>".$participante->nome."</label> </div></td><td>".$participante->cpf."</td></tr>".$data['participantes'];
			}
			else{
				$data['participantes']= "<tr><td><div class='checkbox'><label><input type='checkbox' name='participantes[]' value='".$participante->id."'>".$participante->nome."</label> </div></td><td>".$participante->cpf."</td></tr>".$data['participantes'];		
			}		
		}
		$data['conteudo'] = 'sist/lista_de_confirmacao';
		$this->load->view('tplsist', $data);
	}
	public function confirma_presenca()
	{
		$this->load->helper('date');
		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('id',$_POST['id_atividade']);
		$atividade = $this->db->get()->row();
		$stringdedata = "d/m/Y";
		$atividade->data = date($stringdedata, strtotime($atividade->data));
		$data['atividade'] =  $atividade->nome." - ".$atividade->palestrante." - ".$atividade->data;
		$data['numero_de_confirmacoes'] = 0;
		$data['participantes'] = '';
		$this->db->update('inscricoes', array('participou'=> 0), array('id_atividade' => $_POST['id_atividade']));
		if(!empty($_POST['participantes'])) {
	    	foreach($_POST['participantes'] as $participante) {
	    		$this->db->select('id, nome');
				$this->db->from('participante');
				$this->db->where('id',$participante);
				$participantes = $this->db->get()->row();
				$data['participantes'] = "<tr><td>".$participantes->id."</td><td>".$participantes->nome."</td></tr>".$data['participantes'];
	        	$this->db->select('*');
				$this->db->from('inscricoes');
				$this->db->where('id_atividade',$_POST['id_atividade']);
				$this->db->where('id_participante',$participante);
				$inscricao = $this->db->get()->row();
				if($inscricao){//verifica se já tem a inscrição no curso
					if($this->db->update('inscricoes', array('participou'=> 1), array('id_atividade' => $_POST['id_atividade'],'id_participante' => $participante))){
							$data['numero_de_confirmacoes']++;
					}else{
						echo "ocorreu um problema com a confirmação do participante codigo = ".$participante;
					}
				}else{
					if($this->db->insert('inscricoes',array('id_atividade'=>$_POST['id_atividade'],'id_participante' => $participante, 'participou'=> 1))){
							$data['numero_de_confirmacoes']++;
					}else{
						echo "ocorreu um problema com a confirmação do participante codigo = ".$participante;
					}
				}
	    	}
		}
		$data['conteudo'] = 'sist/confirmacao_de_participacao';
		$this->load->view('tplsist', $data);	
	}

	public function gera_certificados($id_atividade,$id_participante)
	{
		//$this->load->helper('date');
		$this->db->select('nome');
		$this->db->from('participante');
		$this->db->where('id',$id_participante);
		$participante = $this->db->get()->row();

		$this->db->select('*');
		$this->db->from('atividade');
		$this->db->where('id',$id_atividade);
		$atividade = $this->db->get()->row();
		
		$this->db->select('*');
		$this->db->from('inscricoes');
		$this->db->where('id_atividade',$id_atividade);
		$this->db->where('id_participante',$id_participante);
		$inscricoes = $this->db->get()->row();
		switch ($atividade->tipo) {
			case 0:
				$texto = "Certificamos que ".$participante->nome." participou da I Semana de Empreendedorismo do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí.";
    		break;
    		case 1:
        		$texto = "Certificamos que ".$participante->nome." participou da palestra ". $atividade->nome. ", no I SEMPREIFPI do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí, com carga horária de ".$atividade->carga_horaria."h/a.";
        	break;
    		case 2:
        		$texto = "Certificamos que ".$participante->nome." participou da mini-curso ". $atividade->nome. ", no I SEMPREIFPI do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí, com carga horária de ".$atividade->carga_horaria."h/a.";
        	break;
    		case 3:
        		$texto = "Certificamos que ".$participante->nome." participou da oficina ". $atividade->nome. ", no I SEMPREIFPI do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí, com carga horária de ".$atividade->carga_horaria."h/a.";
        	break;
        	case 4:
				$texto = "Certificamos que ".$participante->nome." participou da ORGANIZAÇÃO da I Semana de Empreendedorismo do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí, com carga horária de ".$atividade->carga_horaria."h.";
    		break;
		}
		$data['certificado']="";
		//$texto = "Certificamos que ".$participante->nome." participou da palestra ". $atividade->nome. ", no I SEMPREIFPI do Instituto Federal do Piauí realizado de 23 a 25 de novembro de 2016, no campus Valença do Piauí, com carga horária de 2h/a.";
		$textoverso = "Registro de Certificado Nº ". $inscricoes->numero. " <br /> Livro ". $inscricoes->livro. ", Fls ". $inscricoes->folha. ", Data: 30/11/2016 ";
		$data['certificado'] = "<div>
				<img id=\"imagem\" src=".base_url()."assets/images/certificado_frente.jpg \" />	
				<div id=\"textofrente\"><strong>".$texto."</strong></div>
				</div>
				<div>
				<img id=\"imagem\" src=".base_url()."assets/images/certificado_verso.jpg \" />	
				<div id=\"textoverso\"><strong>".$textoverso."</strong></div>
				</div>".$data['certificado'];
		$this->load->view('sist/certificados', $data);	
	}
	public function ler_certificados()
	{
		$delimitador = ';';
		$cerca = '"';
 			
		// Abrir arquivo para leitura
		$f = fopen(base_url().'assets/arquivos/participantes_certificado_SEMPREIFPI2016.csv', 'r');
		if ($f) {
	    	// Enquanto nao terminar o arquivo
		    while (!feof($f)) {
		 
		        // Ler uma linha do arquivo
		        $linha = fgetcsv($f, 0, $delimitador, $cerca);
		        if (!$linha) {
		            continue;
		        }
				$this->db->select('id');
				$this->db->from('partipante');
				$this->db->where('cpf',$linha[1]);
		        // Montar registro com valores indexados
		        echo "essa é a linha ".$linha[1]." do ".$linha[4]."<br />";
		 		if($this->db->update('inscricoes', array('numero'=> $linha[4], 'livro'=> $linha[5], 'folha'=> $linha[6]), array('id' => $linha[0]))){
		 			echo "essalinha ".$linha[0]." do ".$linha[1]." Foi alterada <br />";
				}
				else{
					echo "essa linha ".$linha[0]." do ".$linha[1]." Deu problemas <br />";
				}
	    	}
    	fclose($f);
		}
	}
	public function ler_certificados_geral()
	{
		$delimitador = ';';
		$cerca = '"';
 			
		// Abrir arquivo para leitura
		$f = fopen(base_url().'assets/arquivos/certificados_geral.csv', 'r');
		if ($f) {
	    	// Enquanto nao terminar o arquivo
		    while (!feof($f)) {
		 
		        // Ler uma linha do arquivo
		        $linha = fgetcsv($f, 0, $delimitador, $cerca);
		        if (!$linha) {
		            continue;
		        }
				
				$this->db->select('id');
				$this->db->from('participante');
				$this->db->where('cpf',$linha[0]);
				$participante = $this->db->get()->row();
		        // Montar registro com valores indexados
		        //echo "isert em inscricoes id_participante ".$linha[0]." do numero".$linha[1]."livro". $linha[2]."folha".$linha[3]."<br />";
		 		if($this->db->insert('inscricoes',array('id_atividade'=>43,'id_participante' => $participante->id,'numero'=> $linha[1], 'livro'=> $linha[2], 'folha'=> $linha[3]))){
		 			echo "inserindo ".$linha[0]." do ".$participante->id." Foi alterada <br />";
				}
				else{
					echo "inserindo ".$linha[0]." do ".$participante->id."Deu problemas <br />";
				}
	    	}
    	fclose($f);
		}
	}
	public function ler_certificados_organizacao()
	{
		$delimitador = ';';
		$cerca = '"';
 			
		// Abrir arquivo para leitura
		$f = fopen(base_url().'assets/arquivos/certificados_organizacao2.csv', 'r');
		if ($f) {
	    	// Enquanto nao terminar o arquivo
		    while (!feof($f)) {
		 
		        // Ler uma linha do arquivo
		        $linha = fgetcsv($f, 0, $delimitador, $cerca);
		        if (!$linha) {
		            continue;
		        }
				
				$this->db->select('id');
				$this->db->from('participante');
				$this->db->where('cpf',$linha[0]);
				$participante = $this->db->get()->row();
		        // Montar registro com valores indexados
		        //echo "isert em inscricoes id_participante ".$linha[0]." do numero".$linha[1]."livro". $linha[2]."folha".$linha[3]."<br />";
		 		if($this->db->insert('inscricoes',array('id_atividade'=>44,'id_participante' => $participante->id,'numero'=> $linha[1], 'livro'=> $linha[2], 'folha'=> $linha[3]))){
		 			echo "inserindo ".$linha[0]." do ".$participante->id." Foi alterada <br />";
				}
				else{
					echo "inserindo ".$linha[0]." do ".$participante->id."Deu problemas <br />";
				}
	    	}
    	fclose($f);
		}
	}
}
	

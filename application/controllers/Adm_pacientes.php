<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_pacientes extends MY_Controller {
    
    function __construct(){
      parent::__construct();
      $this->load->model('M_pacientes');
      $this->load->model('M_select');
      $this->load->library('url_amiga');
    }
    
    public function index(){
        $data['title'] = "Pacientes - Clínica";
        $data['pagina'] = "Pacientes";
       
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/pacientes/v_pacientes', $data);
        $this->load->view('admin/headers/v_footer');
        
        
    }
    
    public function ajax_list()
        {
        $list = $this->M_pacientes->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $rows->id_paciente;
            $row[] = $rows->nome_paciente;
            $row[] = $rows->cpf_paciente;
            $row[] = $rows->bairro_paciente;
            $row[] = '<a class="btn btn-success" href="'.base_url().'adm_pacientes/edit/'.$rows->id_paciente.'"> Editar</a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_pacientes->count_all(),
                        "recordsFiltered" => $this->M_pacientes->count_filtered(),
                        "data" => $data,
                );
       echo json_encode($output);
    }
      
    
    public function ajax_cep($cep){
        $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
        echo file_get_contents($url, FALSE);
    }
    
    public function valida_cpf($cpf){
        if($this->validaCPF($cpf)){
            $data = array( 'retorno_cpf' =>'true');
        }
        else{
            $data = array( 'retorno_cpf' =>'false');
        }
        $this->output
           ->set_output(json_encode($data));   
        }
    function validaCPF($cpf = null) {
  if($cpf){
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true;
  }else{
      return false;
  }
}
    
    public function novo_paciente(){
        $data['title'] = "Pacientes - Clinica";
        $data['pagina'] = "Novo Paciente";
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/pacientes/v_add_paciente', $data);
        
        $this->load->view('admin/headers/v_footer');
    }
    
    public function edit($id){
        $data['title'] = "Artigo - Clínica";
        $data['pagina'] = "Edição de Artigos";
        
        $result = $this->M_pacientes->get_paciente_id($id);
        
        $data['id_paciente'] = $result->row()->id_paciente;
        $data['nome_paciente'] = $result->row()->nome_paciente;
        $data['nasc_paciente'] = $result->row()->nasc_paciente;
        $data['mae_paciente'] = $result->row()->mae_paciente;
        $data['cpf_paciente'] = $result->row()->cpf_paciente;
        $data['cns_paciente'] = $result->row()->cns_paciente;
        $data['end_paciente'] = $result->row()->end_paciente; 
        $data['num_paciente'] = $result->row()->num_paciente;
        $data['cep_paciente'] = $result->row()->cep_paciente;
        $data['bairro_paciente'] = $result->row()->bairro_paciente;
        $data['cidade_paciente'] = $result->row()->cidade_paciente;
        $data['estado_paciente'] = $result->row()->estado_paciente;
        $data['info_paciente'] = $result->row()->info_paciente;
        $data['foto_paciente'] = $result->row()->foto_paciente;
        
        
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/pacientes/v_add_paciente', $data);
        $this->load->view('admin/headers/v_footer');
    }
    
    public function store(){
        $id = $this->input->post('id_paciente');
        $nome = $this->input->post('nome_paciente');
        $nascimento = $this->input->post('nasc_paciente');
        $mae = $this->input->post('mae_paciente');
        $cpf = $this->input->post('cpf_paciente');
        $cns = $this->input->post('cns_paciente');
        $end = $this->input->post('end_paciente');
        $num = $this->input->post('num_paciente');
        $cep = $this->input->post('cep_paciente');
        $bairro = $this->input->post('bairro_paciente');
        $cidade = $this->input->post('cidade_paciente');
        $estado = $this->input->post('estado_paciente');
        $info = $this->input->post('info_paciente');
        $foto = $this->input->post('foto_paciente');
        
        
        
        $dados = array(
           'nome_paciente' => $nome,
           'nasc_paciente' => $nascimento,
           'mae_paciente' =>$mae,
           'cpf_paciente' => $cpf,
           'cns_paciente' => $cns,
           'end_paciente' => $end,
           'num_paciente' => $num,
           'cep_paciente' => $cep,
           'bairro_paciente' => $bairro,
            'cidade_paciente' => $cidade,
            'estado_paciente' => $estado,
            'info_paciente' => $info,
            'foto_paciente' => $foto,
            'cadastro_paciente' => date('Y-m-d'),
        );
        if(!empty($id)){
            unset($dados['cadastro_paciente']);
        }
        
        
        if($this->M_pacientes->store($dados, $id)){
         echo '<script>alert("Salvo com sucesso!"), history.go(-2);</script>'  ; 
        }
        else{
            echo '<script>alert("Erro ao salvar"), history.go(-1);</script>'  ;  
        }
                
    }
 }
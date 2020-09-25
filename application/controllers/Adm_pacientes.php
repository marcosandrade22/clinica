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
        
        $result = $this->M_artigos->getuartigos_id($id);
        
        $data['id_artigo'] = $id;
        $data['titulo_artigo'] = $result->row()->titulo_artigo;
        $data['texto_artigo'] = $result->row()->texto_artigo;
        $data['imagem_artigo'] = $result->row()->imagem_artigo;
        $data['status_artigo'] = $result->row()->status_artigo;
        $data['destaque_artigo'] = $result->row()->destaque_artigo;
        $data['categoria'] = $result->row()->categoria_artigo;
        
        $data['categorias'] = $this->M_artigos->getcategorias()->result();
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/artigos/v_add_artigos', $data);
        $this->load->view('admin/headers/v_footer');
    }
    
    public function store(){
        $id = $this->input->post('id_artigo');
        $titulo = $this->input->post('titulo_artigo');
        $texto = $this->input->post('texto_artigo');
        $imagem = $this->input->post('imagem_artigo');
        $categoria = $this->input->post('categoria_artigo');
        $status = $this->input->post('status_artigo');
        $destaque = $this->input->post('destaque_artigo');
        $url_amiga = $this->url_amiga->sanitize_title_with_dashes($this->input->post('titulo_artigo'));
        
        
        if(empty($id)){
        $dados = array(
           'titulo_artigo' => $titulo,
           'texto_artigo' => $texto,
           'imagem_artigo' =>$imagem,
           'status_artigo' => $status,
           'destaque_artigo' => $destaque,
           'categoria_artigo' => $categoria,
           'url_amiga' => $url_amiga,
           'data_criacao' => date('Y-m-d'),
           'usuario_artigo' => $this->session->userdata('ID'),
        );
        }
        else{
            $dados = array(
           'titulo_artigo' => $titulo,
           'texto_artigo' => $texto,
           'imagem_artigo' =>$imagem,
           'status_artigo' => $status,
            'destaque_artigo' => $destaque,
            'categoria_artigo' => $categoria,
            'url_amiga' => $url_amiga,
            );
        }
        
        if($this->M_artigos->store($dados, $id)){
         echo '<script>alert("Salvo com sucesso!"), history.go(-2);</script>'  ; 
        }
        else{
            echo '<script>alert("Erro ao salvar"), history.go(-1);</script>'  ;  
        }
                
    }
 }
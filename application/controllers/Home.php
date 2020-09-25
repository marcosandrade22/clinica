<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_home');
        $this->load->model('M_slides');
        $this->load->model('M_select');
       $this->load->helper('text');
        
    }
    
    public function index() {
        // FOR SI AND CKFINDER
        if (defined('REQUEST') && REQUEST === 'external') {
            return;
        }
        $data['title'] = "Home - Clínica";
        $data['noticias'] = $this->M_home->get_last_articles(3, 1);
        $data['destaques'] = $this->M_home->get_destaques(3);
        
        $data['slides'] = $this->M_slides->getslides()->result();
        $data['slides_id'] = $this->M_slides->getslides()->result();
       
        $this->load->view('site/headers/v_header.php', $data);
        $this->load->view('site/headers/v_menu.php', $data);
        $this->load->view('site/headers/v_slide.php', $data);
        $this->load->view('site/headers/v_home.php', $data);
       
        $this->load->view('site/headers/v_footer.php');
        //$this->load->view('site/v_home.php');
    }
    
    public function blog(){
        $data['title'] = "Blog - Clínica";
        $this->load->view('site/headers/v_header.php',$data);
        echo 'Blog ';
        $this->load->view('site/headers/v_footer.php');
    }
    
    
    
}

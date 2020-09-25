<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    
    function __construct(){
         parent::__construct();
       
    }
    public function index() {
        $data['title'] = "Dashboard - Clínica";
        $data['pagina'] = "Dashboard";
        
        $this->load->view('admin/headers/v_header', $data);
        
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        $this->load->view('admin/dashboard/v_pagina_dash', $data);
        $this->load->view('admin/headers/v_footer');
        
    }
    
}
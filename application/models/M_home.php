<?php

class M_home extends CI_Model{
    
     public function _construct(){
        
                // Call the CI_Model constructor
                parent::__construct();
        }
        
        
       public function get_last_articles($num, $cat){
           $this->db->limit($num);
           $this->db->where('status_artigo', 1);
           $this->db->where('categoria_artigo',$cat);
           $this->db->join('categorias', 'categorias.id_categoria=artigos.categoria_artigo');
           $query = $this->db->get('artigos');
           return $query;
       }
       
       public function get_destaques($num){
           $this->db->limit($num);
           $this->db->where('status_artigo', 1);
           $this->db->where('destaque_artigo',1);
           $this->db->join('categorias', 'categorias.id_categoria=artigos.categoria_artigo');
           $query = $this->db->get('artigos');
           return $query;
       }
        
        
}
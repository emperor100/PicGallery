<?php 
	class Home extends CI_Controller{
		
		public function __construct(){
			
			parent::__construct();
			session_start();
			
		}
	
		public function home_page($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header("location: /photogallery/login");
			exit;
			}
			
			$this->load->view('templates/header');
			$this->load->view('pages/home');
			$this->load->view('templates/footer');
			
			
		}
		
		public function get_shared_photos(){
			
			
			
		}
		
		
	}
?>



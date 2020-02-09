<?php 
	class Login extends CI_Controller{
		
		public function __construct(){
			
			parent::__construct();
			session_start();
			
		}
	
		public function login_form($page = 'login'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			
			if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: /photogallery/home");
			exit;
			}
			
			$this->load->view('templates/header');
			$this->load->view('pages/login');
			$this->load->view('templates/footer');
			
			
		}
		
		public function login_authenticate(){
			
			$username = $_POST["username"];
			$password = $_POST["password"];

			$this->load->database();
			$query = 'SELECT userid FROM users WHERE USERNAME = ? AND PASSWORD = ?';
			$result = $this->db->query($query, array($username, $password));

			$response = array();
			
			if($result->num_rows()){
				
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
				foreach($result->result() as $row)
					$_SESSION["userid"] = $row->userid;
                $_SESSION["username"] = $username;  
				$response['success'] = true;
				$response['message'] = "Redirecting you to Home";

			}
			
			else {
				
				$response['success'] = false;
				$response['message'] = "USERNAME/PASSWORD is Incorrect";
			}
			
			echo json_encode($response);
			//exit();
			
		}
		
		
		
		public function registration_form($page = 'register'){
			
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			
			
			$this->load->view('templates/header');
			$this->load->view('pages/register');
			$this->load->view('templates/footer');
			
			
		}
		
		public function register_user(){
			
			$this->load->database();
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$query = 'SELECT userid FROM users WHERE USERNAME = ?';
			$result = $this->db->query($query, array($username));
			
			$response = array();
			
			if($result->num_rows()==0)
			{
				
				$data = array(
					'USERNAME'=>$username,
					'PASSWORD'=>$password
				);

				$this->db->insert('users',$data);
				$response['success'] = true;
				$response['message'] = "User registered successfully.";

			}
			else {
				
				$response['success'] = false;
				$response['message'] = "User Name already exists";
			}
			echo json_encode($response);
			//exit();
			
		}
		
		
		
		public function logout(){			 
			// Unset all of the session variables
			$_SESSION = array();
			
			// Destroy the session.
			session_destroy();
			
			header("location: /photogallery/login");
			
		}	
		
	}
	
/*


1. CHhange the Controllers:
2. 
	a. Login
		[loginForm, loginSubmit]
	b. Home 
		[proper names]
		
	c. Album
	d. Photo
	
	
3. MY_Controller 
	Keep above in MY_Controller. 
	parent::__construct();
	
	Make hierarchy and call the session_start() one time.
	
	
4. Route problem  with ../PG/login in localhost/PG/login/form
	http://localhost/photogallery/photogallery/login
	
	
*/

?>



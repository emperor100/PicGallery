<?php 
	class Pages extends CI_Controller{
		
		public function view($page = 'login'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer');
			
			/*
			$data['notice'] = "This is passing through view hehe";
			
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');*/
			
		}
		
		// This can be in database.
		
		public function getSharedPhotos(){
			
			$this->load->database();
			// this needs to be corrected.
			$query = "SELECT S.imageid pid, P.photo_link plnk, S.shared_at shdat FROM sharedphotos S, photos P WHERE S.imageid = P.photoid"; 
			$result = $this->db->query($query);
			return $result;
			
		}
		public function getAlbums($userId){
			
				
			$this->load->database();
			// this needs to be corrected.
			$query = "SELECT * FROM albums WHERE userid = ?"; 
			$result = $this->db->query($query, array($userId));
			return $result;
			
		}
		public function home(){
			
			$sharedPhotos = $this->getSharedPhotos();
			$data['sharedPhotos'] = $sharedPhotos;
			$this->load->view('templates/header');
			$this->load->view('pages/home', $data);
			$this->load->view('templates/footer');
			
		}
		public function albums($id=-1){
			
			session_start();
			$result = $this->getAlbums($_SESSION["userid"]);
			$data['albums'] = $result;
			$this->load->view('templates/header');
			$this->load->view('pages/albums', $data);
			$this->load->view('templates/footer');
			
		}
		
		public function authenticateLogin(){
			
			$username = $_POST["username"];
			$password = $_POST["password"];
			/*
				$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
				$this->db->query($sql, array(3, 'live', 'Rick'));
			
			*/
			
			
			$this->load->database();
			$query = 'SELECT userid FROM users WHERE USERNAME = ? AND PASSWORD = ?';
			$result = $this->db->query($query, array($username, $password));
			
			if($result->num_rows())
			{
				session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
				foreach($result->result() as $row)
					$_SESSION["userid"] = $row->userid;
                $_SESSION["username"] = $username;  
                
                // Redirect user to home page.
				header("location: ../home");
			}
			
			$response = array();
			$response['success'] = false;
			$response['message'] = "USERNAME/PASSWORD is Incorrect";
			echo json_encode($response);
			exit();
			//$data['error'] = "Username/PASSWORD is incorect";
			//$this->load->view('pages/error', $data);
			//header("location: ../login");

			
			
			
		}
		
		public function addAlbum(){
		
			$this->load->database();
			session_start();
			$username = $_SESSION['username'];
			$userid = $_SESSION['userid'];
			$filename = $_FILES["photolink"]["name"];
			$albumname = $_POST["albumname"];
			$description = $_POST["description"];
			$newname = $username.'_'.$albumname.'_'.$filename;
			$targetPath = '../photos/'.$newname;
			
			
			//// PROBLEM : Photo can have a problem while uploading. If same user is creating another album name with same name and photo name also same.
			//// Solution: We can query the maximum AlbumID from ALBUMS and append +1 at the end and then perform the insert.
			// this can be again optimized to reduce the size or perform some opetations on image.
			move_uploaded_file($_FILES["photolink"]["tmp_name"], $targetPath);
			
			$albumData = array(
			
							'ALBUMNAME'=>$albumname,
							'USERID'=>$_SESSION["userid"],
							'DESCRIPTION'=>$description,
							'PHOTO_LINK'=>$newname
			
						);
			
			$this->db->insert('albums', $albumData);
			header("location: ../albums");
			
		}
		public function registerUser(){
			
			$this->load->database();
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$query = 'SELECT userid FROM users WHERE USERNAME = ?';
			$result = $this->db->query($query, array($username));
			
			if($result->num_rows()==0)
			{
				
				$data = array(
					'USERNAME'=>$username,
					'PASSWORD'=>$password
				);

				$this->db->insert('users',$data);
				header("location: ../login");
			}
			$data['error'] = "Failed to register user Try again";
			$this->load->view('pages/error', $data);
			
		}
		
		
		public function logout(){
			
			
			session_start();
 
			// Unset all of the session variables
			$_SESSION = array();
			
			// Destroy the session.
			session_destroy();
			
			header("location: ../photogallery/login");
			
		}
		
	}

?>
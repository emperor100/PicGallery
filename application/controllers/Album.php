<?php 
	class Album extends CI_Controller{
		
		public function __construct(){
			
			parent::__construct();
			session_start();
			
			
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header("location: /photogallery/login");
			exit;
			}
		}
	
		public function album_page($page = 'albums'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['albums'] = $this->get_albums();
			$this->load->view('templates/header');
			$this->load->view('pages/albums', $data);
			$this->load->view('templates/footer');
			
			
		}
		
		public function get_albums(){

			$this->load->database();
			
			$query = 'SELECT * FROM albums WHERE userid = ? ';
			$result = $this->db->query($query, array($_SESSION["userid"]));
			
			return $result;	
			
		}
		
		public function add_album(){
			
			$this->load->view('templates/header');
			$this->load->view('pages/addalbum');
			$this->load->view('templates/footer');
			
			
		}
		
		public function create_album(){
			
			$this->load->database();
			$username = $_SESSION['username'];
			$userid = $_SESSION['userid'];
			$filename = $_FILES["photolink"]["name"];
			$albumname = $_POST["albumname"];
			$description = $_POST["description"];
			$newname = $userid.'_'.$albumname.'_'.$filename;
			$targetPath = '../photogallery/static/photos/'.$newname;
			
			
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
			header("location: /photogallery/albums");
			
		}
		
		public function add_photo(){
			
			$data['album_id'] = $this->uri->segment(2);
			$this->load->view('templates/header');
			$this->load->view('pages/addphoto', $data);
			$this->load->view('templates/footer');
			
		}
		public function create_photo($albumId){
			
			$this->load->database();
			$username = $_SESSION['username'];
			$userid = $_SESSION['userid'];
			$filename = $_FILES["photolink"]["name"];
			$description = $_POST["description"];
			$newname = $userid.'_'.$albumId.'_'.$filename;
			$targetPath = '../photogallery/static/photos/'.$newname;
			
			
			//// PROBLEM : Photo can have a problem while uploading. If same user is creating another album name with same name and photo name also same.
			//// Solution: We can query the maximum AlbumID from ALBUMS and append +1 at the end and then perform the insert.
			// this can be again optimized to reduce the size or perform some opetations on image.
			move_uploaded_file($_FILES["photolink"]["tmp_name"], $targetPath);
			
			$photoData = array(

				'PHOTONAME'=>$_POST["photoname"],
				'ALBUMID'=>$albumId,
				'USERID'=>$_SESSION["userid"],
				'PHOTO_LINK'=>$newname

			);

			$this->db->insert('photos', $photoData);
			header("location: /photogallery/albums/".$albumId);
		}
		
		public function display_album(){
			
			$albumId = $this->uri->segment(2);
			$this->load->database();
			
			$query = 'SELECT * FROM albums WHERE albumid = ? AND userid = ?';
			$result = $this->db->query($query, array($albumId, $_SESSION["userid"]));
			
			$data['album'] = $result;
			$data['photos'] = $this->get_photos($albumId);
			
			$this->load->view('templates/header');
			$this->load->view('pages/photos', $data);
			$this->load->view('templates/footer');
			
		}
		
		public function get_photos($albumId){
			
			$this->load->database();
			
			$query = 'SELECT * FROM photos WHERE albumid = ? AND userid = ? ';
			$result = $this->db->query($query, array($albumId, $_SESSION["userid"]));
			
			return $result;	
			
		}
		
		public function display_photo(){
			
			$albumId = $this->uri->segment(2);
			$photoId = $this->uri->segment(3);
			
			$this->load->database();
			
			$query = 'SELECT * FROM photos WHERE photoid = ? AND albumid = ? AND userid = ?';
			$result = $this->db->query($query, array($photoId, $albumId, $_SESSION["userid"]));
			
			$data['photo'] = $result;
			$this->load->view('templates/header');
			$this->load->view('pages/picture', $data);
			$this->load->view('templates/footer');
			
		}
		
		
		public function delete_photo($album_id, $photo_id){
			
			$this->load->database();
			
			$query = 'DELETE FROM photos WHERE photoid = ? AND albumid = ? AND userid = ?';
			$result = $this->db->query($query, array($photo_id, $album_id, $_SESSION["userid"]));
			
			header("location: /photogallery/albums/".$album_id);
		}
	
		public function delete_album($album_id){
			
			$this->load->database();
			$query = 'DELETE FROM albums WHERE albumid = ? AND userid = ?';
			$result = $this->db->query($query, array($album_id, $_SESSION["userid"]));
			
			header("location: /photogallery/albums");
		}
		
		
		public function mark_public($photo_id){
			
			$this->load->database();
			$shared_data = array(
				'IMAGEID'=>$photo_id
			);
			$this->db->insert('sharedphotos', $shared_data);
		}
		
		public function mark_private($photo_id){
			$this->load->database();
			$query = 'DELETE FROM sharedphotos WHERE imageid = ?';
			$result = $this->db->query($query, array($photo_id));
			
		}
		
		public function like_photo($photo_id){
			
			$this->load->database();
			$shared_data = array(
				'IMAGEID'=>$photo_id,
				'USERID'=>$_SESSION["userid"]
			);
			$this->db->insert('likedphotos', $shared_data);
			
		}
		
		public function unlike_photo($photo_id){
			
			$this->load->database();
			$query = 'DELETE FROM likedphotos WHERE imageid = ?';
			$result = $this->db->query($query, array($photo_id));
			
			
		}
	}
?>



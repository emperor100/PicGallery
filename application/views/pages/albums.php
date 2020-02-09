
<?php
// Initialize the session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../photogallery/login");
    exit;
}
?>

    <div class="page-header">
        <h1 align="center">Hi, This is your album collection.</h1>
    </div>
    <p align='right'>
		<a href="/photogallery/home" class="btn btn-success">Home</a>
        <a href="/photogallery/albums/addalbum" class="btn btn-warning">+ Add New Album</a>
        <a href="/photogallery/logout" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

	<?php 
	
		foreach ($albums->result() as $album)
		{
			$albumId = $album->albumid;
			$userId = $album->userid;
			$albumName = $album->albumname;
			$imageLink = $album->photo_link;
			$description = $album->description;
			$createdAt = $album->created_at;
			
			
			?>

				<div>
					
										
						<a href="/photogallery/albums/<?php echo $albumId; ?>" >
							<img  src="<?php echo "/photogallery/static/photos/".$imageLink; ?>"  />
						</a>
							
								<p align="center">Album Title: <?PHP echo $albumName; ?> </p>
							    <p align="center">Shared at: <?PHP echo $createdAt; ?></p> 
							
							
							
						</div>
			
			
				
			<?php
			
		}
?>
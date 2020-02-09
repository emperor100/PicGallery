<?php 

	$albumid = 0;
	$albumname = "";
	foreach ($album->result() as $alb)
	{
		$albumid=$alb->albumid;
		$albumname = $alb->albumname;
	}

?>
<div class="page-header">
	<h1 align="center">Hi, This is your <?php echo $albumname?>'s album collection.</h1>
</div>
<p align='right'>
	<a href="/photogallery/home" class="btn btn-success">Home</a>
	<a href="/photogallery/albums/<?php echo $albumid; ?>/addphoto" class="btn btn-warning">+ Add New Photo</a>
	<a href="/photogallery/album/delete_album/<?php echo $albumid; ?>" class="btn btn-warning">Delete the Album</a>
	<a href="/photogallery/logout" class="btn btn-danger">Sign Out</a>
</p>

<?php 

	foreach ($photos->result() as $photo)
	{
		$photoid = $photo->photoid;
		$userid = $photo->userid;
		$photoname = $photo->photoname;
		$imagelink = $photo->photo_link;
		$createdat = $photo->created_at;
			
		
		?>

			<div>
				
									
					<a href="/photogallery/albums/<?php echo $albumid; ?>/<?php echo $photoid?>" >
						<img  src="<?php echo "/photogallery/static/photos/".$imagelink; ?>"  />
					</a>
						
							<p align="center">Photo Name : <?PHP echo $photoname; ?> </p>
							<p align="center">Shared at: <?PHP echo $createdat; ?></p> 
						
						
						
					</div>
		
		
			
		<?php
		
	}
?>
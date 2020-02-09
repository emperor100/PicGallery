<?php 

foreach ($photo->result() as $pic)
	{
		$photoid = $pic->photoid;
		$userid = $pic->userid;
		$albumid = $pic->albumid;
		$photoname = $pic->photoname;
		$imagelink = $pic->photo_link;
		$createdat = $pic->created_at;
		
	}
?>
<div class="page-header">
<h1 align="center"><?php echo $photoname; ?></h1>
</div>
<p align='right'>
<a href="/photogallery/home" class="btn btn-success">Home</a>
<a href="/photogallery/album/mark_private/<?php echo $photoid; ?>" class="btn btn-primary"> Mark Private </a>
<a href="/photogallery/album/mark_public/<?php echo $photoid; ?>" class="btn btn-primary"> Mark Public </a>
<a href="/photogallery/albums/" class="btn btn-default">Album</a>
<a href="/photogallery/album/delete_photo/<?php echo $albumid;?>/<?php echo $photoid;?>" class="btn btn-warning">Delete this</a>
<a href="/photogallery/logout" class="btn btn-danger">Sign Out</a>
</p>



<div>
	<h2> <?php echo $createdat; ?> </h2>
</div>
<div>
	<img  src="<?php echo "/photogallery/static/photos/".$imagelink; ?>"  />
</div>

<script>

	function validateForm()
	{
			
		
		var albumname = document.getElementById("albumname").value;
		var description = document.getElementById("description").value;
		var photolink = document.getElementById("photolink").value;
			
		
		if(albumname.length == 0)
		{
			alert("Give your ALBUM a name");
			return false;
		}
		if(description.length==0)
		{
			alert("Describe this Album");
			return false;
		}
		if(photolink.length==0)
		{
			alert("I think no photo is chosen yet");
			return false;
		}
		
		alert("This album will be added to your album collection");
		return true;
			
		
	}
	
</script>

    <div class="page-header">
        <h1 align="center">Add a Photo to your Album.</h1>
    </div>
    <p align='right'>
		<a href="/photogallery/home" class="btn btn-success">Home</a>
        <a href="/photogallery/albums" class="btn btn-warning">Albums</a>
        <a href="/photogallery/logout" class="btn btn-danger">Sign Out</a>
    </p>
    <div class="wrapper">
        <h2>Add New Photo in <?php echo $album_id; ?></h2>
        <p>Please fill below details for the new photo.</p>
        <form action="/photogallery/album/create_photo/<?php echo $album_id;?>" onsubmit = "return validateForm()" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label>PhotoName</label>
                <input type="text" name="photoname" class="form-control" placeholder="Enter Photo Name" id="photoname" >
                
            </div>    
            
            <div class="form-group">
                <label>Choose Photo</label>
                <input type="file" name="photolink" class="form-control" placeholder="Choose a photo" id = "photolink">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>


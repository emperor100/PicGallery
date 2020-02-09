
<body>
<div class="page-header">
    <h1 align="center">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Photo Gallery.</h1>
</div>
<p align='right'>
	<a href="/photogallery/albums" class="btn btn-success">Open Album</a>
    <a href="/photogallery/logout" class="btn btn-danger">Sign Out</a>
</p>
<div class="page-header">
    <p ><h4 align="center"> These are photos which are shared by users on PhotoGallery. Like their photos and share yours:D </h4></p>
</div>

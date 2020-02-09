
	<script>
		
		function validateForm()
		{
			
			var w = document.getElementById("users").value;
			var x = document.getElementById("pass").value;

			
			
			
			if(w.length==0)
			{
				alert("username cant be blank");
				return false;
				
			}
			else 
				if(x.length == 0)
			{
				alert("Please enter password");
				return false;
			}
			else if(x.length < 8)
			{
				alert("Password length must be greater than or equal to 8");
				return false;
	
			return true;
			
		}
	
	</script>
	<script type="text/javascript" src="/photogallery/static/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/photogallery/static/js/login.js"></script>
	
	<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form id="loginform" action="#" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" class="form-control" id = "users">
                
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password" class="form-control" id = "pass">
                
            </div>
			<br></br>
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="/photogallery/register">Sign up now</a>.</p>
        </form>
    </div>   
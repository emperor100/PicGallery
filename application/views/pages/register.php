
	<script>
		
		function validateForm()
		{
			
			var w = document.getElementById("users").value;
			var x = document.getElementById("pass").value;
			var y = document.getElementById("repass").value;
			
			
			
			if(w.length==0)
			{
				alert("username cant be blank");
				return false;
				
			}
			else 
				if(x!=y)
			{
				alert("Passwords dont match");
				return false;
			}
			else if(x.length < 8)
			{
				alert("Password length must be greater than or equal to 8");
				return false;
			}
			return true;
			
		}
	
	</script>
	<script type="text/javascript" src="/photogallery/static/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/photogallery/static/js/login.js"></script>

	<div class="wrapper">
        <h2>Register</h2>
        <p>Please fill in your credentials to Register.</p>
        <form id="registration_form" action="#" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" class="form-control" id = "users">
                
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password" class="form-control" id = "pass">
                
            </div>
			<div>
                <label>Retype your Password</label>
                <input type="password" name="repassword" class="form-control" id = "repass">
                
            </div>
			<br></br>
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
            <p>Already have an account? <a href="/photogallery/login">Login here</a>.</p>
        </form>
    </div>   
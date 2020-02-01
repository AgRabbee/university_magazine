<?php include_once('template/header.php');?>
 
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>PLEASE LOGIN TO SYSTEM</h3>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="checker.php" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you email" tabindex="1" required name="email" id="eml" class="form-control">
                                <span class="help-block small" id="errEmail">Your registered email to system</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" tabindex="2" required name="password" id="pass" class="form-control">
                                <span class="help-block small" id="errPass">Your password</span>
                            </div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" tabindex="3" name="check" id="check">
								<label class="form-check-label" for="check">Check me out</label>
                                <span class="help-block small" id="errCheck"></span>
							</div>
                            <button type="submit" id="submit" name="submit" tabindex="4" class="btn btn-success btn-block loginbtn">Login</button>
                        </form>
                    </div>
                </div>
			</div>
			<div class="text-center login-footer">
				<p>Copyright © 2019. All rights reserved.</p>
			</div>
		</div>   
    </div>
    
	<!--custom login script-->
	<script type="text/javascript"> 
	var emailFlag = false;
	var passFlag = false;
	$(document).ready(function() {

	 	$('#submit').attr("disabled", "disabled");
		
		var email = $('#eml').val();
		var pass = $('#pass').val();
		
		$('#eml').focusout(function(){
			email = $(this).val();
			if(email != ''){
				$.ajax({
					url:"checker.php",
					method:"POST",
					data:{email:email, check:'loginEmail'},
					success:function(data){
						if(data == 'Invalid'){
							$("#errEmail").html("Invalid Email").css("color","red");
							$("#eml").css("border", "1px solid red").val('');	
							emailFlag = false;	
						}
						else if(data == 'User'){
							$("#errEmail").html("");
							$("#eml").css("border", "1px solid green");
							emailFlag = true;
							loginAction();
						}
					}
				});
			}			
		});
		
		$('#pass').focusout(function(){
			email = $('#eml').val();
			pass = $(this).val();
			if(email != '' && pass != ''){
				$.ajax({
					url:"checker.php",
					method:"POST",
					data:{email:email, pass:pass, check:'loginPass'},
					success:function(data){
						if(data == 'Invalid'){
							$("#errPass").html("Password doesn\'t match").css("color","red");
							$("#pass").css("border", "1px solid red").val('');	
							passFlag = false;								
						}
						else if(data == 'User'){
							$("#errPass").html("");
							$("#pass").css("border", "1px solid green");
							passFlag = true;
							loginAction();
						}
					}
				});
			}
		});
		

	});
	
	function loginAction(){
		if(emailFlag && passFlag){
			$('#check').click(function(){
			if($('this').prop("checked") == false){
					$("#errCheck").html("Checkbox cannot left unchecked").css("color","red");				
				}else{
					$('#submit').removeAttr("disabled");
				}
			});
			}
	}
	</script>
	
	<?php include_once('template/scripts.php');?>
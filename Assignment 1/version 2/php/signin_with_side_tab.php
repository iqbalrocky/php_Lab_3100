<div id='login_page'>
	<div id='login_page_margin'>
		<div id="close_btn">
			<a href="#" onclick="close_window()">X</a>
		</div>
		<!--<form action="../version 1/info.php" method="post">-->
		<form action="php/signInProcessing.php" method="post">	
			<div id='input_block'>
				<input type="text" name='name' required placeholder="Username or Email" maxlength='25'/>
				<input type="password" name='password' required placeholder="Password" maxlength='25' 
					pattern="[a-zA-Z0-9]+" title='only alphanumeric character'/>
				<input type='submit' name='submit' value='Sign In' />
			</div>
		</form>
	</div>
</div>
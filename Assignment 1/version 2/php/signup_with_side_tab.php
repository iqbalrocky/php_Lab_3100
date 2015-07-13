<div id='signup_page'>
	<div id='signup_page_margin'>
		<div id="signup_close_btn">
			<a href="#" onclick="close_window()">X</a>
		</div>
		<form action="../version 1/info.php" method="post">
			<div id='signup_input_block'>
				<input type="text" name='name' required placeholder="Username" 
					pattern="[a-zA-Z0-9' ']+" title='User name should not contain symble'/>
				<input type="email" name='email' required placeholder="Email"/>
				<input type="password" name='password' required pattern="[a-zA-Z0-9]+"
					title='only alphanumeric character'
					placeholder="Password" />
				<input type='submit' name='submit' value='Sign Up' />
			</div>
		</form>
	</div>
</div>
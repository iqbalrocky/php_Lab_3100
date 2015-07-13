<div id='login_page'>
	<div id='login_page_margin'>
		<div id="close_btn">
			<a href="#" onclick="close_window()">X</a>
		</div>
		<form action="../version 1/info.php" method="post">
			<div id='input_block'>
				<input type="text" name='name' required placeholder="Username or Email" 
					pattern="[a-zA-Z0-9' ']+" title='User name should not contain symble'/>
				<input type="password" name='password' required pattern="[a-zA-Z0-9]+"
					title='only alphanumeric character'
					placeholder="Password" />
				<input type='submit' name='submit' value='Sign In' />
			</div>
		</form>
	</div>
</div>
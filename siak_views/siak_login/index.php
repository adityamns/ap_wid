<body>
	<div class="page-container row-fluid">
		<div class='signin'>
		  <div id="logo">
		  <div id="logo-tengah">
			<img src="<?php echo URL; ?>siak_public/img/logo_widyatama.png" />
		  </div>
		  </div>
		  <span id="judul">SISTEM INFORMASI AKADEMIK</span>
          <span id="judul2">UNIVERSITAS WIDYATAMA</span> 
		<div class="content">
			<form class="form-vertical login-form" method="post" action = "<?php echo URL; ?>siak_login/siak_run">
			<div class="control-group">
				<label class="control-label left">Username</label>
				<div class="controls">
				<div class="input-icon left">
					<i class="icon-user"></i>
					<input type="text" name="username" value="" class="m-wrap" placeholder="Username" />
				</div>
				</div>
			</div>
			<!-- password -->
			<div class="control-group">
				<label class="control-label left">Password</label>
				<div class="controls">
					<div class="input-icon left">
					<i class="icon-lock"></i>
					<input class="m-wrap" type="password" placeholder="Password" value="" name="password">
					</div>
				</div>
			</div>
			<!-- button -->
			<div class="form-actions1">
				<p class="pull-right">
					<button class="btn green" value="Login" name="login" type="submit">
					Login
					<i class="m-icon-swapright m-icon-white"></i>
					</button>
					<button class="btn red" onClick="#" value="Reset" name="reset" type="reset">
					 Reset
					<i class="icon-refresh m-icon-white"></i>
					</button>	
					
				</p>
			</div>
			<div class="footer">
				<div class="footer-inner">
					<font color="white">Copyright &copy; 2016 </font> <a href="http://www.widyatama.ac.id/"><font color="#FFD700">Universitas Widyatama</font></a> 
				</div>
				
			</div>			
		</form>
		</div>
</body>
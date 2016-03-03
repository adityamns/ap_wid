													
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE -->
	</div>
	<?php if(Siak_session::siak_get('loggedIn') == true){ ?>
	<div class="footer">
		<div class="footer-inner">
			<font color="Black">Copyright &copy; 2016,</font> <a href="http://www.widyatama.ac.id/"><font color="#000080">Universitas Widyatama</font></a> <font color="Black">- All right reserved</font>
			<font color="Black"><b> [ Your IP : <?php echo Siak_session::siak_get('ip_client'); ?> ] </b></font>
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<?php }?>
	<!-- <div class="copyright">
			<font color="black">2014 &copy;</font>
			<a href="http://www.idu.ac.id">
			<font color="red">Keluarga Sodinomo</font>
			</a>
	</div> -->
</body>
</html>
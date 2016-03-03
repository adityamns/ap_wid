<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<br>	
				

			<?php 
				// echo '<pre>';print_r($this->siak_userdata);echo '</pre>';die();
					/*foreach(Siak_session::siak_get('allowed') as $key => $val) { 
						$menu = '';
							if ($val['ada_submenu'] == 1) {
								foreach ($this->siak_userdata as $key => $value) {
									if ($value['groups']==$val['groups']&&$value['loads']=="t") {
										$menu = "<li {active}><a href='".URL.$value['url']."'><i class=icon-home></i><span class='selected'></span><span class='title'>".$value['nama']."</span></a></li>";
										if($_GET['url'] == $value['url']) {
											$menu  = str_replace('{active}', '{is_active}', $menu);
										}
										break;
									}
								} 
							}elseif($val['ada_submenu'] == 2){ 
								$menu .= '<li  {active}>';
								$menu .= '<a href="#"><i class="icon-cogs"></i> <span class="arrow"></span><span class="selected"></span><span class="title">'.$val['nama_groups'].'</span></a>';					
								//$menu = "<li class='status active'><span class='selected'></span>";
								$menu .= "<ul class='sub-menu'>";
								foreach ($this->siak_userdata as $key => $value) {
									if ($value['groups']==$val['groups']&&$value['loads']=="t") {
										if($_GET['url'] == $value['url']) {
											$menu  = str_replace('{active}', '{is_active}', $menu);
											$menu .= "<li class='status active'><a href='".URL.$value['url']."'>".$value['nama']."</a></li>";
											continue;
										}
										$menu .= "<li><a href='".URL.$value['url']."'>".$value['nama']."</a></li>";
									}
								}
								$menu .= "</ul>";
								$menu .= "</li>";
							}*/?>
			<?php
				/*$menu  = str_replace('{active}', '', $menu);
				$menu  = str_replace('{is_active}', 'class="status active"', $menu);
				echo $menu; 
			} */?>
				
				</li>
				<li ><a href='<?=URL?>siak_dashboard'><i class='icon-home'></i> Beranda</a></li>
			<?php
			
			$id = Siak_session::siak_get('level');
// 			echo $id;
			echo $this->display_children(0,$id);
			?>
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->

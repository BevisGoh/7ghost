<?php
	function createMenu($name,$url){
		$now = "./?m=".$_GET['m']."&a=".$_GET['a'];
		if($url==$now)
			$section = 'class="section"';
		echo "<li><a href='$url' $section>$name</a></li>";
	}
?>
	<div class="side">
		<div id="nav">
			<ul class="dashboard main">
				<li>
					<span>全局</span>
					<ul>
						<?php
							createMenu('基本设置','./?m=site&a=Index');
							createMenu('高级设置','./?m=site&a=Advanced');
							createMenu('内容替换','./?m=site&a=Replace');
						?>
					</ul>
				</li>
				<li>
					<span>自定义页面</span>
					<ul>
						<?php
							createMenu('自定义页面','./?m=page&a=Index');
							createMenu('添加自定义页面','./?m=page&a=Edit');
						?>
					</ul>
				</li>
				<!--
				<li>
					<span>页面映射</span>
				</li>
				<li>
					<span>帮助</span>
				</li>
				-->
			</ul>
			<a id="collapsible" href="#" style="height: 300px;"> </a>
		</div>
	</div>
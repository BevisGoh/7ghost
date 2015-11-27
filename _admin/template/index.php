<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
		<dl>
			<h2 class="section-header">基本信息</h2>
			<dt>需要代理的网址:</dt> 
			<dd><input type="text" size="32" value="2563323" name="name"></dd>
			<dd class='tipe'>整站需要反向代理的网址，如:http://www.baidu.com/</dd>
		</dl>
		<?php
			w('text')->set('name','需要代理的网址')
					->set('key','host')
					->set('tipe','整站需要反向代理的网址，如:http://www.baidu.com/')
					->e();
		?>
		<dl> 
			<dt>站点名称:</dt> 
			<dd><textarea class="tarea" cols="50" name="script" rows="5">123212323</textarea></dd>
			<dd class='tipe'>站点名称，将显示在浏览器窗口标题等位置</dd>
		</dl>
	</div>
<?php include tpl('footer');?>
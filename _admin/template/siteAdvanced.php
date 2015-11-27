<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
		<form action="" method="POST">
		<h2 class="section-header">自定义COOKIES</h2>
		<?php
			w('select')->set('name','COOKIES设置')
					->set('key','cookies')
					->set('value',d('config')->get('cookies'))
					->set('options',array('传统cookies'=>'0','全局cookies'=>'1','自定义cookies'=>'2',))
					->set('tipe','传统cookies能保证每个访客一个cookies，全局cookies则是所有访客一个cookies，自定义cookies则cookies将不会变化')
					->e();
			w('text')->set('name','自定义COOKIES')
					->set('key','diyCookies')
					->set('value',d('config')->get('diyCookies'))
					->set('tipe','“COOKIES设置”选项必须选择“自定义cookies”才能生效')
					->e();
		?>
			
		<br>
		<h2 class="section-header">自定义浏览器标识(agent)</h2>
		<?php
			w('select')->set('name','伪造agent')
					->set('key','agent')
					->set('value',d('config')->get('agent'))
					->set('options',array('使用客户端agent'=>'0','不伪造'=>'1','自定义agent'=>'2',))
					->set('tipe','这个可以让受访服务器识别是IE、firefox或者手机访问，建议设置为“使用客户端agent”')
					->e();
			w('text')->set('name','自定义agent')
					->set('key','diyAgent')
					->set('value',d('config')->get('diyAgent'))
					->set('tipe','“伪造agent”选项必须选择“自定义agent”才会生效，如:<br>Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)')
					->e();
		?>
		
		<br>
		<h2 class="section-header">自定义来路(referer)</h2>
		<?php
			w('select')->set('name','伪造referer')
					->set('key','referer')
					->set('value',d('config')->get('referer'))
					->set('options',array('自动伪造'=>'0','自定义referer'=>'1'))
					->set('tipe','自动伪造可以还原原始的referer,使全站镜像可以完美突破防盗链')
					->e();
			w('text')->set('name','自定义referer')
					->set('key','diyReferer')
					->set('value',d('config')->get('diyReferer'))
					->set('tipe','“伪造referer”选项必须选择“自定义referer”才会生效，如:http://www.baidu.com')
					->e();
		?>
		
		<br>
		<h2 class="section-header">自定义IP</h2>
		<?php
			w('select')->set('name','伪造ip')
					->set('key','ip')
					->set('value',d('config')->get('ip'))
					->set('options',array('使用服务器ip'=>'0','使用客户端ip'=>'1','自定义ip'=>'2',))
					->set('tipe','注意!!受代理网站仍然可以得到服务器的ip,此为不完全伪造ip!!!')
					->e();
			w('text')->set('name','自定义ip')
					->set('key','diyIp')
					->set('value',d('config')->get('diyIp'))
					->set('tipe','伪造ip选项必须选择自定义IP才能生效,此为不完全伪造!!!，如:127.0.0.1')
					->e();
		?>
			<input type="submit" class="m-button" value="保存高级设置" id="submit">
		</form>
	</div>
<?php include tpl('footer');?>
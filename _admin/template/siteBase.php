<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
		<form action="" method="POST">
		<h2 class="section-header">基本信息</h2>
		<?php
			w('text')->set('name','需要代理的网址')
					->set('key','host')
					->set('value',d('config')->get('host'))
					->set('tipe','整站需要反向代理的网址，如:http://www.baidu.com/')
					->e();

			w('select')->set('name','替换域名')
					->set('key','replaceDomain')
					->set('value',d('config')->get('replaceDomain'))
					->set('options',array('替换'=>'0','不替换'=>'1'))
					->set('tipe','替换域名，实现全站镜像')
					->e();
			
			w('select')->set('name','替换HTML相对地址')
					->set('key','relativeHTML')
					->set('value',d('config')->get('relativeHTML'))
					->set('options',array('替换'=>'0','不替换'=>'1'))
					->set('tipe','替换相对地址，可以让在二级目录的7ghost正常运行，影响样式文件、脚本、站内链接')
					->e();
			w('select')->set('name','替换CSS相对地址')
					->set('key','relativeCSS')
					->set('value',d('config')->get('relativeCSS'))
					->set('options',array('替换'=>'0','不替换'=>'1'))
					->set('tipe','替换相对地址，可以让在二级目录的7ghost正常运行，影响样式文件中的图片')
					->e();
		?>
		<br>
		<h2 class="section-header">静态页面缓存</h2>
		<?php
			w('select')->set('name','是否开启缓存')
					->set('key','static')
					->set('value',d('config')->get('static'))
					->set('options',array('缓存'=>'0','不缓存'=>'1'))
					->set('tipe','开启静态缓存，会自动将文件存在本地，请开启根目录可写权限')
					->e();
			w('text')->set('name','自定义缓存类型')
					->set('key','diyStatic')
					->set('value',d('config')->get('diyStatic'))
					->set('tipe','“是否开启缓存”选项必须选择“缓存”才能生效!!!，如:css|js|html')
					->e();
		?>
			<input type="submit" class="m-button" value="提交" id="submit">
		</form>
	</div>
<?php include tpl('footer');?>
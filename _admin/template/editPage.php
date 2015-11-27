<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
			<form action="" method="POST">
			<input type="hidden" name='key' value='<?php _e($key)?>'></input>
				<h2 class="section-header">自定义页面(<?php _e($item['name'])?>) - 基本
					 - <a href="./?m=page&a=Advanced&key=<?php _e($key)?>">高级</a>
					 - <a href="./?m=page&a=replace&key=<?php _e($key)?>">内容替换</a>
				</h2>
				<?php
					w('text')->set('name','名称')
							->set('key','name')
							->set('value',$item['name'])
							->set('tipe','仅方便记忆')
							->e();
			
					w('text')->set('name','页面地址')
							->set('key','uri')
							->set('value',$item['uri'])
							->set('tipe','需要自定义的uri,为正则匹配<br>如:about.html     如:html/.*')
							->e();
					
					w('text')->set('name','需要代理的网址')
							->set('key','host')
							->set('value',$item['host'])
							->set('tipe','当前页面需要反向代理的网址，如:http://hi.baidu.com/。不填则使用全局设置')
							->e();
							
					w('select')->set('name','返回类型')
							->set('key','returnType')
							->set('value',$item['returnType'])
							->set('options',array('网页(html)'=>'0','文本(text)'=>'1','表单(form)'=>'2','链接(link)'=>'3'))
							->set('tipe','页面返回的类型,默认为网页形式')
							->e();
					
					w('select')->set('name','替换域名')
							->set('key','replaceDomain')
							->set('value',$item['replaceDomain'])
							->set('options',array('替换'=>'0','不替换'=>'1'))
							->set('tipe','替换域名，实现全站镜像')
							->e();
					
					w('select')->set('name','替换HTML相对地址')
							->set('key','relativeHTML')
							->set('value',$item['relativeHTML'])
							->set('options',array('替换'=>'0','不替换'=>'1'))
							->set('tipe','替换相对地址，可以让在二级目录的7ghost正常运行，影响样式文件、脚本、站内链接')
							->e();
					w('select')->set('name','替换CSS相对地址')
							->set('key','relativeCSS')
							->set('value',$item['relativeCSS'])
							->set('options',array('替换'=>'0','不替换'=>'1'))
							->set('tipe','替换相对地址，可以让在二级目录的7ghost正常运行，影响样式文件中的图片')
							->e();
					w('text')->set('name','模版文件名')
							->set('key','template')
							->set('value',$item['template'])
							->set('tipe','留空为不使用模版。使用模版后，不执行内容替换。模版文件保存在“tpl”文件夹下')
							->e();
				?>
				<input type="submit" class="m-button" value="提交" id="submit">
			</form>

	</div>
<?php include tpl('footer');?>
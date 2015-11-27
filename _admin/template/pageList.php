<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
		<div class="mside side" style="width:316px;padding-right:10px;">
			<form action="" method="POST">
				<h2 class="section-header">添加自定义页面</h2>
				<?php
					w('text')->set('name','名称')
							->set('key','name')
							->set('tipe','仅方便记忆')
							->e();
					
					w('text')->set('name','页面地址')
							->set('key','uri')
							->set('tipe','需要自定义的uri,为正则匹配<br>如:about.html    如:html/.*')
							->e();
					
					w('text')->set('name','需要代理的网址')
							->set('key','host')
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
					
					w('text')->set('name','模版文件名')
							->set('key','template')
							->set('value',$item['template'])
							->set('tipe','留空为不使用模版。使用模版后，不执行内容替换。模版文件保存在“tpl”文件夹下')
							->e();
				?>
				<input type="submit" class="m-button" value="提交" id="submit">
				<dl>
					<dd class='tipe'>
						添加后可以在右侧列表选择，进行高级设置
					</dd>
				</dl>
			</form>
		</div>
		<div class="main">
			<h2 class="section-header">自定义页面列表</h2>
			<table class="ae-table ae-table-striped ae-quota-requests">
	        <thead>
	            <tr>
	                <th width="35%">
	                    名称
	                </th>
	                <th>
	                    页面地址
	                </th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		$pages = d('config')->get('pages');
	        		$i = 'class="ae-even"';
	        		if(is_array($pages))
	        		foreach($pages as $key => $item){
	        			if($i == 'class="ae-even"'){
	        				$i = '';
	        			}else{
	        				$i = 'class="ae-even"';
	        			}
	        			?>
	        	<tr <?php _e($i);?>>
	                <td>
	                	<div class="row-title">
		                    <a href="./?m=page&a=edit&key=<?php _e($key)?>" title="编辑<?php _e($item['name'])?>"><?php _e($item['name'])?></a>
	                	</div>
	                    <div class="row actions">
	                        <span><a href="./?m=page&a=edit&key=<?php _e($key)?>">基本</a> | </span>
	                        <span><a href="./?m=page&a=Advanced&key=<?php _e($key)?>">高级</a> | </span>
	                        <span><a href="./?m=page&a=replace&key=<?php _e($key)?>">内容替换</a> | </span>
	                        <span><a href="./?m=page&a=del&key=<?php _e($key)?>">删除</a></span>
	                    </div>
	                </td>
	                <td>
	                   <?php _e($item['uri'])?>
	                </td>
	            </tr>
	        			<?php
	        		}
	        	?>
	            </tbody><tfoot>
		            <tr>
		                <td width="35%">
		                    名称
		                </td>
		                <td>
		                    页面地址
		                </td>
		            </tr>
	            </tfoot>
	        
	    </table>	
		</div>
	</div>
<?php include tpl('footer');?>
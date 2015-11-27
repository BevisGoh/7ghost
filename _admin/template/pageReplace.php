<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
		<h2 class="section-header">自定义页面(<?php _e($page[name])?>) - <a href="./?m=page&a=edit&key=<?php _e($_GET['key'])?>">基本</a>
			 - <a href="./?m=page&a=Advanced&key=<?php _e($_GET['key'])?>">高级</a>
			 - 内容替换
		</h2>
		<div class="mside side" style="width:316px;padding-right:10px;">
			<form action="" method="POST">
				<h2 class="section-header">添加内容替换</h2>
				<?php
					w('text')->set('name','名称')
							->set('key','name')
							->set('tipe','仅方便记忆')
							->e();
			
					w('text')->set('name','查找内容')
							->set('key','seach')
							->set('tipe','查找需要替换的内容,为正则匹配')
							->e();
					
					w('textarea')->set('name','替换为')
							->set('key','replace')
							->set('tipe','将查找到的内容替换为')
							->e();
				?>
				<input type="submit" class="m-button" value="提交" id="submit">
			</form>
		</div>
		<div class="main">
			<h2 class="section-header">内容替换列表</h2>
			<table class="ae-table ae-table-striped ae-quota-requests">
	        <thead>
	            <tr>
	                <th width="35%">
	                    名称
	                </th>
	                <th>
	                    查找
	                </th>
	                <th>
	                    替换为
	                </th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		$pages = d('config')->get('pages');
	        		$key = $_GET['key'];
					$replaces = $pages[$key]['replaces'];
	        		$i = 'class="ae-even"';
	        		if(is_array($replaces))
	        		foreach($replaces as $rekey => $item){
	        			if($i == 'class="ae-even"'){
	        				$i = '';
	        			}else{
	        				$i = 'class="ae-even"';
	        			}
	        			?>
	        	<tr <?php _e($i);?>>
	                <td>
	                	<div class="row-title">
		                    <a href="./?m=page&a=EditReplace&key=<?php _e($key)?>&rekey=<?php _e($rekey)?>" title="编辑<?php _e($item['name'])?>"><?php _e($item['name'])?></a>
	                	</div>
	                    <div class="row actions">
	                        <span><a href="./?m=page&a=editReplace&key=<?php _e($key)?>&rekey=<?php _e($rekey)?>">编辑</a> | </span>
	                        <span><a href="./?m=page&a=delReplace&key=<?php _e($key)?>&rekey=<?php _e($rekey)?>">删除</a></span>
	                    </div>
	                </td>
	                <td>
	                   <?php _e(htmlspecialchars($item['seach']))?>
	                </td>
	                <td>
	                    <?php _e(htmlspecialchars($item['replace']))?>
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
		                    查找
		                </td>
		                <td>
		                    替换为
		                </td>
		            </tr>
	            </tfoot>
	        
	    </table>	
		</div>
	</div>
<?php include tpl('footer');?>
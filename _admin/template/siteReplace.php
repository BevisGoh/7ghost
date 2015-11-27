<?php include tpl('header');?>
<?php include tpl('menu');?>
	<div class="main">
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
	        		$replaces = d('config')->get('replaces');
	        		$i = 'class="ae-even"';
	        		if(is_array($replaces))
	        		foreach($replaces as $key => $item){
	        			if($i == 'class="ae-even"'){
	        				$i = '';
	        			}else{
	        				$i = 'class="ae-even"';
	        			}
	        			?>
	        	<tr <?php _e($i);?>>
	                <td>
	                	<div class="row-title">
		                    <a href="./?m=site&a=EditReplace&key=<?php _e($key)?>" title="编辑<?php _e($item['name'])?>"><?php _e($item['name'])?></a>
	                	</div>
	                    <div class="row actions">
	                        <span><a href="./?m=site&a=editReplace&key=<?php _e($key)?>">编辑</a> | </span>
	                        <span><a href="./?m=site&a=delReplace&key=<?php _e($key)?>">删除</a></span>
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
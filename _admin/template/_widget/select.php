		<dl> 
			<dt><?php _e($info['name']);?>:</dt> 
			<dd>
				<select style="margin: 0px;" name="<?php _e($info['key']);?>">
					<?php
						foreach($info[options] as $key=>$value){
							$selected="";
							if($info['value']==$value)
								$selected = "selected=''";
							echo "<option value='$value' $selected>$key</option>";
						}			
					?>
				</select>
			</dd>
			<dd class='tipe'><?php _e($info['tipe']);?></dd>
		</dl>
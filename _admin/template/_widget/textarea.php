		<dl> 
			<dt><?php _e($info['name']);?>:</dt> 
			<?php
				$value = get_magic_quotes_gpc()?stripslashes($info['value']):$info['value'];
			?>
			<dd><textarea class="tarea" cols="50" name="<?php _e($info['key']);?>" rows="5"><?php _e(htmlspecialchars($value));?></textarea></dd>
			<dd class='tipe'><?php _e($info['tipe']);?></dd>
		</dl>
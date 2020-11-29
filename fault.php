<?php if (count($fault)>0):?>
 	<div class="text-danger">
 	    <p>Caught Errors:</p>
 		<?php foreach ($fault as $error):?>
 			<div class="form-group">
			  	      <p><?php echo $error; ?></p>
			         </div>
 			<?php endforeach ?>
 	</div>
 <?php endif ?>
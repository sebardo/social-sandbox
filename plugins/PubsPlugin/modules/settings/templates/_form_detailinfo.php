<fieldset class="labelLeft">
		
		<p>
			<label for="homeborn"><?php echo __('Native town', null, 'setting')?>:</label>
			<?php echo $form['borntown']->render() ?>
                </p>	
		<p>
			<label for="maritalStatus"><?php echo __('Marital status', null, 'setting')?></label>
			<?php echo $form['marital_status']->render() ?>
                </p>
		<p>
			<label for="sexualOrientation"><?php echo __('I am interested', null, 'setting')?>: </label>
			<?php echo $form['meeting_sex']->render() ?>
                </p>
		<p>
			<label for="religion"><?php echo __('Religion', null, 'setting')?>:</label>
			<?php echo $form['religion']->render() ?>
                </p>
		<p>
			<label for="politic"><?php echo __('Politic', null, 'setting')?>:</label>
		        <?php echo $form['politic']->render() ?>
                </p>
		<p>
			<label for="smoker"><?php echo __('Smoker', null, 'setting')?>:</label>
                        <?php echo $form['smoker']->render() ?>
		</p>
		<p>
			<label for="drinker"><?php echo __('Drinker', null, 'setting')?>:</label>
                        <?php echo $form['drinker']->render() ?>
                </p>
		<p>
			<label for="education"><?php echo __('Education', null, 'setting')?>:</label>
		        <?php echo $form['education']->render() ?>
                </p>
		<p>
			<label for="occupation"><?php echo __('Profession', null, 'setting')?>:</label>
		        <?php echo $form['profession']->render() ?>
                </p>
		<p>
			<label for="language"><?php echo __('Languages', null, 'setting')?>:</label>
		        <?php echo $form['language']->render() ?>
                </p>
		<p class="save right">
			<button class="button" type="submit"><?php echo __('Save changes', null, 'setting')?>
			<span class="saveSuccess"></span>
			</button>
		</p>

     <?php echo $form->renderHiddenFields(); ?>
</fieldset>

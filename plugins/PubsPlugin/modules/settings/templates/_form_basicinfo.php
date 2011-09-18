<fieldset class="labelLeft">
    <p>
        <label for="postalCode"><?php echo __('Mobil', null, 'setting')?>:</label>
        <?php echo $form['contact']->render() ?>
    </p>
    <div>
        <label for="gender"><?php echo __('Sex', null, 'setting')?>:</label>
       
            <?php echo $form['sex']->render() ?>
        
    </div>
    <p>
        <label for="dateOfBirth"><?php echo __('Date of birth', null, 'setting')?>:</label>
        <?php echo $form['birthday']->render() ?>
        <span class="error">
            <?php echo $form['birthday']->renderError();?>
        </span>
    </p>
        <p>
            <label for="city"><?php echo __('City', null, 'setting')?>:</label>
        <?php echo $form['city']->render() ?>
        </p>
        <p>
            <label for="country"><?php echo __('Country', null, 'setting')?>:</label>
        <?php echo $form['country']->render() ?>
        </p>

        <p>
            <label for="postalCode"><?php echo __('Zip code', null, 'setting')?>:</label>
        <?php echo $form['cp']->render() ?>
    </p>


    <p class="save right">
       
        <button class="button" type="submit"><?php echo __('Save changes', null, 'setting')?>
            <span class="saveSuccess"></span>
        </button>
    </p>
     <?php echo $form->renderHiddenFields(); ?>
</fieldset>
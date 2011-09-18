

<fieldset class="labelLeft">
    <p>
        <label for="music"><?php echo __('Music', null, 'setting')?> </label>
        <?php echo $form['music']->render() ?>
    </p>
    <p>
        <label for="books"><?php echo __('Books', null, 'setting')?></label>
        <?php echo $form['books']->render() ?>
    </p>
     <p>
        <label for="films"><?php echo __('Films', null, 'setting')?></label>
        <?php echo $form['films']->render() ?>
    </p>
     <p>
        <label for="television"><?php echo __('Television', null, 'setting')?></label>
        <?php echo $form['television']->render() ?>
    </p>
      <p>
        <label for="games"><?php echo __('Games', null, 'setting')?></label>
        <?php echo $form['games']->render() ?>
    </p>

    <p class="save right">

        <button class="button" type="submit"><?php echo __("Save changes", null, 'setting')?>
            <span class="saveSuccess"></span>
        </button>
    </p>
     <?php echo $form->renderHiddenFields(); ?>
</fieldset>


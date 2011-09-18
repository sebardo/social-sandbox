
<div class="sidebar">
    <div class="header">
        <h1><?php echo __('Explorer Network', null, 'search') ?> <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span></h1>
    </div>
    <ul>
        <li>
            <p><?php echo __('Sex', null, 'sf_guard') ?>  <?php echo $form['sex']->render(array('class' => 'sex'))?></p>
               
        </li>
        <li>
            <p><?php echo __('Age', null, 'search') ?>
                <?php echo $form['from']->render(array('class' => 'minAge'))?>
                <?php echo __('to', null, 'search') ?>
               <?php echo $form['to']->render(array('class' => 'maxAge'))?>
            </p>
        </li>
<!--        <li>
            <div>
                <?php //echo __('Location', null, 'search') ?>
                <div>
                    <?php //echo $form['country']->render(array('class' => 'country'))?>
                    <select name="RD"><option value="0">Cualquier distancia</option>
                        <option value="10">10 kilómetros</option>
                        <option value="50">50 kilómetros</option>
                        <option value="100">100 kilómetros</option>
                        <option value="150">150 kilómetros</option>
                        <option value="200">200 kilómetros</option>
                    </select>
                </div>
            </div>
        </li>-->
        <li>
            <button style="float: right;margin: 10px 15px 10px 10px;" id="update" class="button" sex="" minAge="" maxAge="" country=""><?php echo __('Update', null, 'search') ?></button>
        </li>
    </ul>
</div>

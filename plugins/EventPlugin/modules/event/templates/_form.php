<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheets_for_form($locationForm) ?>
<?php use_javascripts_for_form($locationForm) ?>
<style type="text/css">
    #contentEventForms {
        overflow: hidden;
        padding: 10px;
        -moz-border-radius:0px 0px 10px 10px;
        -webkit-border-radius:0px 0px 10px 10px;
        border-radius: 0px 0px 10px 10px;
        /*IE 7 AND 8 DO NOT SUPPORT BORDER RADIUS*/
        -moz-box-shadow:2px 2px 5px -2px #000000;
        -webkit-box-shadow:2px 2px 5px -2px #000000;
        box-shadow:2px 2px 5px -2px #000000;
        filter: progid:DXImageTransform.Microsoft.Shadow(strength=2, direction=135, color='#000000');
        -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(strength=2, Direction=135, Color='#000000')";
        /*Shadows look very different in IE (Only cardinal directions supported)*/
        /*INNER ELEMENTS MUST NOT BREAK THIS ELEMENTS BOUNDARIES*/
        /*Element should have a background-color*/
        /*All filters must be placed together*/
        /*IE 7 AND 8 DO NOT SUPPORT BLUR PROPERTY OF SHADOWS*/
        /*IE 7 AND 8 DO NOT SUPPORT SPREAD PROPERTY OF SHADOWS*/
        background-image: -moz-linear-gradient(top, #ffffff, #cccccc);
        background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#cccccc));
        background-image: -o-linear-gradient(top, #ffffff, #cccccc);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#cccccc');
        /*INNER ELEMENTS MUST NOT BREAK THIS ELEMENTS BOUNDARIES*/
        /*Element must have a height (not auto)*/
        /*All filters must be placed together*/
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#cccccc')";
        /*Element must have a height (not auto)*/
        /*All filters must be placed together*/
        background-image: linear-gradient(top, #ffffff, #cccccc);
        -moz-background-clip: padding-box;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        /*Use "background-clip: padding-box" when using rounded corners to avoid the gradient bleeding through the corners*/
        /*--IE9 WILL PLACE THE FILTER ON TOP OF THE ROUNDED CORNERS--*/
    }
    #contentEventForms >div{
        float:left;
        width: 380px;
    }
    .formRow label{
        font-weight: bold;
        float:left;
        width:80px;
    }
    .error_list{
        color:red;
        list-style: none;
    }
    .calendar{
        background: url("/EventPlugin/images/calendar.jpg") no-repeat scroll 0 0 transparent;
        border: medium none;
        cursor: pointer;
        overflow: hidden;
        text-indent: -9999px;
        width: 20px;
    }
</style>
<div id="contentEventForms">
    <div>
        <form action="<?php echo url_for('event/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php if (!$form->getObject()->isNew()): ?>
                <input type="hidden" name="sf_method" value="put" />
            <?php endif; ?>
            <div class="formRow">
                <?php echo $form['name']->renderError(); ?>
                <label><?php echo __('Name:', null, 'event') ?> </label>
                <?php echo $form['name']->render(); ?>
            </div>
            <div class="formRow">
                <?php echo $form['description']->renderError(); ?>
                <label><?php echo __('Description:', null, 'event') ?>  </label>
                <?php echo $form['description']->render(); ?>
            </div>
            <div class="formRow">
                <?php echo $form['date']->renderError(); ?>  
                <?php echo $form['hour']->renderError(); ?>  
                <label><?php echo __('From:', null, 'event') ?> </label>
                <?php echo $form['date']->render(); ?>
                <?php echo $form['hour']->render(); ?>
                <input class="calendar" id="iniDate" type="button" value="Cal" onclick="displayCalendarSelectBox(
                    document.getElementById('event_date_year'),
                    document.getElementById('event_date_month'),
                    document.getElementById('event_date_day'),
                    document.getElementById('event_hour_hour'),
                    document.getElementById('event_hour_minute'),
                    document.getElementById('iniDate'))"/>
            </div>
            <div class="formRow">
                <?php echo $form['end_date']->renderError(); ?>  
                <?php echo $form['end_hour']->renderError(); ?> 
                <label><?php echo __('To:', null, 'event') ?> </label>
                <?php echo $form['end_date']->render(); ?>
                <?php echo $form['end_hour']->render(); ?>
                <input class="calendar" id="endDate" type="button" value="Cal" onclick="displayCalendarSelectBox(
                    document.getElementById('event_end_date_year'),
                    document.getElementById('event_end_date_month'),
                    document.getElementById('event_end_date_day'),
                    document.getElementById('event_end_hour_hour'),
                    document.getElementById('event_end_hour_minute'),
                    document.getElementById('endDate'))"/>
            </div>
            <div class="formRow">
                <?php echo $form['image']->renderError(); ?>
                <label><?php echo __('Image:', null, 'event') ?>  </label>
                <?php echo $form['image']->render(); ?>
            </div>
            <?php echo $form->renderHiddenFields(); ?>  
            <input type="submit" value="<?php echo __('Save', null, 'event') ?>" />
        </form>
    </div>
    <div> 
        <?php if ($form->hasGlobalErrors()): ?>
            <ul class="error_list">
                <li><?php echo __('The address is required.', null, 'event') ?></li>
            </ul>
        <?php endif; ?>
        <form>
            <?php echo $locationForm->renderHiddenFields(); ?>
            <?php echo $locationForm['location']->renderError(); ?>
            <?php echo $locationForm['location']->render(); ?>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#endDate').mousedown(function(){
        $('#event_end_date_day').val($('#event_date_day').val());
        $('#event_end_date_month').val($('#event_date_month').val());
        $('#event_end_date_year').val($('#event_date_year').val());
        $('#event_end_hour_hour').val($('#event_hour_hour').val());
        $('#event_end_hour_minute').val($('#event_hour_minute').val());
    });
</script>
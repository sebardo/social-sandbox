<div id="settingsContainer">
    <div id="settings_left" class="settings_left" >
        <?php include_partial('settings_left', array('datos' => $datos)); ?>
    </div>
    <div id="settings_right" class="settings_right">

        <?php $action = $sf_request->getParameter('config') ?>

        <div class="wrapper">
            <section class="content <?php echo $action ?>">
                <?php
                switch ($action) {
                    case "basicinfo":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Basic Information', null, 'setting')?></h3>
                        <form class="" action="settings?config=basicinfo" method="post">

                            <?php include_partial('form_basicinfo', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "aboutme":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('About me', null, 'setting')?></h3>
                        <form class="" action="settings?config=aboutme" method="post">

                            <?php include_partial('form_aboutme', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "interests":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Interests', null, 'setting')?></h3>
                        <form class="" action="settings?config=interests" method="post">

                            <?php include_partial('form_interests', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "detailinfo":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Details', null, 'setting')?></h3>
                        <form class="" action="settings?config=detailinfo" method="post">

                            <?php include_partial('form_detailinfo', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "name":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Name', null, 'setting')?></h3>
                        <form class="" action="settings?config=name" method="post">

                            <?php include_partial('form_name', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "changepassword":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Change password', null, 'setting')?></h3>
                        <form class="" action="settings?config=changepassword" method="post">

                            <?php include_partial('form_changepassword', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                    case "notifications":
                        ?>
                        <h3 class="sectionHeader"><?php echo __('Notifications', null, 'setting')?></h3>
                        <form class="" action="settings?config=notifications" method="post">

                            <?php include_partial('form_notifications', array('form' => $form)); ?>

                        </form>
                        <?php
                        break;
                }
                ?>
            </section></div>
    </div>
</div>

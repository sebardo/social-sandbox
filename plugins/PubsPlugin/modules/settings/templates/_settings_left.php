
<div class="sidebar">


    <nav class="sidebar">
        <div class="settings-header">
            <h1><?php echo __('Configuration', null, 'setting')?></h1>
        </div>
        <ul>
            <li>
                <p><b><?php echo __('Edit my info', null, 'setting')?></b></p>
            </li>
            <li>
                <ul>
                    <li>
                        <?php echo link_to(__('About me', null, 'setting'), "settings", array('config' => 'aboutme')) ?>
                    </li>
                    <li>
                        <?php echo link_to(__('Interests', null, 'setting'), "settings", array('config' => 'interests')) ?>
                    </li>
                    <li>
                        <?php echo link_to(__('Basic Information', null, 'setting'), "settings", array('config' => 'basicinfo')) ?>
                    </li>
                    <li>
                        <?php echo link_to(__('Details', null, 'setting'), "settings", array('config' => 'detailinfo')) ?>
                    </li>
                </ul>
            </li>
            <li>
                <p><b><?php echo __('Account Settings and Privacy', null, 'setting')?></b></p>
            </li>
            <li>
                <ul>
                    <li>
                        <?php echo link_to(__('Name', null, 'setting'), "settings", array('config' => 'name')) ?>
                    </li>
                    <li>
                        <?php echo link_to(__('Password', null, 'setting'), "settings", array('config' => 'changepassword')) ?>
                    </li>

                </ul>
            </li>
            <li>
                <p><b><?php echo __('Messaging Settings', null, 'setting')?></b></p>
            </li>
            <li>
                <ul>
                    <li>
                        <?php echo link_to(__('Notifications', null, 'setting'), "settings", array('config' => 'notifications')) ?>
                    </li>

                </ul>
            </li>
        </ul>
    </nav>
</div>

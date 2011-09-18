<?php use_helper('I18N') ?>
<?php echo use_stylesheet('/sfDoctrineGuardPlugin/css/sfGuardAuth.css') ?>
<form class="form_signin" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <table>
        <tbody>
            <tr>
                <td colspan="3">
                    <span class="error">
                        <?php if ($form['username']->renderError())
                            echo $form['username']->renderError() ?>
                    </span>
                </td>
                
            </tr>
            <tr>
                <td><label for="signin_username"><?php echo __('Username', null, 'sf_guard') ?></label><br>
                    <?php echo $form['username']->render() ?></td>

                <td><label for="signin_password"><?php echo __('Password', null, 'sf_guard') ?></label><br>
                    <?php echo $form['password']->render() ?></td>
                <td rowspan="2" valign="top">
                    <input type="submit" class="submit" value="<?php echo __('Sign in', null, 'sf_guard') ?>" style="float: right;margin-top: 10px;">
                    <?php echo $form->renderHiddenFields(); ?>
                </td>

            </tr>
            <tr>
                <td><label for="signin_remember"><?php echo __('Remember', null, 'sf_guard') ?></label>
                    <?php echo $form['remember']->render() ?></td>
                <td>
                    <?php $routes = $sf_context->getRouting()->getRoutes() ?>
                    <?php if (isset($routes['sf_guard_forgot_password'])): ?>
                        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
                    <?php endif; ?>
                </td>
            </tr>

        </tbody>
    </table>
</form>
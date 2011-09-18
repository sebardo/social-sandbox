<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <?php if ($sf_user->isAuthenticated()) { ?>
            <?php if ($sf_user->hasCredential('admin')) { ?>
                <div id="menu">
                    <ul>
                        <li><?php echo link_to('Usuarios', '@sf_guard_user') ?></li>
                        <li><?php echo link_to('Pubs', '@pubsAdmin') ?></li>
                        <li><?php echo link_to('Inbox', '@inboxAdmin') ?></li>
                        <li><?php echo link_to('Event', '@eventAdmin') ?></li>
                        <li><?php echo link_to('Photo', '@photoAdmin') ?></li>
                        <li><?php echo link_to('Album', '@albumAdmin') ?></li>
                        <li><?php echo link_to('Follows', '@followAdmin') ?></li>
                        <li><?php echo link_to('Audio', '@audioAdmin') ?></li>
                        <li><?php echo link_to('Comment', '@commentAdmin') ?></li>
                        <li><?php echo link_to('Favlike', '@favlikeAdmin') ?></li>
                        <!--          <ul class="subMenu" id="publiMenu">
                                      <li><?php //echo link_to('Banner', '@banner')       ?></li>
                                      <li><?php //echo link_to('Posicion', '@posicion')       ?></li>
                                      <li><?php //echo link_to('Seccion', '@seccion')       ?></li>
                                      <li><?php //echo link_to('Seccion x Banner', '@seccion_banner')       ?></li>
                                  </ul>-->
                        </li>
                        <li><?php //echo link_to('Localizacion', '@country')       ?>
                            <ul class="subMenu" id="localizacionMenu">
                                <li><?php //echo link_to('Country', '@country')       ?></li>
                                <li><?php //echo link_to('City', '@city')       ?></li>
                            </ul>
                        </li>

                        <li><strong><?php echo link_to('Logout', '@sf_guard_signout') ?></strong></li>
                    </ul>
                </div>
                <?php echo $sf_content ?>
            <?php } else { ?>

                <script type="text/javascript">

                    document.location.href="<?php echo sfConfig::get('app_base_url') ?>logout";

                </script>
            <?php } ?>
        <?php } else { ?>

            Don't have a permission for this area, please log in such as Admin user.
            <table width="350">
                <tr>
                    <td><?php echo get_component('sfGuardAuth', 'signin_form') ?></td>
                </tr>
            </table>

        <?php } ?>

    </body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php if (!has_slot('ogptags')): ?>xmlns="http://www.w3.org/1999/xhtml"<?php else: echo OGPTags::getXmlns();
endif; ?> xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php
        if (has_slot('ogptags')) {
            include_slot('ogptags');
        }
        ?>
        <?php include_metas() ?>
        <title>
            <?php if (!include_slot('title')): ?>
                Social Sandbox - Open Source networking by nordestelabs.com
            <?php endif; ?>
        </title>

        <meta name="Description" content="El Blog de nordestelabs.com (Dario Sebastian Sasturain, Alejandro Magno Baglieri y Adrian Baez)"/>
        <meta name="Keywords" content="NORDESTELABS, nordetelabs, El Portfolio de Dario Sebastian Sasturain, El Portfolio de Alejandro Magno Baglieri, El Portfolio de Alejandro Adrian Baez, Dario Sasturain, Sebastian Sasturain, Sasturain, symfony ,sastu, sebardo , sastu desarrollos, portfolio de nordetelabs, diseño portfolio, sastu graphics, sastuds, SASTU, SASTUDS, SEBARDO, Sastu programacion y desarrollo web 2.0, seguridad informatica, , sebastian sasturain progrmacion  y seguridad, sastu websites, web design, websites, freelance , freelance designer, print, print design, graphics, graphic design, designer, illustration, illustrator, flash, flash designer, flash design, flash websites, e-commerce, e-commerce design, forums, forum design, audio design, seo, search engine optimization, design services, design company"/>


        <link rel="shortcut icon" href="<?php echo sfConfig::get('app_base_url'); ?>PubsPlugin/images/favicon.ico" />
        <script>
            /*variable que toma el app_base_url*/
            var base_url = '<?php echo sfConfig::get('app_base_url'); ?>';
        </script>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="main">
            <?php if ($sf_user->isAuthenticated() && in_array('pubs', sfConfig::get('sf_enabled_modules', array()))) { ?>
                <?php include_component('pubs', 'logged_menubar_container') ?>
            <?php } else { ?>
                <?php include_component('pubs', 'logout_menubar_container') ?>
                <div  style="
                      <?php if (!$sf_request->getParameter('pid')) { ?>float:left<?php } else { ?>float:left<?php } ?>

                      ">

                    <?php if ($sf_user->getFlash('notice') == 'forgot_password') { ?> 
                 
                            <div class="register_ok" style="width: 450px">
                                <div class="subtitle">
                                    <?php echo __('Check your e-mail! You should receive something shortly!') ?>
                                </div>
                            </div>
                     
                    <?php } ?> 
                    <div class="a section" <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="width: 500px"<?php } else { ?>style="width: auto"<?php } ?>>
                        <?php include_partial('nordestelabs/about') ?>  
                    </div>
                    <div class="b section" <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="width: 500px"<?php } else { ?>style="width: auto"<?php } ?>>
                        <?php include_partial('nordestelabs/about_us') ?>  
                    </div>
                    <div class="p section" <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="width: 500px"<?php } else { ?>style="width: auto"<?php } ?>>
                        <?php include_partial('nordestelabs/privacy') ?>
                    </div>
                    <div class="c section" <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="width: 500px"<?php } else { ?>style="width: auto"<?php } ?>>
                        <?php include_partial('nordestelabs/conditions') ?>
                    </div>
                    <div class="s section" 
                         <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="display: block;"<?php } ?>>
                         <?php include_partial('nordestelabs/service') ?>
                    </div>
                    <div class="contact section" <?php if (!$sf_request->getParameter('pid') && !$sf_request->getParameter('user')) { ?>style="width: 500px"<?php } else { ?>style="width: auto"<?php } ?>>
                        <?php include_component('nordestelabs', 'contact') ?>
                    </div>
                </div>


            <?php } ?>
            <?php echo $sf_content ?>


            <div class="footer_menubar_container">
                © 2011 <a title="NordeteLabs.com" href="http://www.nordestelabs.com">NordesteLabs</a> · <a class="sec" rel="about" href="#"><?php echo __('Social SandBox Project', null, 'nordestelabs') ?></a> ·  <a class="sec" rel="privacy" href="#"><?php echo __('Privacy', null, 'nordestelabs') ?></a> · <a class="sec" rel="conditions" href="#"><?php echo __('Terms', null, 'nordestelabs') ?></a> · <a class="sec" rel="service" href="#"><?php echo __('Help us', null, 'nordestelabs') ?></a>
                <div class="content" style="float: right">
                   <?php include_component('language', 'language') ?>
                </div>
            </div>
        </div>
    </body>
</html>

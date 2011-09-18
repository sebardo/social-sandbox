
<div class="dashboard-profile-annotations clearfix">
    <h2 class="dashboard-profile-title" style="font-size: 16px;font-weight: 300;padding-bottom: 6px;display: block;">
      <?php echo image_tag($datos->getImage('48','48','medium'), "width=48")?> <?php echo __('About', null, 'pubs') ?>  <?php echo $datos->getUsername()?></h2>
  </div>
<div class="data-profile" style="overflow: hidden; 
                                 padding-bottom: 10px;
                                 padding-top: 10px; 
                                 width: 265px;
                                 background: none repeat scroll 0 0 #D2D2D2">
    <li style="float: left;
        list-style: none outside none;
        margin-left: 0;
        overflow: hidden;
        padding: 0 12px;"><a href="#" style="text-decoration: none;color: #666666;font-size: 15px;font-weight: bold;"><?php echo Doctrine::getTable('Pubs')->getPubs($datos->getId())?><span class="user-stats-stat" style="color: #444444;font-size: 11px !important;clear: both; display: block; padding: 3px 0;font-weight: lighter !important;"><?php echo __('Pubs', null, 'pubs') ?></span></a></li>
    <li style="border-left: 1px solid #ffffff;
        float: left;
        list-style: none outside none;
        margin-left: 0;
        overflow: hidden;
        padding: 0 12px;"><a href="#" style="text-decoration: none;color: #666666;font-size: 15px;font-weight: bold;"><?php echo count($datos->getFollowing())?><span class="user-stats-stat" style="color: #444444;font-size: 11px !important;clear: both; display: block; padding: 3px 0;font-weight: lighter !important;"><?php echo __('Followins', null, 'follow') ?></span></a></li>
    <li style="border-left: 1px solid #ffffff;
        float: left;
        list-style: none outside none;
        margin-left: 0;
        overflow: hidden;
        padding: 0 12px;"><a href="#" style="text-decoration: none;color: #666666;font-size: 15px;font-weight: bold;"><?php echo count($datos->getFollower())?><span class="user-stats-stat" style="color: #444444;font-size: 11px !important;clear: both; display: block; padding: 3px 0;font-weight: lighter !important;"><?php echo __('Followers', null, 'follow') ?></span></a></li>
</div>


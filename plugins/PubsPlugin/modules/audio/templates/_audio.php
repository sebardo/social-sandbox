<?php $audio = Doctrine_Core::getTable('Audio')->find($id); ?>
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function(){

        $("#jquery_jplayer_<?php echo $id ?>").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3: "<?php echo sfConfig::get('app_base_url') ?>users/<?php echo $audio->User->getUsername() ?>/audios/<?php echo $audio->getFilename() ?>"
                }).jPlayer("stop");
            },
            ended: function (event) {
                $(this).jPlayer("stop");
            },
            swfPath: "/PubsPlugin/js",
            supplied: "mp3",
            cssSelectorAncestor: "#jp_interface_<?php echo $id ?>"
        })
        .bind($.jPlayer.event.play, function() { // Using a jPlayer event to avoid both jPlayers playing together.
            $(this).jPlayer("pauseOthers");
        });
    });
    //]]>
</script>
<div class="pub-audio">
    <div id="jquery_jplayer_<?php echo $id ?>" class="jp-jplayer"></div>
    <div class="jp-audio">
        <div class="jp-type-single">

            <div id="jp_interface_<?php echo $id ?>" class="jp-interface">
                <div class="jp-title"><?php echo $audio->getDescription() ?></div>
                <ul class="jp-controls">
                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>

                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                </ul>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>

                    </div>
                </div>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
                <div class="jp-current-time"></div>
                <div class="jp-duration"></div>
            </div>

        </div>
    </div>

</div> 
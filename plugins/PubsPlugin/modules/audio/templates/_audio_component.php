<link href="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/css/audio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/skin/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
<script src="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/js/jquery.jplayer.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
    //<![CDATA[
    $(document).ready(function(){

        var Playlist = function(instance, playlist, options) {
            var self = this;

            this.instance = instance; // String: To associate specific HTML with this playlist
            this.playlist = playlist; // Array of Objects: The playlist
            this.options = options; // Object: The jPlayer constructor options for this playlist

            this.current = 0;

            this.cssId = {
                jPlayer: "jquery_jplayer_",
                interface: "jp_interface_",
                playlist: "jp_playlist_"
            };
            this.cssSelector = {};

            $.each(this.cssId, function(entity, id) {
                self.cssSelector[entity] = "#" + id + self.instance;
            });

            if(!this.options.cssSelectorAncestor) {
                this.options.cssSelectorAncestor = this.cssSelector.interface;
            }

            $(this.cssSelector.jPlayer).jPlayer(this.options);

            $(this.cssSelector.interface + " .jp-previous").click(function() {
                self.playlistPrev();
                $(this).blur();
                return false;
            });

            $(this.cssSelector.interface + " .jp-next").click(function() {
                self.playlistNext();
                $(this).blur();
                return false;
            });
            $(".del_playlist").click(function() {
                self.playlistDeleteAll();
                return false;
            });
            $(".play").click(function() {
                $(".play").attr('src',base_url+'PubsPlugin/images/play.png');
                var name = $(this).attr("title");
                var val = $(this).attr("name");
                var id = $(this).attr("id");
                self.playlistAddandPlay(name,val);
                $(this).attr('src',base_url+'PubsPlugin/images/pause.png');
                $.post(base_url+"audio/plays?id="+id,
                function(info){
                    $('#plays_'+id).html(info)
                });
                return false;
            });   
            $(".jp-add").click(function() {
                var name = $(this).attr("name");
                var val = $(this).attr("rel");
                self.playlistAdd(name,val);
                return false;
            });
            $(".new_playlist").click(function() {
                self.playlistAddPl(self.audioPlaylist);
                return false;
            });
            $(".jp-add-playlist").click(function() {
                var obj = $(this).attr("rel");
                self.playlistAddtoRep(obj);
                return false;
            });
            $(".play-playlist").click(function() {
                $(".play-playlist").attr('src',base_url+'PubsPlugin/images/play.png');
                var obj = $(this).attr("name");
                var id = $(this).attr("id");
                self.playlistAddtoRepandPlay(obj);
                $(this).attr('src',base_url+'PubsPlugin/images/pause.png');
                $.post(base_url+"audio/listPlays?id="+id,
                function(info){
                    $('#list_plays_'+id).html(info)
                });
                return false;
            });
        };

        Playlist.prototype = {
            displayPlaylist: function() {
                var self = this;
                $(this.cssSelector.playlist + " ul").empty();
                for (i=0; i < this.playlist.length; i++) {
                    var listItem = (i === this.playlist.length-1) ? "<li class='jp-playlist-last'>" : "<li>";
                    listItem += "<a href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";

                    // Create links to free media
                    if(this.playlist[i].free) {
                        var first = true;
                        listItem += "<div class='jp-free-media'>(";
                        $.each(this.playlist[i], function(property,value) {
                            if($.jPlayer.prototype.format[property]) { // Check property is a media format.
                                if(first) {
                                    first = false;
                                } else {
                                    listItem += " | ";
                                }
                                listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";
                            }
                        });
                        listItem += ")</span>";
                    }

                    listItem += "</li>";

                    // Associate playlist items with their media
                    $(this.cssSelector.playlist + " ul").append(listItem);
                    $(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {
                        var index = $(this).data("index");
                        if(self.current !== index) {
                            self.playlistChange(index);
                        } else {
                            $(self.cssSelector.jPlayer).jPlayer("play");
                        }
                        $(this).blur();
                        return false;
                    });

                    // Disable free media links to force access via right click
                    if(this.playlist[i].free) {
                        $.each(this.playlist[i], function(property,value) {
                            if($.jPlayer.prototype.format[property]) { // Check property is a media format.
                                $(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {
                                    var index = $(this).data("index");
                                    $(self.cssSelector.playlist + "_item_" + index).click();
                                    $(this).blur();
                                    return false;
                                });
                            }
                        });
                    }
                }
            },
            playlistInit: function(autoplay) {
                if(autoplay) {
                    this.playlistChange(this.current);
                } else {
                    this.playlistConfig(this.current);
                }
            },
            playlistConfig: function(index) {
                $(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");
                $(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");
                this.current = index;
                $(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
            },
            playlistChange: function(index) {
                this.playlistConfig(index);
                $(this.cssSelector.jPlayer).jPlayer("play");
            },
            playlistNext: function() {
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(index);
            },
            playlistPrev: function() {
                var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;
                this.playlistChange(index);
            },
            playlistDeleteAll: function(index) {
                if(confirm("<?php echo __('Clean my playlist ?', null, 'audio') ?>")){
                    var len = this.playlist.length;
                    this.playlist.splice(0,len);
                    audioPlaylist.displayPlaylist();
                }
            },
            playlistAddandPlay: function(name,val) {
                var len = this.playlist.length;
                this.playlist.splice(0,len);
                audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                audioPlaylist.displayPlaylist();
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(0);
            },
            playlistAdd: function(name,val) {
                if(confirm("<?php echo __('Add', null, 'audio') ?> "+name+" <?php echo __('to my playlist ?', null, 'audio') ?>")){
                    audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                    audioPlaylist.displayPlaylist();
                }
            },
            playlistAddPl: function() {
                if(confirm("<?php echo __('Save this Playlist ?', null, 'audio') ?>")){
                    var status  = this.playlist;
                    var jsonObj = ""; //declare array

                    for (var i = 0; i < status.length; i++) {
                        if(i!=0){
                            jsonObj += ',';
                        }else{
                            jsonObj += '{';
                        }
                        jsonObj += '"'+i+'":{"name":"'+ status[i].name+'", "mp3":"'+ status[i].mp3+'"}';
                    }
                    jsonObj += "}";
                    $.post(base_url+"audio/newPL?obj="+jsonObj,
                    function(info){
                    });
                }
            },
            playlistAddandPlay: function(name,val) {
                var len = this.playlist.length;
                this.playlist.splice(0,len);
                audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                audioPlaylist.displayPlaylist();
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(0);
            },
            playlistAddtoRep: function(obj) {
                if(confirm("<?php echo __('Add playlist to for reproduccion ?', null, 'audio') ?>")){
                   
                    var myObject = JSON.parse(obj);
                    var name = 0;
                    for(var prop in myObject) {
                        if(myObject.hasOwnProperty(prop))
                            var myObject2 = myObject[prop];
                        var i = 0;
                        for(var prop2 in myObject2) {
                            i++;
                            if(myObject2.hasOwnProperty(prop2)){
                                if (i % 2 == 0) {
                                    audioPlaylist.playlist.push({name:name,mp3:myObject2[prop2]});
                                } else {
                                    name = myObject2[prop2];
                                }
                            }
                        }
                    }
                    audioPlaylist.displayPlaylist();
                   
                }
            },
            playlistAddtoRepandPlay: function(obj) {
                
                var len = this.playlist.length;
                this.playlist.splice(0,len);
                var myObject = JSON.parse(obj);
                var name = 0;
                for(var prop in myObject) {
                    if(myObject.hasOwnProperty(prop))
                        var myObject2 = myObject[prop];
                    var i = 0;
                    for(var prop2 in myObject2) {
                        i++;
                        if(myObject2.hasOwnProperty(prop2)){
                            if (i % 2 == 0) {
                                audioPlaylist.playlist.push({name:name,mp3:myObject2[prop2]});
                            } else {
                                name = myObject2[prop2];
                            }
                        }
                    }
                }
                audioPlaylist.displayPlaylist();
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(0);
                 
            }
            
        };

                

        var audioPlaylist = new Playlist("1", [
            
<?php foreach ($audios as $audio): ?>
                {
                    name:"<?php echo $audio->getDescription() ?>",
                    mp3: base_url+"users/<?php echo $datos->getUsername() ?>/audios/<?php echo $audio->getFilename() ?>"
                },
<?php endforeach; ?>
            

        ], {
            ready: function() {
                audioPlaylist.displayPlaylist();
                audioPlaylist.playlistInit(false); // Parameter is a boolean for autoplay.
<?php if ($sf_request->getParameter('autoplay') == 1) { ?>
                    $(this).jPlayer("play");
<?php } ?>
            },
            ended: function() {
                audioPlaylist.playlistNext();
            },
            play: function() {
                $(this).jPlayer("pauseOthers");
            },
            swfPath: "/PubsPlugin/js",
            supplied: "mp3"
        });


    });
    //]]>
    function hola(){
        
        var Playlist = function(instance, playlist, options) {
            var self = this;

            this.instance = instance; // String: To associate specific HTML with this playlist
            this.playlist = playlist; // Array of Objects: The playlist
            this.options = options; // Object: The jPlayer constructor options for this playlist

            this.current = 0;

            this.cssId = {
                jPlayer: "jquery_jplayer_",
                interface: "jp_interface_",
                playlist: "jp_playlist_"
            };
            this.cssSelector = {};

            $.each(this.cssId, function(entity, id) {
                self.cssSelector[entity] = "#" + id + self.instance;
            });

            if(!this.options.cssSelectorAncestor) {
                this.options.cssSelectorAncestor = this.cssSelector.interface;
            }

            $(this.cssSelector.jPlayer).jPlayer(this.options);
                            
            $(this.cssSelector.interface + " .jp-previous").unbind('click');
            $(this.cssSelector.interface + " .jp-previous").click(function() {
                self.playlistPrev();
                $(this).blur();
                return false;
            });
                            
            $(this.cssSelector.interface + " .jp-next").unbind('click');
            $(this.cssSelector.interface + " .jp-next").click(function() {
                self.playlistNext();
                $(this).blur();
                return false;
            });
            $(".del_playlist").unbind('click');
            $(".del_playlist").click(function() {
                //                        alert(self.audioPlaylist);
                self.playlistDeleteAll();
                return false;
            });
            
            $(".play").unbind('click');
            $(".play").click(function() {
                $(".play").attr('src',base_url+'PubsPlugin/images/play.png');
                var name = $(this).attr("title");
                var val = $(this).attr("name");
                var id = $(this).attr("id");
                self.playlistAddandPlay(name,val);
                $(this).attr('src',base_url+'PubsPlugin/images/pause.png');
                $.post(base_url+"audio/plays?id="+id,
                function(info){
                    $('#plays_'+id).html(info)
                });
                return false;
            });   
            $(".jp-add").unbind('click');
            $(".jp-add").click(function() {
                var name = $(this).attr("name");
                var val = $(this).attr("rel");
                self.playlistAdd(name,val);
                return false;
            });
            $(".new_playlist").unbind('click');
            $(".new_playlist").click(function() {
                self.playlistAddPl(self.audioPlaylist);
                return false;
            });
            $(".jp-add-playlist").unbind('click');
            $(".jp-add-playlist").click(function() {
                var obj = $(this).attr("rel");
                self.playlistAddtoRep(obj);
                return false;
            });
            $(".play-playlist").unbind('click');
            $(".play-playlist").click(function() {
                $(".play-playlist").attr('src',base_url+'PubsPlugin/images/play.png');
                var obj = $(this).attr("name");
                var id = $(this).attr("id");
                self.playlistAddtoRepandPlay(obj);
                $(this).attr('src',base_url+'PubsPlugin/images/pause.png');
                $.post(base_url+"audio/listPlays?id="+id,
                function(info){
                    $('#list_plays_'+id).html(info)
                });
                return false;
            });
        };

        Playlist.prototype = {
            displayPlaylist: function() {
                var self = this;
                $(this.cssSelector.playlist + " ul").empty();
                for (i=0; i < this.playlist.length; i++) {
                    var listItem = (i === this.playlist.length-1) ? "<li class='jp-playlist-last'>" : "<li>";
                    listItem += "<a href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";

                    // Create links to free media
                    if(this.playlist[i].free) {
                        var first = true;
                        listItem += "<div class='jp-free-media'>(";
                        $.each(this.playlist[i], function(property,value) {
                            if($.jPlayer.prototype.format[property]) { // Check property is a media format.
                                if(first) {
                                    first = false;
                                } else {
                                    listItem += " | ";
                                }
                                listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";
                            }
                        });
                        listItem += ")</span>";
                    }

                    listItem += "</li>";

                    // Associate playlist items with their media
                    $(this.cssSelector.playlist + " ul").append(listItem);
                    $(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {
                        var index = $(this).data("index");
                        if(self.current !== index) {
                            self.playlistChange(index);
                        } else {
                            $(self.cssSelector.jPlayer).jPlayer("play");
                        }
                        $(this).blur();
                        return false;
                    });

                    // Disable free media links to force access via right click
                    if(this.playlist[i].free) {
                        $.each(this.playlist[i], function(property,value) {
                            if($.jPlayer.prototype.format[property]) { // Check property is a media format.
                                $(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {
                                    var index = $(this).data("index");
                                    $(self.cssSelector.playlist + "_item_" + index).click();
                                    $(this).blur();
                                    return false;
                                });
                            }
                        });
                    }
                }
            },
            playlistInit: function(autoplay) {
                if(autoplay) {
                    this.playlistChange(this.current);
                } else {
                    this.playlistConfig(this.current);
                }
            },
            playlistConfig: function(index) {
                $(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");
                $(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");
                this.current = index;
                $(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
            },
            playlistChange: function(index) {
                this.playlistConfig(index);
                $(this.cssSelector.jPlayer).jPlayer("play");
            },
            playlistNext: function() {
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(index);
            },
            playlistPrev: function() {
                var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;
                this.playlistChange(index);
            },
            playlistDeleteAll: function(index) {
                if(confirm("<?php echo __('Clean my playlist ?', null, 'audio') ?>")){
                    var len = this.playlist.length;
                    this.playlist.splice(0,len);
                    audioPlaylist.displayPlaylist();
                }
            },
            playlistAddandPlay: function(name,val) {
                var len = this.playlist.length;
                this.playlist.splice(0,len);
                audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                audioPlaylist.displayPlaylist();
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(0);
            },
            playlistAdd: function(name,val) {
                if(confirm("<?php echo __('Add', null, 'audio') ?> "+name+" <?php echo __('to my playlist ?', null, 'audio') ?>")){
                    audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                    audioPlaylist.displayPlaylist();
                }
            },
            playlistAddPl: function() {
                if(confirm("<?php echo __('Save this Playlist ?', null, 'audio') ?>")){
                    var status  = this.playlist;
                    var jsonObj = ""; //declare array

                    for (var i = 0; i < status.length; i++) {
                        if(i!=0){
                            jsonObj += ',';
                        }else{
                            jsonObj += '{';
                        }
                        jsonObj += '"'+i+'":{"name":"'+ status[i].name+'", "mp3":"'+ status[i].mp3+'"}';
                    }
                    jsonObj += "}";
                    $.post(base_url+"audio/newPL?obj="+jsonObj,
                    function(info){
                    });
                }
            },
            playlistAddandPlay: function(name,val) {
                var len = this.playlist.length;
                this.playlist.splice(0,len);
                audioPlaylist.playlist.push({name:name,mp3:base_url+"users/<?php echo $sf_user->getGuardUser()->getUsername() ?>/audios/"+val});
                audioPlaylist.displayPlaylist();
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(0);
                $('#jquery_jplayer_1').jPlayer("play");
            },
            playlistAddtoRep: function(obj) {
                if(confirm("<?php echo __('Add playlist to for reproduccion ?', null, 'audio') ?>")){
                   
                    var myObject = JSON.parse(obj);
                    var name = 0;
                    for(var prop in myObject) {
                        if(myObject.hasOwnProperty(prop))
                            var myObject2 = myObject[prop];
                        var i = 0;
                        for(var prop2 in myObject2) {
                            i++;
                            if(myObject2.hasOwnProperty(prop2)){
                                if (i % 2 == 0) {
                                    audioPlaylist.playlist.push({name:name,mp3:myObject2[prop2]});
                                } else {
                                    name = myObject2[prop2];
                                }
                            }
                        }
                    }
                    audioPlaylist.displayPlaylist();
                   
                }
            }
        };

        var audioPlaylist = new Playlist("1", [
            
<?php foreach ($audios as $audio): ?>
                {
                    name:"<?php echo $audio->getDescription() ?>",
                    mp3: base_url+"users/<?php echo $datos->getUsername() ?>/audios/<?php echo $audio->getFilename() ?>"
                },
<?php endforeach; ?>
            

        ], {
            ready: function() {
                audioPlaylist.displayPlaylist();
                audioPlaylist.playlistInit(false); // Parameter is a boolean for autoplay.
<?php if ($sf_request->getParameter('autoplay') == 1) { ?>
                    $(this).jPlayer("play");
<?php } ?>
            },
            ended: function() {
                audioPlaylist.playlistNext();
            },
            play: function() {
                $(this).jPlayer("pauseOthers");
            },
            swfPath: "/PubsPlugin/js",
            supplied: "mp3"
        });
        
    }
</script>


<div id="jquery_jplayer_1" class="jp-jplayer"></div>

<div class="jp-audio">
    <div class="jp-type-playlist">
        <div id="jp_interface_1" class="jp-interface">
            <ul class="jp-controls">
                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                <li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                <li><a href="#" class="jp-previous" tabindex="1">previous</a></li>
                <li><a href="#" class="jp-next" tabindex="1">next</a></li>
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
        <div id="jp_playlist_1" class="jp-playlist">
            <ul>
                <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                <li></li>
            </ul>
        </div>
    </div>
</div>
<div class="playlist-actions">
    <a class="button del_playlist" href="#" style="display: none">
        <span class="del"></span>
        <em style="" class="wrapper">
            <b><?php echo __('Del All', null, 'audio') ?></b>
        </em>

    </a>
    <a style="display: none" class="button new_playlist" href="<?php echo url_for('audio/newPL') ?>">
        <span class="add-audio"></span>
        <em style="" class="wrapper">
            <b><?php echo __('Add Playlist', null, 'audio') ?></b>
        </em>

    </a>
</div>

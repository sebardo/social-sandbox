<?php use_stylesheet('/EventPlugin/css/event.css')?>
<style type="text/css">
    #contCalendar td, #contCalendar th{
        vertical-align: middle;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        border: 1px solid #999999;
    }
    #contCalendar td{
        /*        background: #CCCCCC;*/
        border: none;
        padding: 0;
    }

    #contCalendar th{
        color:#EEEEEE;
        background: #999999; /* Old browsers */
        background: -moz-linear-gradient(top, #999999 0%, #555555 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#999999), color-stop(100%,#555555)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #999999 0%,#555555 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #999999 0%,#555555 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(top, #999999 0%,#555555 100%); /* IE10+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#999999', endColorstr='#555555',GradientType=0 ); /* IE6-9 */
        background: linear-gradient(top, #999999 0%,#555555 100%); /* W3C */
    }
    #contCalendar td.day{
        padding:5px;
        border: 1px solid #CCCCCC;
        background: #f7f7f7; /* Old browsers */
        background: -moz-linear-gradient(top, #f7f7f7 0%, #999999 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f7f7f7), color-stop(100%,#999999)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #f7f7f7 0%,#999999 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #f7f7f7 0%,#999999 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(top, #f7f7f7 0%,#999999 100%); /* IE10+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#999999',GradientType=0 ); /* IE6-9 */
        background: linear-gradient(top, #f7f7f7 0%,#999999 100%); /* W3C */
    }
    #contCalendar td.is-today{
        border: 1px solid #CC0000;
    }
    #contCalendar td.has-events{
        cursor: pointer;
        border-color: #293E6A;
    }
    #contCalendar .has-events:active{
        -moz-box-shadow:inset 1px 1px 5px #000000;
        -webkit-box-shadow:inset 1px 1px 5px #000000;
        box-shadow:inset 1px 1px 5px #000000;

    }
    #contCalendar .has-events:hover{
        background: #999999; 
    }
    #contCalendar .event{
        display: none;
        position: absolute;
        top:0;
    }
    #contCalendar .calendar-event-container{
        position: relative;
    }
    #contCalendar table{
        /*        border: 1px solid;*/
        margin: auto;
        padding: 5px;
        width: 100%;
        background: #f7f7f7; /* Old browsers */
        background: -moz-linear-gradient(bottom, #f7f7f7 0%, #999999 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0%,#f7f7f7), color-stop(100%,#999999)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(bottom, #f7f7f7 0%,#999999 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(bottom, #f7f7f7 0%,#999999 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(bottom, #f7f7f7 0%,#999999 100%); /* IE10+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#999999', endColorstr='#f7f7f7',GradientType=0 ); /* IE6-9 */
        background: linear-gradient(bottom, #f7f7f7 0%,#999999 100%); /* W3C */
    }
    #contCalendar table.calendar{
        border: none;
        padding: 0;
    }
    #contCalendar{
        width: 210px;
        position:relative;
    }
    #closeCalendarForm{
        border: 1px solid;
        color: #555555;
        font-size: 10px;
        height: 0.7em;
        line-height: 0.4em;
        font-weight: bold;
        padding: 1px;
        position: absolute;
        right: 0;
        top: 0;
    }

</style>
<div id="contCalendar">
    <div id="contCalendarForm" style="display:none;position:absolute;z-index:1"><a href="#" id="closeCalendarForm">x</a><?php echo $calendar->renderForm(); ?></div>
    <table class="calendar" cellspacing="0">
        <tr>
            <td><?php echo $calendar->renderHead(); ?></td>
        </tr>
        <tr>
            <td><?php echo $calendar->renderCalendar(); ?></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    var $hasEvents=$('#contCalendar td.has-events')
    $hasEvents.click(
    function(){
        var $events=$(this).find('.event');
        var isVisible=$events.css('display')=='none';
        for(var i=0;i<$events.length;i++){
            $events.filter(':eq('+i+')').animate({
                opacity:'toggle',
                //              height: 'toggle',
                top: (isVisible?i*($(this).outerHeight()):0)
            }, 'slow', function() {
                // Animation complete.
            }).css({zIndex: 1000+i});
        }
    });
    var options={};
<?php if (isset($params['user_id'])): ?>
        options.user=<?php echo $params['user_id']; ?>;
<?php endif; ?>
    $('.nextMonth, .previousMonth').click(function(e){
        var $contCalendar=$('#contCalendar');
        $contCalendar.parent().fadeTo('fast',.5);
        e.preventDefault();
        $.post('/event/getCalendar'+$(this).attr('href'),options,function(data){
            $contCalendar.parent().fadeTo('fast',1);
            $contCalendar.parent().html(data);
        });
    });
    
    var $actualMonth =$('.actualMonth');
    var actualMonthContent=$actualMonth.html();
    $actualMonth.html('<a class="showCalendarForm" href="#">'+actualMonthContent+'</a>');
    var $contCalendarForm = $('#contCalendarForm');
    var $contCalendar=$('#contCalendar');
    var oldMonth=$('#calendarForm select[name=month]').val();
    var oldYear=$('#calendarForm select[name=year]').val();
    
    $('.showCalendarForm').click(function(e){
        e.preventDefault();
        var offset=$contCalendar.offset();
        var yBegin=e.pageY-offset.top;
        var xBegin=e.pageX-offset.left;
        var yEnd=$('#calendarHead').outerHeight();
        var xEnd=($contCalendar.outerWidth()-$contCalendarForm.outerWidth())/2;
        var isVisible=$contCalendarForm.css('display')!='none';
        if(!isVisible){
            $contCalendarForm.css({left: xBegin,top:yBegin});
        }
        $contCalendarForm.animate({
            opacity:'toggle',
            height: 'toggle',
            width: 'toggle',
            left:(!isVisible?xEnd:xBegin),
            top:(!isVisible?yEnd:yBegin)
        }, 'fast', function() {});
    });
    $('#closeCalendarForm').click(function(){
        $('.showCalendarForm').click();
    });
    $('#calendarForm').submit(function(e){
        $('.showCalendarForm').click();
        e.preventDefault();
        var $contCalendar=$('#contCalendar');
        options.month=$('#calendarForm select[name=month]').val();
        options.year=$('#calendarForm select[name=year]').val();
        if(!(oldMonth==options.month&&oldYear==options.year)){
            $contCalendar.parent().fadeTo('slow',.5);
            $.post('/event/getCalendar',options,function(data){
                $contCalendar.parent().fadeTo('slow',1);
                $contCalendar.parent().html(data);
            });
        }
    });
</script>
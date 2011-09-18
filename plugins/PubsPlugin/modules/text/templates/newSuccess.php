<style type="text/css">
    table, .help{font-family: "lucida grande",tahoma,verdana,arial,sans-serif;font-size: 12px;}
    table{width: 100%;}
    .help{color: #999999;padding-bottom: 5px;display: block;}
    .new_photo{text-align: center;}
    .button{
        float: right;
        -moz-border-radius: 4px 4px 4px 4px;
        background: url("/PubsPlugin/images/bg-btn.gif") repeat-x scroll 0 0 #DDDDDD;
        border-color: #BBBBBB #BBBBBB #999999;
        border-style: solid;
        border-width: 1px;
        color: #333333;
        cursor: pointer;
        margin: 0;
        overflow: hidden;
        padding: 5px 9px;
        text-shadow: 0 1px #F0F0F0;
    }
    form textarea {
        height: 80px;
        width: 345px;
    }
</style>
<?php include_partial('form', array('form' => $form, 'duid' => $sf_request->getParameter('duid'))) ?>

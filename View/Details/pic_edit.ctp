<?= $this->Html->css('jquery-ui-1.8.4.custom');?>
<?= $this->Html->script('swfobject');?>
<?php echo $this->Html->css('uploadify'); ?>
<? echo $this->Html->script('jquery.uploadify.v2.1.4.min');?>
<p id="profile_pic_p">here<p>

<div class="profile_picture_edit">


<script type="text/javascript">


// <![CDATA[

jQuery(document).ready(function() {

  jQuery('#file_upload').uploadify({

    'uploader'  : '/payroll/swf/uploadify.swf',

    'script'    : '/payroll/details/upload_pic/',

    'cancelImg' : '/payroll/img/cancel.png',

    'folder'    : '/payroll/files/pic',

    'auto'      : true,
    'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
    'sizeLimit'   : 204800,
    'onComplete': function(event,id,fileObj,response,data){
        //console.log(fileObj);
       // var responseObj = jQuery.parseJSON(response);
       // console.log(responseObj);
        //jQuery('#upload-complete').html(responseObj.message);
        jQuery('#profile_pic_p').html(response);
        jQuery('#VideoName').val(responseObj.name);
        jQuery('.submit input').attr('disabled',false);
    },
    'buttonText': 'Choose image',



  });

});

// ]]>
jQuery('.dashboard_left_link').css('font-weight','normal');
jQuery('#settings').css('font-weight','bold');
jQuery('.dashboard_popup').css('display','none');
</script>


<input id="file_upload"  type="file" name="file_upload" />
<span><a href="javascript:jQuery('#file_upload').uploadifyUpload()">Upload Image</a></span> 

</div>
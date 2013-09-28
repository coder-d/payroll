 <? 
 $path='/files/pic/medium/'.$file_new_name.'.jpg';
echo $this->Html->image($path,array('alt'=>'Profile pic'));

echo $this->Js->writeBuffer(); ?>


<script language="javascript" type="text/javascript">

    jQuery().ready(function() {
    
 jQuery('#employee_display_top_image_<?=$employee_id;?>').html('<? $path="/files/pic/small/".$file_new_name.".jpg";
echo $this->Html->image($path,array("alt"=>"Profile pic","width"=>"24px","height"=>"31px"));?>');
  
  });      
</script>

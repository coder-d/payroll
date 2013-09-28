<?= $this->Js->link('Edit',
      array('controller' => 'employees', 'action' => 'personal_details_edit',3),
      array(
         'update' => '#personal_details_hide',
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   );
 echo $this->Js->writeBuffer();  
?>



<div id="personal_details_hide">
    </div>

<div id="newslinks">
<a href="/payroll/details/raw_ajax_test">Raw Ajax Link</a>   
 <script>   
$('#newslinks a').click(function() {
var url=$(this).attr('href');


$.get(url,updateDivs);
return false;
});  

function updateDivs(data){
	
var myhtml =data;
var node = $(myhtml);
$(node).append(myhtml);

var headlines_content=$(node).find('div#newsDiv').html();
var secondHeadlines_content=$(node).find('div#newsItem').html();
$('#headlines').html(secondHeadlines_content);
$('#secondHeadlines').html(headlines_content);
}
</script>


<div id="headlines">No headlines</div>

</div>

<div id="secondHeadlines">No second headlines</div>
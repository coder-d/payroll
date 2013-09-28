<?= $this->Html->css('jquery-ui-1.8.11.custom');?>
<?= $this->Html->css('fullcalendar');?>
<?= $this->Html->script('fullcalendar.min');?>


<div class="calendar" id="calendar_<?=$employee_id;?>">
   <script type='text/javascript'>

    jQuery(document).ready(function() {
	
		
		jQuery('#calendar_<?=$employee_id;?>').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
	 height: 400,
			theme:true,
			  eventSources: [
        '/<?=APP_DIR;?>/employees/view_attendance_calendar/<?=$employee_id;?>'
            ],
		 prev: 'circle-triangle-w',
    next: 'circle-triangle-e',
    
   
eventRender: function(event, element) {                                          
	element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());					  
}    
    
		});
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#view_attendance_li_<?=$employee_id;?>').css('font-weight','bold');		
	});



</script>
  
</div>

 
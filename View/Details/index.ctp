Hello World!!!

<p id="post">Here!
 <?php echo $this->Html->image('loading.gif', array('id' => 'busy-indicator','style'=>array('display:none'))); ?>   
</p>
<p>

<?php
   echo $this->Js->link('update',
      array('controller' => 'details', 'action' => 'ajax_test'),
      array(
         'update' => '#post',
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   );
?>
<?php
$this->Js->event('click', 'alert("whoa!");', false);?>
</p>  
<ul id="my-list">
<li>1</li>
<li>2</li>
<li>3</li>
<li>4</li>
</ul>
<a href="#" id="list">List</a>
<?=$this->Js->get('#list')->event('click',$this->Js->request(array('action' => 'ajax_test'), array('async' => true,'update' => '#my-list')));?>

<div id="element_boundary" style="width:500px;height:500px;border:1px solid blue">
<div id="element" style="width:200px;height:200px;border:1px solid red"></div>
</div>
<?=$this->Js->get('#element')->drag(array('container' => '#element_boundary','snapGrid' => array(10, 10),    'wrapCallbacks' => false));?>
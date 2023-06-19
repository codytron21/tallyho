<?php
/* @var $this ParticipantController */
/* @var $participant Participant */
/* @var $form CActiveForm */
?>
<!-- TODO:
	Currently there is some sort of constraint between participant and match object (why? donno).
	Moreover the foreign key reference is inconsitent for the player id. Some place it in int(11)
	to be filled by an auto-incremented number and some places it is email ID. I guess it needs
	to be changed to email ID everywhere.
-->

<?php 
	$this->headers[0] = "Enrol";
	
	$this->menu=array(
		array('label'=>'Back to Tour', 'url'=>array('/category/default/index', 'tid'=>$participant->tour_id)),
	);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'participant-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<h4>Check the Tournament & Category information before confirming</h4>
		
	<table>
		<tr>
			<td>
				<?php echo $form->labelEx($tour,'location'); ?>
			</td><td>
				<?php echo $form->hiddenField($participant,'tour_id'); ?>
				<?php echo $tour->location;?>
			</td>
		</tr>
		<tr>	
			<td>
				<?php echo $form->labelEx($tour,'start_date'); ?>
			</td><td>
				<?php echo date_format(date_create($tour->start_date), 'd M Y');?>
			</td>
		</tr>
		<tr>		
			<td>
				<?php echo $form->hiddenField($participant,'seed');	?>
				<?php echo $form->labelEx($participant,'category'); ?>
			</td><td>
				<?php echo $form->hiddenField($participant,'category'); ?>
				<?php echo Lookup::item('AgeGroup', $participant->category)?>
				<?php echo $form->error($participant,'category'); ?>
			</td>
	</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($participant,'player_id'); ?>
			</td><td>
				<?php echo $form->hiddenField($participant,'player_id'); ?>
				<?php echo Yii::app()->user->data()->username; ?>
				<?php echo $form->error($participant,'player_id'); ?>
			</td>
		</tr>
		<tr>
			<td colspan=2><br>
				<?php echo CHtml::submitButton('Confirm & Save', array('style' => 'width:100%;')); ?>
			</td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div><!-- form -->
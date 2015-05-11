<?php
/**
 * AccessCounter edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Form->hidden('AccessCounterFrameSetting.id', array(
		'value' => isset($accessCounterFrameSetting['id']) ? (int)$accessCounterFrameSetting['id'] : null,
	)); ?>

<?php echo $this->Form->hidden('AccessCounterFrameSetting.frame_key', array(
		'value' => $frameKey,
	)); ?>

<?php echo $this->Form->hidden('Frame.id', array(
		'value' => $frameId,
	)); ?>

<?php echo $this->Form->hidden('Frame.key', array(
		'value' => $frameKey,
	)); ?>

<div class='form-group'>
	<?php echo $this->Form->label('AccessCounterFrameSetting.display_type',
			__d('access_counters', 'Display type')
		); ?>

	<?php echo $this->Form->hidden('AccessCounterFrameSetting.display_type', array(
			'ng-value' => 'counterFrameSetting.displayType'
		)); ?>
	<?php $this->Form->unlockField('AccessCounterFrameSetting.display_type'); ?>

	<div class="btn-group nc-input-dropdown">
		<button type="button" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
			<div class="clearfix">
				<div class="pull-left">
					<?php for ($i = 0; $i < 10; $i++) : ?>
						<span class="label label-{{currentDisplayTypeName}}">
							<?php echo $i ?>
						</span>
					<?php endfor; ?>
				</div>
				<div class="pull-right">
					<span class="caret"> </span>
				</div>
			</div>
		</button>

		<ul class="dropdown-menu text-left" role="menu"
			ng-init="displayTypes = <?php echo h(json_encode(AccessCounterFrameSetting::$displayTypes)); ?>">

			<li ng-repeat="displayType in displayTypes track by $index" ng-class="{active: (($index + 1) == counterFrameSetting.displayType)}">

				<a class="text-left" href="" ng-click="selectDisplayType($index, displayType)">
					<?php for ($i = 0; $i < 10; $i++) : ?>
						<span class="label label-{{displayType}}">
							<?php echo $i ?>
						</span>
					<?php endfor; ?>
				</a>
			</li>
		</ul>
	</div>
</div>

<div class='form-group'>
	<?php
		for ($i = AccessCounterFrameSetting::DISPLAY_DIGIT_MIN; $i <= AccessCounterFrameSetting::DISPLAY_DIGIT_MAX; $i++) {
			$options[$i] = $i;
		}
	?>

	<?php echo $this->Form->input('AccessCounterFrameSetting.display_digit',
		array(
			'label' => __d('access_counters', 'Display digit'),
			'type' => 'select',
			'error' => false,
			'class' => 'form-control',
			'options' => $options,
			'selected' => (int)$accessCounterFrameSetting['displayDigit']
		)); ?>

	<?php echo $this->element(
		'NetCommons.errors', [
			'errors' => $this->validationErrors,
			'model' => 'AccessCounterFrameSetting',
			'field' => 'display_digit',
		]); ?>
</div>
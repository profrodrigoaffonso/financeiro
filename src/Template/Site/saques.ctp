<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saque $saque
 */
?>
<div class="container">
	<h1 class="text-center">Saques</h1>
	<?php foreach ($contador as $ct):?>
		<h3><?=$ct['banco']?> - <?=$ct['count']?></h3>
	<?php endforeach ?>
    <?= $this->Form->create($saque, ["autocomplete"=>"off"]) ?>
    <div class="form-group">
        <?= $this->Form->control('bank_id', ["label"=>"Banco", 'options' => $banks, "class"=>"form-control","required"]);?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('value',["label"=>"Valor","class"=>"form-control","required"]);?>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

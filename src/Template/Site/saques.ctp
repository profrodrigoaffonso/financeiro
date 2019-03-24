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
        <?= $this->Form->control('bank_id', ["empty"=>true,"label"=>"Banco", 'options' => $banks, "class"=>"form-control","required"]);?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('value',["type"=>"text", "label"=>"Valor","class"=>"form-control","required"]);?>
    </div>
    <div class="form-group">
        <div class=col-xs-6 style="margin-left: 0px;">
            <?=$this->Form->control("date_saque",["type"=>"text", "label"=>"Data","value"=>date("d/m/Y"),"class"=>"form-control","required","autocomplete"=>"off","readonly"])?>
        </div>
        <div class=col-xs-6>
            <?=$this->Form->control("hour_saque",["label"=>"Hora","value"=>date("H:i"),"class"=>"form-control","required","autocomplete"=>"off"])?>
        </div>

      </div><br><br>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>

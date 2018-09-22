<div class="container">
	<h3>Exportar</h3>
    <?= $this->Form->create() ?>
    <div class="form-group">
    	<?php
            echo $this->Form->control('month', ['label'=>'Mês', 'class'=>'form-control', 'options' => $months, 'empty' => true]);
        ?>
  	</div>    
    <?= $this->Form->button(__('Submit'),["class"=>"btn btn-default"]) ?>
    <?= $this->Form->end() ?>
</div>



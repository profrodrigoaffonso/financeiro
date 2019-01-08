<div class="container">
	<h1 class="text-center">Redefinir senha</h1>
	<?=$this->Form->create("payment",["autocomplete"=>"off"])?>
	  <div class="form-group">
	  	<?=$this->Form->control("password",["class"=>"form-control","required"])?>
	  </div>
	  	  <button type="submit" class="btn btn-default btn-primary" id="inserir">Salvar</button>

	<?=$this->Form->end()?>
	  
</div>

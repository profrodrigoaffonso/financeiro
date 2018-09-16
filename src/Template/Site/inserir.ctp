<div class="container">
	<h1 class="text-center">Inserir valor</h1>
	<?=$this->Form->create()?>
	  <div class="form-group">
	  	<?=$this->Form->control("category_id",["options"=>$categories,"empty"=>true,"label"=>"Categoria","class"=>"form-control","required"])?>
	  </div>
	  <div class="form-group">
	  	<?=$this->Form->control("form_payment_id",["options"=>$form_payments,"empty"=>true,"label"=>"Forma de pagamento","class"=>"form-control","required"])?>
	  </div>
	  <div class="form-group">
	  	<?=$this->Form->control("value",["label"=>"Valor","class"=>"form-control","required"])?>
	  </div>
	  <div class="form-group">
	  	<?=$this->Form->control("date_payment",["label"=>"Data","value"=>date("d/m/Y"),"class"=>"form-control","required","autocomplete"=>"off","readonly"])?>
	  </div>
	  <div class="form-group">
	  	<?=$this->Form->control("hour_payment",["label"=>"Hora","value"=>date("H:i"),"class"=>"form-control","required","autocomplete"=>"off"])?>
	  </div>
	  <div class="form-group">
	  	<?=$this->Form->control("obs",["type"=>"textarea", "label"=>"Obs","class"=>"form-control"])?>
	  </div>
	 
	  <button type="submit" class="btn btn-default btn-primary" id="inserir">Submit</button>
	<?=$this->Form->end();?>
</div>
<div class="container">

  <?=$this->Form->create("form",["class"=>"form-signin"])?>
    <h2 class="form-signin-heading">Login</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <!-- <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <button class="btn btn-lg btn-default btn-block" id="bt_esqueci" type="button">Esqueci a senha</button>
  <?=$this->Form->end()?>

</div> <!-- /container -->
<div class="modal fade" tabindex="-1" id="modal_esqueci" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informe seu e-mail</h4>
      </div>
      <div class="modal-body">
        <?=$this->Form->create('esqueci',['url'=>['controller'=>'users','action'=>'esqueci']])?>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" required name="email" placeholder="Email">
          </div>
          
          <button type="submit" class="btn btn-default">Enviar</button>
        <?=$this->Form->end()?>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php
namespace App\Controller;

use App\Controller\AppController;

class SiteController extends AppController
{

    public function inserir($uuid=null)
    {

    	if(!$uuid){
    		return $this->redirect(["controller"=>"site","action"=>"nao_autorizado"]);
    	}

    	$this->loadModel("Users");

    	$user = $this->Users->find()
    		->where(["uuid"=>$uuid])
    		->first();

    	if(!$user){
    		return $this->redirect(["controller"=>"site","action"=>"nao_autorizado"]);
    	}

    	$this->loadModel("Categories");
    	$this->loadModel("FormPayments");

    	if($this->request->is(["post","put"])){
    		$this->loadModel("Payments");
    		$payment = $this->Payments->newEntity();
    		$payment = $this->Payments->patchEntity($payment, $this->request->getData());
    		//die($payment->date_payment);
    		$payment->date_payment = $this->dateDb($payment->date_payment)." {$payment->hour_payment}";
    		$payment->value = $this->numberToDb($payment->value);

    		$payment->user_id = $user->id;
    		if ($this->Payments->save($payment)) {
                $this->Flash->success(__('Pagamento inserido com sucesso.'));

                return $this->redirect(['action' => 'inserir',$uuid]);
            }

    	}

    	$categories = $this->Categories->find("list");
    	$form_payments = $this->FormPayments->find("list");

    	$this->set(compact("categories","form_payments"));

    	return $this->render("inserir","site");

    }

    public function naoAutorizado(){
    	return $this->render("nao_autorizado","site");
    }
}

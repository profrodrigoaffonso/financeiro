<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class SiteController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->getEventManager()->off($this->Csrf);
    }

    public function inserir($uuid=null)
    {
        // é obrigatório ter o identificador do usuário
    	if(!$uuid){
    		return $this->redirect(["controller"=>"site","action"=>"nao_autorizado"]);
    	}

        // verifica o usuário
    	$this->loadModel("Users");

    	$user = $this->Users->find()
    		->where(["uuid"=>$uuid])
    		->first();

    	if(!$user){
    		return $this->redirect(["controller"=>"site","action"=>"nao_autorizado"]);
    	}

    	$this->loadModel("Categories");
    	$this->loadModel("FormPayments");

        // insere os dados
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


    public function ajaxCalculo(){

        //$this->eventManager()->off($this->Csrf);

        // if($this->request->is('post')){
        //     die('aa');
        // }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $n = 12;
            $i = 0.005;
            $pmt = 500;
            $fv = 0;


            //die($i);

            for($c=1;$c<=$n;$c++){
                
                $fv = $fv * ($i + 1);
                
                $fv += $pmt; 
                
            }

            echo number_format($fv,2,',','.');
            die;
        }
        
    }

    public function naoAutorizado(){
    	return $this->render("nao_autorizado","site");
    }

    
}

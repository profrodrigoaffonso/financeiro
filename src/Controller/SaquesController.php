<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Saques Controller
 *
 * @property \App\Model\Table\SaquesTable $Saques
 *
 * @method \App\Model\Entity\Saque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaquesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($mes=null,$ano=null)
    {
        $session = $this->request->getSession();

        if(!$mes)
            $mes = date('m');

        if(!$ano)
            $ano = date('Y');

        $nome_mes = $this->nomeMes($mes);

        $user_id = $session->read("User")->id;

        $this->paginate = [
            'contain' => ['Banks'],
            'conditions'=>[
                'MONTH(Saques.created)' => $mes,
                'YEAR(Saques.created)' => $ano,
                'Saques.user_id' => $user_id
            ]
        ];
        $saques = $this->paginate($this->Saques);

        $totais = $this->Saques->getConnection()->execute (
            "SELECT 
                Banks.name AS `Banks__name`, 
                COUNT(Saques.bank_id) AS qt , 
                SUM(Saques.value) AS valor 
            FROM saques Saques            
            LEFT JOIN banks Banks ON Banks.id = (Saques.bank_id) 
            WHERE MONTH(Saques.created) = {$mes}
            AND YEAR(Saques.created) = {$ano}
            AND Saques.user_id = {$user_id}
            GROUP BY Saques.bank_id");

        $meses = $this->arrMes;
        $anos = $this->arrAnos;

        $this->set(compact('saques','totais','nome_mes','mes','ano','meses','anos'));
    }

    /**
     * View method
     *
     * @param string|null $id Saque id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $saque = $this->Saques->get($id, [
            'contain' => ['Banks']
        ]);

        $this->set('saque', $saque);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saque = $this->Saques->newEntity();
        if ($this->request->is('post')) {
            $saque = $this->Saques->patchEntity($saque, $this->request->getData());
            if ($this->Saques->save($saque)) {
                $this->Flash->success(__('The saque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The saque could not be saved. Please, try again.'));
        }
        $banks = $this->Saques->Banks->find('list', ['limit' => 200]);
        $this->set(compact('saque', 'banks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Saque id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saque = $this->Saques->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saque = $this->Saques->patchEntity($saque, $this->request->getData());
            if ($this->Saques->save($saque)) {
                $this->Flash->success(__('The saque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The saque could not be saved. Please, try again.'));
        }
        $banks = $this->Saques->Banks->find('list', ['limit' => 200]);
        $this->set(compact('saque', 'banks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Saque id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saque = $this->Saques->get($id);
        if ($this->Saques->delete($saque)) {
            $this->Flash->success(__('The saque has been deleted.'));
        } else {
            $this->Flash->error(__('The saque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

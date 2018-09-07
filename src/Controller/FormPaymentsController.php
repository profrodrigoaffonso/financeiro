<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FormPayments Controller
 *
 * @property \App\Model\Table\FormPaymentsTable $FormPayments
 *
 * @method \App\Model\Entity\FormPayment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FormPaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $formPayments = $this->paginate($this->FormPayments);

        $this->set(compact('formPayments'));
    }

    /**
     * View method
     *
     * @param string|null $id Form Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formPayment = $this->FormPayments->get($id, [
            'contain' => ['Values']
        ]);

        $this->set('formPayment', $formPayment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formPayment = $this->FormPayments->newEntity();
        if ($this->request->is('post')) {
            $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());
            if ($this->FormPayments->save($formPayment)) {
                $this->Flash->success(__('The form payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form payment could not be saved. Please, try again.'));
        }
        $this->set(compact('formPayment'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Form Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formPayment = $this->FormPayments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());
            if ($this->FormPayments->save($formPayment)) {
                $this->Flash->success(__('The form payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form payment could not be saved. Please, try again.'));
        }
        $this->set(compact('formPayment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Form Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formPayment = $this->FormPayments->get($id);
        if ($this->FormPayments->delete($formPayment)) {
            $this->Flash->success(__('The form payment has been deleted.'));
        } else {
            $this->Flash->error(__('The form payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

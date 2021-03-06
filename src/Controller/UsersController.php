<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

use Cake\Mailer\Email;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Values']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->uuid = uniqid();
            $user->password = Security::hash($user->password, "md5");
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $user = $this->Users->find()
                ->where([
                    'password'=>Security::hash($data['password'], 'md5'),
                    'OR'=>[
                        ["login"=>$data['login']],
                        ["email"=>$data['login']]
                    ]
                ])
                ->first();
            if($user){
                $session = $this->request->getSession();
                $session->write("User",$user);
                return $this->redirect(["controller"=>"pages","action"=>"display","home"]);
            }else{
                $this->Flash->error("Usu??rio e/ou senha inv??lidos");
                return $this->redirect(["controller"=>"users","action"=>"login"]);
            }

        }
        

        return $this->render("login","login");

    }

    public function logout()
    {

        $session = $this->request->getSession();

        if($session->check("User")){
            $session->delete("User");
        }
        return $this->redirect(["controller"=>"users","action"=>"login"]);

    }

    public function esqueci()
    {

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $user = $this->Users->find()
                ->where(['email'=>$data['email']])
                ->first();

            if($user){

                //die;

                $email = new Email();

                $email->setFrom(["contato@profracosta.com.br" =>"contato"])
                    ->setTransport('default')
                    ->setTo(trim($data['email']))            
                    ->setSubject("Esqueci a senha")
                    ->setEmailFormat('html');

                $this->loadModel('ForgotPasswords');
                $this->ForgotPasswords->updateAll(['active'=>0],['user_id'=>$user->id]);

                $uuid = uniqid();                


                $forgot = $this->ForgotPasswords->newEntity();

                $forgot->user_id = $user->id;
                $forgot->uuid = $uuid;  
                

                $body = "<html>                
                <body>
                    <p>Clique no link abaixo (ou copie e cole na barra de endere??o do navegador)</p>
                    <p>http://".$_SERVER["HTTP_HOST"]."/users/redefinir_senha/{$uuid}</p>                
                </body>
                </html>";

                if($email->send($body)){
                    $this->ForgotPasswords->save($forgot);
                }

                $this->Flash->success("Se seu e-mail estiver cadastrado ser?? enviado um link para redefinir a senha");
                return $this->redirect(["controller"=>"users","action"=>"login"]);



            }
        }

    }

    public function redefinirSenha($uuid=null)
    {

        if(!$uuid){
            $this->redirect(['action'=>'login']);
        }

        $this->loadModel('ForgotPasswords');

        $forgot = $this->ForgotPasswords->find()
            ->where([
                'ForgotPasswords.uuid'=>$uuid,
                'ForgotPasswords.active'=>1
            ])
            ->first();


        if(!$forgot){
            $this->Flash->error("Link expirado!");
            $this->redirect(['action'=>'login']);
        }

         // debug($forgot->user['password']);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->get($forgot->user_id);

            $data = $this->request->getData();

            $user->password = md5($data['password']);
            $forgot->active = 0;

            $this->ForgotPasswords->save($forgot);
            $this->Users->save($user);

            $this->Flash->success("Senha redefinida");
            $this->redirect(['action'=>'login']);



        }

        return $this->render("redefinir_senha","site");

    }
}

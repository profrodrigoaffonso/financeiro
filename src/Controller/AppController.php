<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Csrf');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);        

        // paginas que não precisa de login
        $whiteList = [
            'users/add',
            'users/login',
            'users/esqueci',
            'payments/pdf',
            'users/logout',
            'site/inserir',
            'site/saques',
            'users/redefinirSenha',
            'site/naoAutorizado',
            'site/ajaxCalculo'
        ];

        // verifica a página atual
        $current_page = strtolower($this->request->getParam("controller")).'/'.$this->request->getParam("action");

        // verifica se a página atual não pertence a whiteList
        if(!in_array($current_page, $whiteList)){
            
            // caso não pertença verifica se o usuário está logado
            $session = $this->request->getSession();

            if(!$session->check("User")){
                // se não estiver redireciona para a página de login
                $this->Flash->error("Realize o login");
                return $this->redirect(["controller"=>"users","action"=>"login"]);
            }

        }
    }

    public function dateDb($date){ // formata a data para inserir no banco de dados
        return substr($date, 6, 4).'-'.substr($date, 3, 2).'-'.substr($date, 0, 2);
    }

    public function numberToDb($number){ // formata o número para inserir no banco de dados
        return str_replace(",", ".", $number);
    }
}

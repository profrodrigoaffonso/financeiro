<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Cake\Mailer\Email;
use Endroid\QrCode\QrCode;


/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{

    public function pdf()
    {


        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml('hello world');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();


        die;

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $session = $this->request->getSession();
        $where = [];
        $where['Payments.user_id'] = $session->read("User")->id;
        $payments = [];

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();


            $where["date_payment >="] = $this->dateDb($data['de'])." 00:00:00";
            $where["date_payment <="] = $this->dateDb($data['ate'])." 23:59:59";

            //debug($where);die;

            $payments = $this->Payments->find()
                ->contain(['Users', 'FormPayments', 'Categories'])
                ->where($where);
            //debug($payments);
            $this->paginate = [
                'limit'=>1000
            ];
            $payments = $this->paginate($payments);
        }

        $this->set(compact('payments'));
        $this->set("styles",["/jquery-ui/jquery-ui.min.css"]);
        $this->set("scripts",["/jquery-ui/external/jquery/jquery.js","/jquery-ui/jquery-ui.min.js","/js/payment-index.js"]);
    }

    public function delFiles(){
        $path = WWW_ROOT."excel/";

        //$path = "arquivos/";
        $diretorio = dir($path);
         
        //echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
            while($arquivo = $diretorio -> read()){
                if($arquivo!='.'&&$arquivo!='..'&&$arquivo!='empty'){
                    echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
                    unlink($path.$arquivo);
                }

            }
        $diretorio -> close();
        die;
    }


    public function sendEmail(){

        $session = $this->request->getSession();

        $email = new Email();

        $email->setFrom(["contato@profracosta.com.br" =>"contato"])
            ->setTransport('default')
            ->setTo(trim('profrodrigoaffonso@gmail.com','Rodrigo'))            
            ->setSubject("Link do site")
            ->setEmailFormat('html');

        $body = '<html>        
        <body>
        <img src="http://'.$_SERVER['HTTP_HOST'].'qrcodes/'.$session->read("User")->uuid.'.png">
        <p>Ou clique</p>
        <p>http://'.$_SERVER['HTTP_HOST'].'/site/inserir/'.$session->read("User")->uuid.'</p>
        </body>
        </html>';


        $email->send($body);

        $this->redirect(['action'=>'qrcode']);
    }

    public function qrcode(){

        $session = $this->request->getSession();

        $url = 'http://'.$_SERVER['HTTP_HOST'].'/site/inserir/'.$session->read("User")->uuid;
        

        $qrCode = new QrCode($url);

        $arquivo = "qrcodes/".$session->read("User")->uuid.".png";

        $qrCode->writeFile(WWW_ROOT.$arquivo);

      
        $this->set(compact('url','arquivo'));
    }


    public function export()
    {
        $session = $this->request->getSession();
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValueByColumnAndRow(1, 1, "Categoria");
            $sheet->setCellValueByColumnAndRow(2, 1, "Valor");
            $sheet->setCellValueByColumnAndRow(3, 1, "Forma de pagamento");
            $sheet->setCellValueByColumnAndRow(4, 1, "Data");
            $sheet->setCellValueByColumnAndRow(5, 1, "Hora");
            $sheet->setCellValueByColumnAndRow(6, 1, "Obs");


            $data = $this->request->getData();

            $where = [];
            $where['Payments.user_id'] = $session->read("User")->id;

            $where['MONTH(date_payment)'] = $data['month'];

            $payments = $this->Payments->find()
                ->contain(["Categories","FormPayments"])
                ->where($where)
                ->order([
                    "Categories.name"=>"ASC",
                    "date_payment"=>"ASC"
                ]);

                // debug($payments);

            $i = 2;

            foreach ($payments as $key => $payment) {
                //debug($payment->category->name);
               //echo $payment->category->name;

                $sheet->setCellValueByColumnAndRow(1, $i, $payment->category->name);
                $sheet->setCellValueByColumnAndRow(2, $i, $payment->value);
                $sheet->setCellValueByColumnAndRow(3, $i, $payment->form_payment->name);
                $sheet->setCellValueByColumnAndRow(4, $i, date("d/m/Y", strtotime($payment->date_payment)));
                $sheet->setCellValueByColumnAndRow(5, $i, date("H:i", strtotime($payment->date_payment)));
                $sheet->setCellValueByColumnAndRow(6, $i, $payment->obs);

                $i++;
            }

            $writer = new Xlsx($spreadsheet);

                $file = WWW_ROOT."excel".DS.uniqid().".xlsx";
                $writer->save($file);                

                $response = $this->response->withFile(
                    $file,
                    ['download' => true, 'name' => 'Cadastro_export.xlsx']
                );

                //unlink($file);

                return $response;

        }
        $months = [
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        //asort($months);

        $this->set(compact('months'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Users', 'FormPayments', 'Categories']
        ]);

        $this->set('payment', $payment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $formPayments = $this->Payments->FormPayments->find('list', ['limit' => 200]);
        $categories = $this->Payments->Categories->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users', 'formPayments', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $formPayments = $this->Payments->FormPayments->find('list', ['limit' => 200]);
        $categories = $this->Payments->Categories->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users', 'formPayments', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

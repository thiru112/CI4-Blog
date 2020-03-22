<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends BaseController
{

    public function __construct()
    {
        $helper_arrays = ['form', 'session', 'cookie', 'phpjwt'];
        helper($helper_arrays);
    }

    public function index()
    {
        $sess = session();
        $sess->start();
        if (isset($_SESSION['session-id']) and $_SESSION['session-id'] != NULL) {
            return redirect()->to(base_url());
        } else {
            echo view('templates/header');
            echo view('login');
            echo view('templates/footer');
        }
    }

    public function auth()
    {
        if ($this->request->getMethod() == 'post') {
            $session = session();
            $user_model = new UserModel();
            $auth_data = array(
                'user_name' => $this->request->getPost('uname'),
                'user_pass' => $this->request->getPost('password')
            );
            $val = $user_model->verify($auth_data);
            if ($val === 1) {
                $session->start();
                $session->setFlashdata('auth', '1');
                $user_id_result = $user_model->getUserId($this->request->getPost('uname'));
                $user_id = $user_id_result['user_rand_id'];
                $cookie = create_jwt($user_id);
                $session->set('session-id', $cookie);
                return redirect()->to(base_url()); //->setCookie('sess',$cookie,time()+3600);
            } else {
                $session->start();
                $session->setFlashdata('auth', '0');
                echo view('templates/header');
                echo view('login');
                echo view('templates/footer');
            }
        } else {
            return redirect()->to(base_url());
        }
    }
}

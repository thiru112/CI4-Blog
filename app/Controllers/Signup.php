<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Controller;

class Signup extends Controller
{
    /*
    * Making the helpers available to all methods
    */

    public function __construct()
    {
        $helper_arrays = ['form', 'session', 'url', 'text'];
        helper($helper_arrays);
    }

    /*
    *   Inflating signup page
    */
    public function index()
    {
        echo view('templates/header');
        echo view('signup');
        echo view('templates/footer');
    }

    /*
    *   Intializing the validation and session library;
    *   Validating and showing errors
    */

    public function register()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'e_mail' => ['label' => 'E-mail', 'rules' => 'required|valid_email'],
            'uname' => ['label' => 'Username', 'rules' => 'required|alpha_numeric'],
            'passwd' => ['label' => 'Password', 'rules' => 'required|min_length[5]'],
            'confirm_pass' => ['label' => 'Confirm Password', 'rules' => 'required|matches[passwd]']
        ]);
        $session = \Config\Services::session();
        $session->start();
        if ($this->request->getMethod() == 'post') {
            $u_model = new UserModel();
            $username_val = $u_model->getUniqueUsername($this->request->getPost('uname'));
            // echo var_dump($username_val);die;
            if ($validation->withRequest($this->request)->run() === FALSE || $username_val != NULL) {
                if ($username_val != NULL) {
                    $session->setFlashdata('username', 'Username already taken');
                }
                echo view('templates/header');
                echo view('signup');
                echo view('templates/footer');
            } else {
                $hash_pass = password_hash($this->request->getPost('passwd'), PASSWORD_BCRYPT);
                $random_id = random_string('alnum', 32);
                $san_data = array(
                        'user_name' => esc($this->request->getPost('uname')),
                        'user_mail' => esc($this->request->getPost('e_mail')),
                        'user_pass' => $hash_pass,
                        'user_rand_id' => $random_id
                );
                $u_model->insertSignupData($san_data);
                $session->setFlashdata('Success', 'Successfully registered');
                redirect('login');
            }
        } else {
            return redirect('signup');
            die;
        }
    }
}

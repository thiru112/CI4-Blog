<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use CodeIgniter\Config\Config;

class Useraction extends BaseController
{

    public function __construct()
    {
        $helpers = ['phpjwt', 'form'];
        helper($helpers);
        $con_sess = session();
        $con_sess->start();
    }

    public static function session_check()
    {
        $u_sess = session();
        $u_sess->start();
        if ($u_sess->has('session-id') and $_SESSION['session-id'] != NULL) {
            $payload = (string) $u_sess->get('session-id');
            $sign_verify = (array) verify_jwt($payload);
            $expiration = $sign_verify['exp'];
            $not_before = $sign_verify['nbf'];
            $u_id = $sign_verify['id'];
            if ($expiration >= time() and $not_before <= time()) {
                return $sign_verify;
            } else {
                $u_sess->destroy();
                return redirect()->to(base_url());
            }
        } else {
            $u_sess->destroy();
            return redirect()->route('');
        }
    }

    public function profile()
    {
        $u_sess = session();
        $u_sess->start();
        if ($u_sess->has('session-id') and $_SESSION['session-id'] != NULL) {
            $payload = (string) $u_sess->get('session-id');
            $sign_verify = (array) verify_jwt($payload);
            $expiration = $sign_verify['exp'];
            $not_before = $sign_verify['nbf'];
            $u_id = $sign_verify['id'];
            if ($expiration >= time() and $not_before <= time()) {
                $post_model = new PostModel();
                // $post_model->getPostCurrentUser($u_id);
                echo view('templates/header');
                echo view('users/profile');
                echo view('templates/footer');
            } else {
                $u_sess->destroy();
                return redirect()->to(base_url());
            }
        } else {
            $u_sess->destroy();
            return redirect()->route('');
        }
    }

    public function post()
    {
        $p_sess = session();
        $p_sess->start();
        if ($p_sess->has('session-id')) {
            $user_model = new UserModel();
            $cat_data = $user_model->getCategoryDetails();
            if (!empty($cat_data)) {
                $data['cat_options'] = $cat_data;
                echo view('templates/header');
                echo view('users/post', $data);
                echo view('templates/footer');
            }
        } else {
            return redirect()->to(base_url());
        }
    }

    public function prof_data()
    {
        $pro_sess = session();
        $pro_sess->start();
        Useraction::session_check();
        if ($this->request->isAJAX()) {
            $jwt_token = (string) $pro_sess->get('session-id'); //$this->request->getGet('sess');
            $jwt_decoded = (array) verify_jwt($jwt_token);
            $user_rand_id = $jwt_decoded['id'];
            $usermodel = new UserModel();
            $data = $usermodel->getUserDetails($user_rand_id);
            return $this->response->setHeader(csrf_header(), csrf_hash())->setBody(json_encode($data));
        }
    }

    public function update_profile()
    {
        $jwt_decoded = Useraction::session_check();
        if ($this->request->isAJAX()) {
            $user_rand_id = $jwt_decoded['id'];
            $user_data = (array) json_decode($this->request->getPost('user_data'));
            $user_model = new UserModel();
            $user_model->setUserData($user_rand_id, $user_data);
            return $this->response->setHeader(csrf_header(), csrf_hash())->setBody('{"msg":"success"}');
        }
    }

    public function pass_change()
    {
        $pass_sess = session();
        $pass_sess->start();
        $jwt_decoded = Useraction::session_check();
        $user_rand_id = $jwt_decoded['id'];
        $old_pass = $this->request->getPost('old_pass');
        $new_pass1 = $this->request->getPost('pass1');
        $new_pass2 = $this->request->getPost('pass2');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'pass1' => ['rules' => 'required|min_length[5]'],
            'pass2' => ['rules' => 'required|min_length[5]|matches[pass1]']
        ]);

        $user_model = new UserModel();
        $verification = $user_model->verify_old_pass($user_rand_id, $old_pass);
        if ($validation->withRequest($this->request)->run() === FALSE) {
            echo view('templates/header');
            echo view('users/profile');
            echo view('templates/footer');
        } else {
            if ($verification) {
                $hash_pass = password_hash($new_pass2, PASSWORD_BCRYPT);
                $affected_rows = $user_model->updatePassword($user_rand_id, $hash_pass);
                $pass_sess->setFlashdata('success', 'Password Updated successfully');
                return redirect()->route('users/profile');
            }
            $pass_sess->setFlashdata('old', 'Not correct old password');
            echo view('templates/header');
            echo view('users/profile');
            echo view('templates/footer');
        }
    }

    public function categories()
    {
        $sess_check = (array) Useraction::session_check();
        $user_rand_id = $sess_check['id'];
        if ($sess_check != NULL && $sess_check != '') {
            $user_model = new UserModel();
            $category = $user_model->getCategoryDetails();
            $data['cat'] = $category;
            echo view('templates/header');
            echo view('users/categories', $data);
            echo view('templates/footer');
        }
    }

    public function cat_create()
    {
        $valid = \Config\Services::validation();
        $sess_check = (array) Useraction::session_check();
        $user_rand_id = $sess_check['id'];
        if ($this->request->isAJAX()) {
            if ($sess_check != NULL && $sess_check != '') {
                $user_model = new UserModel();
                $un_san_data = json_decode($this->request->getPost('cat_data'), true);
                $san_cat_data = esc($un_san_data, 'html');
                $san_cat_id = esc($user_rand_id, 'html');
                $cat_data = array(
                    'cat_name'  => $san_cat_data['category_name'],
                    'cat_created_by'    => $san_cat_id
                );
                if ($valid->run($un_san_data,'categoryvalid') === FALSE) {
                    $error = $valid->getErrors();
                    $error['msg'] = 'error';
                    return $this->response->setHeader(csrf_header(),csrf_hash())->setBody(json_encode($error));
                } else {
                    $aff_rows = $user_model->setCategory($cat_data);
                    if ($aff_rows != 0) {
                        return $this->response->setHeader(csrf_header(), csrf_hash())->setBody('{"msg":"success"}');
                    } else {
                        return $this->response->setHeader(csrf_header(), csrf_hash())->setBody('{"msg":"failed"}');
                    }
                }
            }
        }
    }

    public function signout()
    {
        $sess = session();
        $sess->destroy();
        return redirect()->to(base_url());
    }
}

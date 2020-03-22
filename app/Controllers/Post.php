<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Useraction;
use App\Models\PostModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Post extends BaseController
{

    public function __construct()
    {
        $helpers = array('phpjwt', 'form');
        helper($helpers);
    }

    public function create()
    {
        $ses = session();
        $ses->start();
        $val = \Config\Services::validation();
        $jwt_token = (string) $ses->get('session-id');
        $jwt_token = (array) verify_jwt($jwt_token);
        $user_rand_id = esc($jwt_token["id"]);
        if (is_null($user_rand_id) || empty($user_rand_id)) {
            $ses->destroy();
            return redirect()->route('');
        } else {
            $time = (array) Time::now('Asia/Kolkata', 'en_US');
            $un_san_post_data = array(
                "post_title" => $this->request->getPost("post_title"),
                "post_content"  => $this->request->getPost("post_content"),
                "post_category" => $this->request->getPost("post_category")
            );
            $san_post_data = esc($un_san_post_data);
            $val->setRuleGroup('postvalid');
            if ($val->withRequest($this->request)->run() === FALSE) {
                $user_model = new UserModel();
                $category = $user_model->getCategoryDetails();
                $data['cat_options'] = $category;
                echo view('templates/header');
                echo view('users/post', $data);
                echo view('templates/footer');
            } else {
                $post_data = array(
                    "blog_title" => $san_post_data["post_title"],
                    "blog_body"  => $san_post_data["post_content"],
                    "user_rand_id" => $user_rand_id,
                    "blog_created_time" => $time["date"],
                    "post_category" => $san_post_data["post_category"]
                );
                $post_model = new PostModel();
                $post_model->insertPost($post_data);
                return redirect()->route('users/profile')->with('posted', "Posted Sucessfully");
            }
        }
    }

    public function delete($blog_id)
    {
      $sess = session();
      $sess->start();
      $jwt_token = Useraction::session_check();
      $user_rand_id = $jwt_token['id'];
      if(is_null($blog_id) || empty($blog_id))
      {
        return redirect()->to(base_url());
        die;
      }
      else
      {
        $post_model = new PostModel();
        $deleted = $post_model->verfiyPostUser($blog_id, $user_rand_id);
        if($deleted == null || $deleted == 0)
        {
          $sess->destroy();
          return redirect()->to(base_url());
        }
        else
        {
          $post_model = new PostModel();
          $affected_rows = $post_model->deletePost($blog_id);
          if($affected_rows)
          {
            return redirect()->route('users/profile')->with('post_deleted','Deleted Successfully');
          }
          else
          {
            return redirect()->route('users/profile')->with('error','Error Occurred');
          }
        }
      }
    }
}

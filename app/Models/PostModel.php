<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    public function __construct()
    {
        $helpers = array('text');
        helper($helpers);
    }

    public static function insertCategory(string $blog_id, array $cat_values)
    {
        $db = db_connect();
        $builder = $db->table('cat_blog');
        $cat_insert = array();
        foreach ($cat_values as $key => $value) {
            $cat_insert_single = array(
                'blog_id' => $blog_id,
                'cat_name' => $value
            );
            array_push($cat_insert, $cat_insert_single);
        }
        $builder->insertBatch($cat_insert);
        $db->close();
    }

    public function insertPost(array $values)
    {
        $db = db_connect();
        $builder = $db->table('blog');
        $random_blog_id = random_string('alnum', 16);
        $blog_insert = array(
            'blog_id'    => $random_blog_id,
            'blog_title' => $values['blog_title'],
            'blog_body'  => $values['blog_body'],
            'blog_created_time' => $values['blog_created_time'],
            'user_rand_id' => $values['user_rand_id']
        );
        $builder->insert($blog_insert);
        $db->close();
        PostModel::insertCategory($random_blog_id, $values['post_category']);
        return $db->affectedRows();
    }

    public function getAllPost(string $user_rand_id = 'default')
    {
        $db = db_connect();
        $builder = $db->table('blog');
        $blog_ids = array();
        if ($user_rand_id === 'default') {
            $query = $builder->select(['blog_id', 'blog_title', 'blog_body', 'blog_created_time'])->get();
        } else {
            $query = $builder->select(['blog_id', 'blog_title', 'blog_body', 'blog_created_time'])->where(['user_rand_id' => $user_rand_id])->get();
        }
        $blogs = $query->getResultArray();
        if (is_null($blogs)) {
            return null;
        } else {
            foreach ($blogs as $key => $value) {
                array_push($blog_ids, $blogs[$key]['blog_id']);
            }
            $categories = PostModel::returnCategories($blog_ids);
            $cat_id_name = array();
            foreach ($categories as $key => $values) {
                $blog_id_cat = $key;
                foreach ($values as $key => $value) {
                    $cat_id_name[$blog_id_cat][] = $value['cat_name'];
                }
            }
            return array($cat_id_name, $blogs);
        }
    }

    public static function returnCategories(array $blog_id)
    {
        $db = db_connect();
        $builder = $db->table('cat_blog');
        $blog_id_cat = array();
        foreach ($blog_id as $key => $value) {
            $query = $builder->select(['cat_name'])->where(['blog_id' => $value])->get();
            $blog_id_cat[$value] = $query->getResultArray();
        }
        $db->close();
        return $blog_id_cat;
    }

    public function verfiyPostUser($blog_id, $user_rand_id)
    {
      $db = db_connect()  ;
      $builder = $db->table('blog');
      $query = $builder->select(['blog_id'])->where(['user_rand_id' => $user_rand_id, 'blog_id' => $blog_id])->get();
      return $db->affectedRows();
    }

    public function deletePost($blog_id)
    {
      $db = db_connect();
      $builder = $db->table('blog');
      $query = $builder->delete(['blog_id' => $blog_id]);
      $builders = $db->table('cat_blog');
      $query = $builders->delete(['blog_id' => $blog_id]);
      return $db->affectedRows();
    }
}

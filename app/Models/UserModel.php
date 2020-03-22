<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    public function __construct()
    {
        $helpers = ['cookie'];
        helper($helpers);
    }

    public function getUniqueUsername($user_name)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $builder->select('user_name')->where(['user_name' => $user_name]);
        $query = $builder->get();
        return $query->getRowArray();
        $db->close();
    }

    public function insertSignupData(array $data)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $builder->insert($data);
        $db->close();
        return 1;
    }

    public function verify(array $auth_data)
    {
        $user_name = $auth_data['user_name'];
        $user_pass = $auth_data['user_pass'];
        $verify_bool = UserModel::retriveHash($user_name, $user_pass);
        return $verify_bool;
    }
    public static function retriveHash(string $username, string $userpass)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->select('user_pass')->where(['user_name' => $username])->limit(1)->get();
        $row_count = $builder->countAllResults();
        if ($row_count === 0) {
            return 0; //user does not exsist
        } else {
            $hash = $query->getRowArray();
            if (password_verify($userpass, $hash['user_pass'])) {
                return 1; //user is validated
            } else {
                return 0; // invalid password
            }
        }
        $db->close();
    }

    public function getUserId(string $usernm)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->select('user_rand_id')->where(['user_name' => $usernm])->limit(1)->get();
        return $query->getRowArray();
        $db->close();
    }

    public function getUserName(string $user_rand_id)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->select('user_name')->where(['user_rand_id' => $user_rand_id])->limit(1)->get();
        return $query->getRowArray();
        $db->close();
    }

    public function getUserDetails(string $user_rand_id)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->select('user_fname, user_lname, user_about')->where(['user_rand_id' => $user_rand_id])->limit(1)->get();
        return $query->getRowArray();
        $db->close();
    }

    public function setUserData(string $user_rand_id, array $user_data)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $builder->update($user_data, ['user_rand_id' => $user_rand_id]);
        return $db->affectedRows();
        $db->close();
    }

    public function verify_old_pass(string $user_rand_id, string $pass)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->select('user_pass')->where(['user_rand_id' => $user_rand_id])->limit(1)->get();
        $result = $query->getRowArray();
        $hash = $result['user_pass'];
        if (password_verify($pass, $hash)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updatePassword(string $user_rand_id, string $hashed_pass)
    {
        $db = db_connect();
        $builder = $db->table('users');
        $query = $builder->update(['user_pass' => $hashed_pass], ['user_rand_id' => $user_rand_id]);
        return $db->affectedRows();
        $db->close();
    }

    public function getCategoryDetails()
    {
        $db = db_connect();
        $builder = $db->table('category');
        $query = $builder->select(['cat_id','cat_name'])->get();
        return $query->getResultArray();
        $db->close();
    }

    public function setCategory(array $category)
    {
        $db = db_connect();
        $builder = $db->table('category');
        $lower = strtolower($category['cat_name']);
        $query = $builder->selectCount('cat_name')->where(['cat_name ' => $lower])->get();
        $res = $query->getRowArray();
        $results = (int)$res['cat_name'];
        if ($results > 0) {
            return 0;
        } else {
            $builder->insert($category);
            return 1;
        }
        $db->close();
    }
}

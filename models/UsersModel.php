<?php

class UsersModel
{

    public function getUsers($functionParams, $queryParams)
    {
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("SELECT id, username, password, email, fullname, is_admin, is_active FROM booker_users");
            $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertUser($functionParams, $post)
    {
        $id = 0;
        $this->validateEmpty($post,['fullname', 'email', 'username', 'password']);
        $fullname = $post['fullname'];
        $email = $post['email'];
        $username = $post['username'];
        $password = $post['password'];
        $is_admin = ($post['is_admin'] == 'true') ? 1 : 0;
        $is_active = '1';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            http_response_code(400);
            throw new Exception('The email is invalid!');
        }
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("INSERT INTO booker_users(id, fullname, email, username, password, is_admin, is_active)"
                ." VALUE(?, ?, ?, ?, ?, ?, ?)");
            $result = $mysql->insert([0, $fullname, $email, $username, $password, $is_admin, $is_active]);
            return $result;
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    private function validateEmpty($array, $names)
    {
        foreach($names as $name)
        {
            if (!(isset($array[$name]) && $array[$name])){
                http_response_code(400);
                throw new Exception('Field '.$name.' is empty!');
            }
        }
    }

    private function validateNumber($array, $names)
    {
        foreach($names as $name)
        {
            if (!(isset($array[$name]) && $array[$name])){
                http_response_code(400);
                throw new Exception('Field '.$name.' is not numeric!');
            }
        }
    }

    public function updateUser($functionParams, $post)
    {
        $id = $post['id'];
        $fullname = $post['fullname'];
        $email = $post['email'];
        $username = $post['username'];
        $password = $post['password'];
        $is_admin = ($post['is_admin'] == 'true') ? 1 : 0;
        $is_active = '1';
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("UPDATE booker_users SET fullname=?, email=?, username=?, password=?, is_admin=?"
                ." WHERE id=?");
            $result = $mysql->update([$fullname, $email, $username, $password, $is_admin, $id]);
            return $result;
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteUser($functionParams, $post)
    {
        $id = $post['id'];
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("UPDATE booker_users SET is_active=0"
                ." WHERE id=?");
            $result = $mysql->update([$id]);
            return $result;
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function login($post)
    {
        $username = $post['username'];
        $password = $post['password'];
        try 
        {
        $mysql = new MySQL();
        $mysql->setSql("SELECT id, username, password, email, fullname, is_admin, is_active FROM booker_users"
        ." WHERE username='$username' AND password='$password'");
        $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        $user = $result->fetch(PDO::FETCH_OBJ);
        if (! $user)
        {
                http_response_code(401);
                throw new Exception('Login is not right');
        }
        return $user;
    }
}
<?php
namespace App\Controllers;
// use App\Core\Model;
use App\Model\User;
use App\Core\Controller;


class Home extends Controller
{
    public function index(){
        $model = new User();
        $data['name'] = "ahmad";
        $data['email'] = "ahamed@gmail.com";
        $data['password'] = "ahamed123";

        // $users = $model->insert($data);
        // show($users);

        return $this->view('home');
    }
}
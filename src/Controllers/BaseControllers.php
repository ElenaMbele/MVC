<?php

abstract class BaseControllers
{
    protected $session;
    protected $view;
    protected $user;

    public function __construct()
    {
        $this->session = new Session();
        $this->view = new Render();
        $this->user = $this->getUser();
    }

    protected function redirect($url)
    {
        header('Location: /mvc/public' . $url);
        exit();
    }

    protected function getUser()
    {
        if(empty($_SESSION['user_id'])) {
            return null;
        }

        $modelUser = new Users();
        $res =  $modelUser->getUserById($_SESSION['user_id']);
        $isAdmin = false;
        if ($res['user_name'] === 'ADMIN') {
            $isAdmin = true;
        }
        $res['isAdmin'] = $isAdmin;
        return $res;

    }

}
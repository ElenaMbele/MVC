<?php
class Application
{
    public function __construct()
    {
        $this->session();
        $this->loader();
        $this->db();
    }

    protected function loader()
    {
        require_once SRC_DIRECTORY.'/Tools/Session.php';
        require_once SRC_DIRECTORY.'/Tools/Render.php';
        require_once SRC_DIRECTORY.'/Models/BaseModel.php';
        require_once SRC_DIRECTORY.'/Models/Users.php';
        require_once SRC_DIRECTORY.'/Models/Messages.php';
        require_once SRC_DIRECTORY . '/Controllers/BaseControllers.php';
        require_once SRC_DIRECTORY . '/Controllers/AdminControllers.php';
        require_once SRC_DIRECTORY . '/config/main.php';
        require_once SRC_DIRECTORY . '/../vendor/autoload.php';

    }

    protected function db()
    {
        $database = database();
        BaseModel::init($database);
    }

    protected function session()
    {
        session_start();
    }

    public function run()
    {
        $route = explode("/", $_SERVER['REQUEST_URI']);
        if($route[3] == "") {
            echo 'Main Page';
        } else if($route[3] == "admin" && !empty($_POST)) {
            $controllers = new AdminControllers();
            $controllers->sendMessage();
        } else if (strpos($route[3], "admin") === 0 && empty($_POST)) {
            $controllers = new AdminControllers();
            $controllers->index();
        } else if($route[3] == "login" && !empty($_POST)) {
            $controllers = new AdminControllers();
            $controllers->login();
        } else if(strpos($route[3], "login") === 0) {
            $controllers = new AdminControllers();
            $controllers->form();
        } else if($route[3] == "logout") {
            $controllers = new AdminControllers();
            $controllers->logout();
        } else if ($route[3] == "reg" && !empty($_POST)) {
            $controllers = new AdminControllers();
            $controllers->registration();
        } else if(strpos($route[3], "reg") === 0) {
            $controllers = new AdminControllers();
            $controllers->registrationForm();
        } else if($route[3] == "deleteMessage") {
            $controllers = new AdminControllers();
            $controllers->deleteMessage();
        } else if($route[3] == "twig") {
            $controllers = new AdminControllers();
            $controllers->twig();
        } else {
            echo 'СТРАНИЦА НЕ НАЙДЕНА';
        }
    }
}
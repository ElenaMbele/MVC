<?php
class AdminControllers extends BaseControllers
{
    public function index()
    {
        if($this->session->isGuest()) {
            $this->redirect('/login');
        }
        $model = new Messages();
        $massages = $model->getLatestMessages();
        $user = $this->user;
        $this->view->render('admin',['user' => $user, 'messages' => $massages]);
    }

    public function form()
    {
        $this->view->render('login', ['error' => !empty($_GET['error'])]);
    }

    public function login()
    {
        if(empty($_POST['email']) || empty($_POST['password'])) {
            throw InvalidArgumentException();
        }
        $email = trim($_POST['email']);
        $model = new Users();
        $res = $model->getUserByEmail($email);
        if (!$res) {
            $this->redirect('/login?error=1');
        } else {
            $password = md5(trim($_POST['password']));
            $passwordInBd = $res['password'];
            if($password === $passwordInBd) {
                $userId = $res[id];
                $this->session->login($userId);
                $this->redirect('/admin');
            } else {
                $this->redirect('/login?error=1');
            }
        }


    }

    public function logout()
    {
        $this->session->logout();
        $this->redirect('/login');

    }

    public function registrationForm()
    {
        $this->view->render('registration', ['error' => $_GET['error']]);
    }
    public function registration()
    {
        $userModel = new Users();
        $userModel->getUserByEmail($_POST['email']);
        if($userModel->getUserByEmail($_POST['email'])) {
            $this->redirect('/reg?error=4');
        }
        if (empty($_POST['user_name']) || empty($_POST['password1'])  || empty($_POST['password2']) || empty($_POST['email'])) {
            $this->redirect('/reg?error=3');
        }
        if (strlen($_POST['user_name']) < 4) {
            $this->redirect('/reg?error=2');
        }
        if($_POST['password1'] !== $_POST['password2']) {
           $this->redirect('/reg?error=1');
        } else {
            $userName = strtoupper(trim($_POST['user_name']));
            $password1 = md5(trim($_POST['password1']));
            $email = trim($_POST['email']);
            $model = new Users();
            $model->addUser($userName, $email, $password1);
            $userId = $model->getUserByEmail(trim($_POST['email']))['id'];
            $this->session->registration($userId);
            $this->redirect('/admin');

        }
    }

    public function sendMessage()
    {
        if (empty($_POST['message_text'])) {
            echo 'ВВЕДИТЕ ПОЖАЛУЙСТА ТЕКСТ СООБЩЕНИЯ';
        } else {
            $image = NULL;
            if ($_FILES['image']['name'] !== '') {
                $file_name = $_FILES['image']['name'];
                $file_path = __DIR__ . '/../uploads/';
                $file_url = '../src/uploads/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $file_path . $file_name);
                $image = $file_url;
            }
            $user = $this->session->getUserId();
            $text = $_POST['message_text'];
            $model = new Messages();
            $model->addMessage($user, $text, $image);
            $this->redirect('/admin');
        }
    }

    public function deleteMessage()
    {
        if (isset($_POST['messageId'])) {
              $messageId = $_POST['messageId'];
              $model = new Messages();
              $model->deleteMessage($messageId);
              $this->redirect('/admin');
        }
    }

    public function twig()
    {
        $model = new Messages();
        $massages = $model->getLatestMessages();
        echo $this->view->renderTwig('admin.twig', ['user' => $this->user, 'messages' => $massages]);
    }
}
<?php
class Users extends BaseModel
{
    public function getUser()
    {
        $sql = "SELECT * FROM users;";
        $res = self::$pdo->query($sql);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($user_name, $email, $password)
    {
        $sql = "INSERT INTO users(user_name, email, password) VALUES ('$user_name', '$email', '$password')";
        self::$pdo->query($sql);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email';";
        $res = self::$pdo->query($sql);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function user($id, $name, $isAdmin)
    {
        return ['id' => $id, 'name' => $name, 'isAdmin' => $isAdmin];
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = '$id';";
        $res = self::$pdo->query($sql);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
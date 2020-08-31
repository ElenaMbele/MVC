<?php
class Messages extends BaseModel
{
    public function getMessages()
    {
        $sql = "SELECT * FROM users;";
        $res = self::$pdo->query($sql);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function addMessage($user_id, $text, $image)
    {
        $sql = "INSERT INTO messages(user_id, message, image) VALUES ('$user_id', '$text', '$image')";
        self::$pdo->query($sql);
    }


    public function getLatestMessages()
    {
        $sql = "SELECT messages.message, messages.image, messages.id, users.user_name FROM messages
                INNER JOIN users ON messages.user_id = users.id
                ORDER BY messages.id DESC LIMIT 20;";
        $res = self::$pdo->query($sql);
        return $res->fetchAll();
    }

    public function deleteMessage($message_id)
    {
        $sql = "DELETE FROM messages WHERE messages.id = '$message_id';";
        self::$pdo->query($sql);
    }

}
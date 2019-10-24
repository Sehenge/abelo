<?php


class Shortener
{
    protected $handle;

    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->host = "localhost";
        $this->username = "abelohost";
        $this->password = "pAssWord122131%#$$";
        $this->database = "abelohost";

        $this->handle = new mysqli($this->host, $this->username, $this->password, $this->database);
    }

    public function getAllUrls($user) {
        $sql = "SELECT * FROM links WHERE user_id = {$user}";
        $result = $this->handle->query($sql);

        return $result;
    }

    public function getOriginalUrl($short) {
        $sql = "SELECT DISTINCT * FROM links WHERE `short` LIKE '{$short}'";
        $result = $this->handle->query($sql);

        if (!$result) {
            $result = mysqli_error($this->handle);
        } else {
            $row = mysqli_fetch_array($result);
            $result = $row['original'];
        }

        return $result;
    }

    public function generateShortUrl($original, $user_id) {
        $parsed_url = parse_url($original);
        if (!$parsed_url['scheme']) $parsed_url['scheme'] = 'http';

        $generated = substr(md5($original), 0, 5);

        $sql = "INSERT INTO links (`original`, `short`, `user_id`) VALUES ('{$original}', '{$generated}', {$user_id})";

        if (!$result = $this->handle->query($sql)) {
            $result = mysqli_error($this->handle);

        }
        $output = array("id" => mysqli_insert_id($this->handle), "source" => $original, "destination" => $generated);
        if ($result) {
            return json_encode($output);
//            return mysqli_insert_id($this->handle);
        } else {
            return "Error";
        }
    }

    public function removeUrl($id) {
        $sql = "DELETE FROM links WHERE id = '{$id}'";
        $result = $this->handle->query($sql);
    }
}
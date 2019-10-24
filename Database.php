<?php


class Database
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

    public function getUsers() {
        $sql = "SELECT id, username, password FROM users";
        $result = $this->handle->query($sql);
    }

    public function registration($username, $password) {
        $sql = "INSERT INTO users (username, password) VALUES ('{$username}', '{$password}')";
        if (!$result = $this->handle->query($sql)) {
            $result = mysqli_error($this->handle);
        }

        return $result;
    }

    public function auth($user, $pass) {
        $sql = "SELECT DISTINCT * FROM users WHERE username LIKE '{$user}' AND password LIKE '{$pass}'";
        $result = $this->handle->query($sql);

        if (!$result) {} //TODO: change this

        return $result;
    }
}
<?php
namespace Auth;

use Connection\Connection as Conn;
include '../config/Connection.php';

class Auth
{
    private $user, $password;

    /**
     * Auth constructor.
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->user = (String)$user;
        $this->password = (String)md5($password);
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }



    public function check()
    {
        return ($this->query()->rowCount())!==0;
    }

    public function get()
    {
        return ($this->query()->fetchAll())[0];
    }


    private function query()
    {
        $sql = "SELECT * FROM usuario WHERE pass = '{$this->getPassword()}' AND usuario = '{$this->getUser()}'";
        return Conn::get()->query($sql);
    }


}
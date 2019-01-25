<?php
namespace Auth;

use Connection\Connection as Conn;

require '../config/Connection.php';


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
        $this->user = $user;
        $this->password = $password;
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
        $sql = "SELECT * FROM usuarios WHERE pass = '{$this->password}' AND usuario = '{$this->user}'";
        return Conn::instance()->query($sql);
    }


}
<?php
namespace Connection;

use PDO;
use PDOException;

class Connection
{
    private static $inst = null;
    private $host = 'localhost', $username = 'root', $password = '', $database = 'db_videogame';
    private $conn;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        try {
            $this->setConn(new PDO("mysql:host={$this->getHost()};dbname={$this->getDatabase()}", $this->getUsername(), $this->getPassword()));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ
        } catch (PDOException $exception) {
            echo "Conexión fallida.";
            die();
        }
    }

    /**
     * @return PDO
     */
    public static function get(): PDO
    {
        if (!self::$inst) {
            self::$inst = new Connection();
        }
        return self::$inst->conn;
    }

    /**
     *  destroy connection
     */
    public static function destroy()
    {
        self::$inst = null;
    }

    /**
     * @param PDO $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return PDO
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }
}
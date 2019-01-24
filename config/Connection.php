<?php
namespace Connection;

use PDO;
use PDOException;

class Connection
{
    private static $inst = null;
    private $host = 'localhost', $username = 'root', $password = '', $database = 'db_music';
    private $conn;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Conexión fallida.";
            die();
        }
    }

    /**
     * @return PDO instance
     */
    public static function instance() {
        if (!self::$inst) {
            self::$inst = new Connection();
        }
        return self::$inst->conn;
    }

    /**
     *  destroy connection
     */
    public static function destroy() {
        self::$inst = null;
    }
}
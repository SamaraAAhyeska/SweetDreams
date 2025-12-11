<?php
include_once("ConnectionFactory_class.php");
include_once("Login_class.php");

class LoginDAO
{
    public $con = null;

    public function __construct()
    {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    // ============================================================
    // BUSCAR USUÁRIO POR LOGIN
    // ============================================================
    public function buscarUsuario($usuario)
    {
        try {
            $stmt = $this->con->prepare(
                "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1"
            );

            $stmt->bindValue(":usuario", $usuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            echo "Erro ao buscar usuário: " . $ex->getMessage();
            return null;
        }
    }
}

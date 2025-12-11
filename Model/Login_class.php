<?php
/**
 * Login_class.php
 * Classe simples para lidar com autenticação usando usuário e senha
 * Modelo pronto para integração com banco de dados (MySQL, PDO).
 */

class Login {

    private $pdo;

    // Construtor recebe a conexão PDO
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Realiza o login
     * @param string $usuario
     * @param string $senha
     * @return bool
     */
    public function autenticar($usuario, $senha) {
        $sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica senha usando password_verify
            if ($dados && $senha === $dados['senha']) {

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['usuario_id'] = $dados['id'];
                $_SESSION['usuario_nome'] = $dados['usuario'];
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica se o usuário está logado
     */
    public function estaLogado() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['usuario_id']);
    }

    /**
     * Faz logout destruindo a sessão
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
    }
}

?>

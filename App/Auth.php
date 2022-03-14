<?php

namespace App;
use App\Core\Model;

class Auth {
    public static function Login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        if($stmt->rowCount() >= 1) {
            $result  = $stmt->fetch(\PDO::FETCH_ASSOC);
            if(password_verify($password, $result['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['userId'] = $result['id'];
                $_SESSION['userName'] = $result['name'];
                header('location: /admin/index');
            } else {
                return "Senha Inválida";
            }
        } else {
            return "E-mail Inválido";
        }
    }

    public static function Logout() {
        session_destroy();
        header("Location: /home/login");
    }

    public static function checkLogin() {
        if(!$_SESSION['logged']) {
            header("Location: /home/index");
            die();
        }
    }
}
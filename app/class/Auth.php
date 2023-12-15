<?php

session_start();
class Database
{
    private $hst = "localhost",
            $usr = "root",
            $pwd = "",
            $dbe = "marketplace";
    public  $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->hst,$this->usr,$this->pwd,$this->dbe);
    }
}
class Auth extends Database
{
    public function __construct(){
        parent::__construct();
    }

    public function register($username, $password, $cPassword, $email){
        $passwordHash = md5($password);

        $cek = mysqli_query($this->conn,"SELECT username FROM user WHERE username='$username'");
        $hitung = mysqli_num_rows($cek);
        if($hitung > 0){
            $_SESSION['pesan'] = 'username';
            header('location: ../../views/login.php');
        }else{
            if($password != $cPassword){
                $_SESSION['pesan'] = 'password';
                header("location: ../../views/register.php");
            } else {
                $type = 'user';
                $verifi = 'verified';
                $query = $this->conn->prepare("INSERT INTO user(username, password, email, type, verification) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("sssss", $username, $passwordHash, $email, $type, $verifi);
                $query->execute();
                $query->close();
                $_SESSION['pesan'] = 'login';
                header("location: ../../views/login.php");
            }
        }
    }

    public function login($username, $password, $cPassword){
        $passwordHash = md5($password);

        if($password != $cPassword){
            $_SESSION["pesan"] = "password";
            header("location: ../../views/login.php");
        }else{
            $query = mysqli_query($this->conn,"SELECT * FROM user WHERE `username`='$username' AND `password`='$passwordHash'");
            $hitung = mysqli_num_rows($query);
            if($hitung > 0){
                $row = mysqli_fetch_assoc($query);
                $type = $row["type"];
                $verifi = $row["verification"];
                if($verifi != "banned"){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $token = date('Ymd').$row['username'].rand(100,999);
                    $_SESSION['token'] = md5($token);
                    if($type == 'user'){
                        header("location: ../../views/user/index.php");
                    }elseif ($type == 'admin') {
                        header("location: ../../views/admin/index.php");
                    }
                }else{
                    $_SESSION["pesan"] = "banned";
                    header("location: ../../views/login.php");
                }
            }
            
        }
    } 

    public function logout(){
        session_destroy();
        header("location: ../../views/login.php");
    }
}

?>
<?php 

require_once ('../../conn/conn.php');
session_start();

try{
    $db->beginTransaction();
    $usernameGmail = htmlspecialchars($_POST["usernameGmail"]);
    $loginPassword = htmlspecialchars(hash("sha512",$_POST["loginPassword"]));
    //echo $loginPassword."\n";
    $requser = $db->prepare("SELECT * FROM _utilisateur WHERE (gmail=? OR username=?) AND password=?");
    $requser->execute([$usernameGmail,$usernameGmail, $loginPassword]);
    $userexist = $requser->RowCount();   
    if($userexist == 1) {
        $userinfo = $requser->fetch ();
        if($userinfo['verified'] == 0){
            $error = 1;
            //$error="Check your gmail and activate your account first";
            echo json_encode($error);    
        }else{
            $_SESSION['iduser'] = $userinfo['iduser'];
            $_SESSION['username'] = $userinfo['username'];
            $_SESSION['fullName'] = $userinfo['fullName'];
            $_SESSION['nationality'] = $userinfo['nationality'] ;
            $_SESSION['phoneNumber'] = $userinfo['phoneNumber'];
            $_SESSION['birthday'] = $userinfo['birthday'];
            $_SESSION['gmail'] = $userinfo['gmail'];
            $_SESSION['profilPic'] = $userinfo['profilPic'];
            $_SESSION['password'] = $userinfo['password'];
            $_SESSION['role'] = $userinfo['role'];
            if($userinfo['role'] == 0){
                $role = 3;
                echo json_encode($role);  
            }else{
                $role = 4;
                echo json_encode($role);  
            }
        } 
    }else{
        $error = 2;
        //$error="You entered something wrong, try Again !";
        echo json_encode($error);    
    }
    

}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}
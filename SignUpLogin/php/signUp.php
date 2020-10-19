<?php 

require_once ('../../conn/conn.php');

try{
        $db->beginTransaction();
        $fullName = htmlspecialchars($_POST['fullName']);    
        $username = htmlspecialchars($_POST['username']);
        $gmail = htmlspecialchars($_POST['gmail']);
        $nationalite = htmlspecialchars($_POST['nationalite']);
        $telephone = htmlspecialchars($_POST['tel']);
        $birthday = htmlspecialchars($_POST['birthday']);
        $pwd = htmlspecialchars(hash("sha512",$_POST['pwd']));
        $vkey = hash("sha512",time()+rand());
        $verified = 0;
        $role = 0;
        
        if(isset($_FILES['pdp']) AND !empty($_FILES['pdp']['name'])){
                $images=$_FILES['pdp']['name'];
                $tmp_dir=$_FILES['pdp']['tmp_name'];
                $imageSize=$_FILES['pdp']['size'];
                $upload_dir='../../pdp/';
                $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
                $pdp=$username."Pdp".rand().".".$imgExt;
                $result=move_uploaded_file($tmp_dir, $upload_dir.$pdp);
        }

        

        $stmt=$db->prepare("INSERT INTO `_utilisateur` (`iduser`, `username`, `fullName`, `nationality`, `phoneNumber`, `birthday`, `gmail`, `profilPic`, `password`, `vkey`, `verified`, `role`)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $userInfos = array(NULL,$username,$fullName,$nationalite,$telephone,$birthday,$gmail,$pdp,$pwd,$vkey,$verified,$role);
        $stmt->execute($userInfos);
        $db->commit();
        $success = "your account has been successfuly created";
        echo json_encode($success);     

}catch(PDOException $e){
        echo $e->getMessage();
        $db->rollBack();
}

?>
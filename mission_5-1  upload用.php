<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UFT-8">
    <title>mission_5-1</title>
</head>
<body>
  
        <?php
    //DBの設定
$dsn='デーベース名';
$user='ユーザー名';
$password='パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


$sql = "CREATE TABLE IF NOT EXISTS tbtest"
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name char(32),"
. "comment TEXT,"
."password text"
.");";

$stmt = $pdo->query($sql);

if(isset($_POST["submit"])&&!empty($_POST["name"])&& !empty($_POST["comment"]) && !empty($_POST["password"])){
$sql=$pdo->prepare("INSERT INTO tbtest(name,comment,password)VALUES(:name, :comment, :password)");
$sql->bindParam(':name',$name,PDO::PARAM_STR); 
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$sql-> bindParam(':password', $password, PDO::PARAM_STR);
$name = $_POST["name"];
$comment = $_POST["comment"];
$password =$_POST["password"];
$sql->execute();
}


//削除
if(isset($_POST["delete"])&&!empty($_POST["deleteId"]) && !empty($_POST["deletepass"])){
$id=$_POST["deleteId"];
$deletepass=$_POST["deletepass"];
$sql='delete from tbtest where id=:id AND password=:deletepass';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':deletepass',$deletepass,PDO::PARAM_STR);
$stmt->execute();
}

//編集
if(isset($_POST["update"]) && !empty($_POST["updateId"]) && !empty($_POST["updatename"] )&& !empty($_POST["updatecomment"]) && !empty($_POST["editpass"])){
$editname= $_POST["updatename"];
$editcomment=$_POST["updatecomment"];
$id=$_POST["updateId"];
$editpass=$_POST["editpass"];
  $sql='UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id AND password=:editpass';
 $stmt=$pdo->prepare($sql);
$stmt->bindParam(':name',$editname,PDO::PARAM_STR);
$stmt->bindParam(':comment',$editcomment,PDO::PARAM_STR);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':editpass',$editpass,PDO::PARAM_INT);
$stmt->execute();  
}



?>
<form action ="" method="post">
         
                <input type = "text" name= "name" placeholder="名前" ><br>
                <input type = "text" name= "comment" placeholder="コメント"><br>
                <input type = "text" name= "password" placeholder="パスワード" ><br>
                <input type ="submit" name="submit"><br>
            
               <br> <input type="text" name="deleteId" placeholder="削除対象番号"><br>
               <input type ="text" name = "deletepass" placeholder ="パスワード"><br>
               <input type="submit" name="delete" value="削除"><br>
               
               <br> <input type="text" name="updateId" placeholder="編集対象番号"><br>
             　 <input type="text" name="updatename" placeholder="名前"><br>
             　 <input type="text" name="updatecomment" placeholder="コメント"><br>
             　 <input type ="text" name = "editpass" placeholder ="パスワード"><br>
                <input type="submit" name="update" value="編集"><br>
            
        
　　　　
               
             
     
        </form>
        <?php
    //データ表示

   $sql="SELECT * FROM tbtest";

  
$stmt=$pdo->query($sql);
$result=$stmt->fetchAll();
foreach($result as $row){
    echo $row["id"].',';
    echo $row["name"].',';
    echo $row["comment"]."<br>";
  
}


        ?>
＊パスワードは変更できません
    
</body>
</html>
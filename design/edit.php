
 <?php
 
   //友達の名前を取得し表示
 
 // DB接続準備
  $dsn = 'mysql:dbname=myfriends;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');
 
 
  // ②SQL作成
 $sql = 'SELECT * FROM `areas`';
 
 // ③SQL実行
 $stmt = $dbh->prepare($sql);
 $stmt->execute();
 
 // ④データ取得
 // データ格納用変数
 $areas = array();
 
 While (1){
   $rec = $stmt->fetch(PDO::FETCH_ASSOC);
 
   //取得できるデータがなかったらループ終了
   if ($rec == false){
     break;
   }
 
   // echo $rec['area_id'];
   // echo $rec['area_name'];
 
   $areas[] = $rec;
 
 }
 
  //パラメータを受け取る
  $friend_id = $_GET['friend_id'];
 
  //  SQL文を作成
  $sql = 'SELECT * FROM `friends` WHERE `friend_id`='.$friend_id;
 
  //var_dump($sql);
 
  // SQLを実行
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
 
  //友達のデータ取得
  $friends = $stmt->fetch(PDO::FETCH_ASSOC);
 
  // DB切断
  $dbh = null;
 
 ?>
  <!DOCTYPE html>
  <html lang="ja">
    <head>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">名前</label>
                <div class="col-sm-10">
                 <input type="text" name="name" class="form-control" placeholder="山田　太郎" value="山田　太郎">
                 <input type="text" name="name" class="form-control" placeholder="山田　太郎" value="<?php echo $friends['friend_name']; ?>">
                </div>
              </div>
              <!-- 出身 -->
 
                <div class="col-sm-10">
                  <select class="form-control" name="area_id">
                    <option value="0">出身地を選択</option>
                   <option value="1" selected>北海道</option>
                   <option value="2">青森</option>
                   <option value="3">岩手</option>
                   <option value="4">宮城</option>
                   <option value="5">秋田</option>
                   <?php foreach ($areas as $area) : ?>
                       <?php if($area['area_id'] == $friends['area_id']){ ?>
                       <option value="<?php echo $area['area_id']; ?>" selected><?php echo $area['area_name']; ?></option>
                       <?php }else{ ?>
                       <option value="<?php echo $area['area_id']; ?>" ><?php echo $area['area_name']; ?></option>
                       <?php } ?>
                   <?php endforeach; ?>
                  </select>
                </div>
              </div>

                <label class="col-sm-2 control-label">性別</label>
                <div class="col-sm-10">
                  <select class="form-control" name="gender">
                   <option value="0">性別を選択</option>
                   <option value="1" selected>男性</option>
                  <option value="2">女性</option>
                   <option value="-1">性別を選択</option>
                   <?php if ($friends['gender'] == 0) { ?>
                      <option value="1" selected>男性</option>
                      <option value="2">女性</option>
                    <?php } else if ($friends['gender'] == 1) {?>
                      <option value="1">男性</option>
                      <option value="2" selected>女性</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- 年齢 -->
              <div class="form-group">
                <label class="col-sm-2 control-label">年齢</label>
                <div class="col-sm-10">
                 <input type="text" name="age" class="form-control" placeholder="例：27" value="27">
                 <input type="text" name="age" class="form-control" placeholder="例：27" value="<?php echo $friends['age']; ?>">
                </div>
              </div>
  

 <?php
 
 // ここにDBからデータを取得する処理を記述
 // ①DBへ接続
 $dsn = 'mysql:dbname=myfriends;host=localhost';
 $user = 'root';
 $password = '';
 $dbh = new PDO($dsn, $user, $password);
 $dbh->query('SET NAMES utf8');
 
 
 // ②SQL作成
 $sql = 'SELECT * FROM `areas`';
 
 // ③SQL実行
 $stmt = $dbh->prepare($sql);
 $stmt->execute();
 
 // ④データ取得
 // データ格納用変数
 $areas = array();
 
 While (1){
   $rec = $stmt->fetch(PDO::FETCH_ASSOC);
 
   //取得できるデータがなかったらループ終了
   if ($rec == false){
     break;
   }
 
   // echo $rec['area_id'];
   // echo $rec['area_name'];
 
   $areas[] = $rec;
 
 }
 
 //DBに登録する処理
 //POST送信されたときだけ行いたい処理を記述
 if (isset($_POST) && !empty($_POST)){
 
   //登録する友達のSQL(INSERT文)
   $sql = 'INSERT INTO `friends`(`friend_name`, `area_id`, `gender`, `age`, `created`) VALUES ("'.$_POST['name'].'",'.$_POST['area_id'].','.$_POST['gender'].','.$_POST['age'].',now())';
 
   //SQL実行
   $stmt = $dbh->prepare($sql);
   $stmt->execute();
 
   // 登録後、index.phpへ遷移
   header('Location: index.php');
 }
 
 
 // ⑤DB切断
 $dbh = null;
 
 ?>
  <!DOCTYPE html>
  <html lang="ja">
    <head>
 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="index.html"><span class="strong-title"><i class="fa fa-facebook-square"></i> My friends</span></a>
               <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-facebook-square"></i> My friends</span></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 
                <div class="col-sm-10">
                  <select class="form-control" name="area_id">
                    <option value="0">出身地を選択</option>
                   <option value="1">北海道</option>
                   <option value="2">青森</option>
                   <option value="3">岩手</option>
                   <option value="4">宮城</option>
                   <option value="5">秋田</option>
                   <?php foreach ($areas as $area) : ?>
                       <option value="<?php echo $area['area_id']; ?>"><?php echo $area['area_name']; ?></option>
                   <?php endforeach; ?>
                  </select>
                </div>
              </div>
 
                <label class="col-sm-2 control-label">性別</label>
                <div class="col-sm-10">
                  <select class="form-control" name="gender">
                  <option value="0">性別を選択</option>
                   <option value="1">男性</option>
                   <option value="2">女性</option>
                   <option value="-1">性別を選択</option>
                   <option value="0">男性</option>
                   <option value="1">女性</option>
                  </select>
                </div>
              </div>

                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="index.html"><span class="strong-title"><i class="fa fa-facebook-square"></i> My friends</span></a>
               <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-facebook-square"></i> My friends</span></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <td><div class="text-center"><?php echo $friend['friend_name']; ?></div></td>
                <td>
                  <div class="text-center">
                  <a href="edit.html"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="edit.php?friend_id=<?php echo $friend['friend_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" onclick="destroy();"><i class="fa fa-trash"></i></a>
                  </div>
                </td>

            </tbody>
          </table>
  
        <input type="button" class="btn btn-default" value="新規作成" onClick="location.href='new.html'">
         <input type="button" class="btn btn-default" value="新規作成" onClick="location.href='new.php'">     </div>
      </div>
    </div>

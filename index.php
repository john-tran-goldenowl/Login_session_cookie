<?php
    session_start(); 
    require_once 'account.php';       
    if(!$_SESSION['id']){
        if(!$_COOKIE['remember']){
        header("location: login.php");
        }else {
            $_SESSION['id']= $_COOKIE['remember'];
            header("location: index.php");
        }
    }else{
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <style>
    body {
        width: 50%;
        margin: 0 auto;
    }
    </style>
    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('Are you sure to delete?');
        }
    </script>
</head>

<body>
    <br>
    <br>
    <h3>Hello id:<?=$_SESSION['id']?> <a href="index.php?act=logout">Logout</a></h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
       INSERT
    </button>
    <!-- Modal -->
    <hr>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?act=insert" method="POST">
                    <div class="modal-body">                   
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Account name</span>
                                <input required type="text"  name="acc_name" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Amount</span>
                                <input required type="text" name="amount" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>  
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                                <input required type="text" name="password" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>                 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php                    
                $account = new account ;
                if(isset($_GET['act'])){
                   $act = $_GET['act'];
                }else{
                    $act = "index";
                }
                switch($act){
                    case 'index':
                        $list = $account->getAccount();               
                        require_once "list_acc.php";
                        break;
                    case 'delete': 
                        echo $_GET['id'];
                        $account->deleteAccount($_GET['id']);
                        header("location: index.php");
                        break;  
                    case 'insert':    
                      $acc_name = $_POST['acc_name'] ;
                      $amount =  $_POST['amount'] ;  
                      $password =  password_hash($_POST['password'], PASSWORD_BCRYPT) ;               
                      $account->insert($acc_name, $amount,$password)   ;
                      header("location: index.php");
                      break;   
                    case 'update':    
                        $account =   $account->getOneAcc($_GET['id']);
                        require_once "update.php";
                           
                        break;
                    case 'onupdate':    
                        $acc_name = $_POST['acc_name'];
                        $amount = $_POST['amount'];
                        $id = $_POST['id'];
                        $account->update( $acc_name, $amount, $id);
                        header("location: index.php");
                        break;
                    case 'logout': 
                        session_destroy() ;
                        setcookie("remember", "", time()-3600);
                        header("location: login.php");
                        break;   
                    default:
                    header("location: error.php");                                                    
                }           
                ?>
    </tbody>
    </table>
</body>
</html>
<?php } ?>

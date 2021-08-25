<?php
require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST, array(

            'username' => array('required' => true),
            'password' => array('required' => true)

        )) ;
        if($validation->passed()){
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;

            $login = $user->login(Input::get('username'),
                                  Input::get('password'),
                                 $remember);
            if($login){
                Redirect::to('index.php');
            }else{
                echo 'Sorry, logging in failed';
            }

        }else{
            foreach($validation->errors() as $error){
              $css_class = "alert-danger";
              $msg =  ''.$error . '<br>';
            };
        }

    }
}
/*  echo "<div class=\"alert alert-danger\">
    Are you sure you want to delete this record?
    <a href=\"admin.php?salt=".$salt."\" class=\"alert-link\"><input type=\"submit\" name=\"yes\" value=\"Yes\"></a>
    <a href=\"#\" class=\"alert-link\"><input type=\"submit\" name=\"no\" value=\"No\"></a>
  </div>";*/
?>

   <link rel="stylesheet" href="bin/css/bootstrap.css">
       <link rel="stylesheet" type="text/css" href="./dist/css/adminx.css" media="screen" />
<scrpt href="bin/js/bootstrap.js"></scrpt>
<scrpt href="bin/js/jquery-3.4.1.min.js"></scrpt>
<scrpt href="bin/js/jquery-ui.js"></scrpt>

<style media="screen">

</style>

<div class="adminx-container d-flex justify-content-center align-items-center" style="padding:0;margin:0">

  <div class="page-login">
    <div class="mb-4 h1 text-center">
      <strong>Login</strong>

    </div>
    <p class="mb-4 h6 text-center">Hi there, Welcome back </p>
          <div class="card mb-0">

     <div class="card-body" style="padding-bottom:0">
       <form method="post">
         <?php    if(!empty($msg)):    ?>

             <div class="alert
             <?php echo $css_class;?> alert-dismissible">
             <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $msg;?>
             </div>

         <?php    endif;?>
         <div class="form-group">
           <label for="username" class="form-label">Username</label>
           <input type="text" class="form-control" value="<?php echo escape(Input::get('username'));?>"
         name="username" id="username" placeholder="username">
         </div>
         <div class="form-group">
           <label for="password" class="form-label">Password</label>
           <input type="password" class="form-control" value="<?php echo escape(Input::get('password'));?>"
         name="password" id="password"  placeholder="Password">
         </div>
         <div class="form-group">
           <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" value="remember" name="remember" id="remember">
            <label class="custom-control-label" for="remember">
             Remember me
           </label>
           </div>
         </div>
           <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
         <input type="submit" class="btn btn-sm btn-block btn-primary" value="Sign in">
         </form>
       </div>
         <div class="card-seperator " style="padding:0;margin:0"><span> or</span>
</div>
<div class="card-body" style="padding-top:10px">
<a type="submit" class="btn btn-sm btn-block btn-primary" href="register.php" style="border : 0px">
Sign Up</a>
</div>

     </div>
     <div class="card-footer text-center">
       <a href="#"><small>Forgot your password?</small></a>
     </div>
   </div>
   </div>
 </div>

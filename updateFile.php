<?php

require_once 'core/init.php';
$user=new User();
    if(!$user->isLoggedin()){
     Redirect::to('index.php');
    }

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            /*'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
                'unique' => 'user'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'con_password' => array(
                'required' => true,
                'matches' => 'password'
            ),*/
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));
        if($validation->passed()){
            
            try{
                $user->update(array(
                
                    //'username' => Input::get('username'),
                    //'password' => Hash::make(Input::get('password'),$salt),
                    'name' => Input::get('name')
                    
                ));
               
                Session::flash('home','Your details have been updated');
                Redirect::to('index.php');
            }
            catch(Exception $e){
                die($e->getMessage());
            } 
        }else{
            foreach($validation->errors() as $error){
                echo $error. '<br>';
            }
        }
    }
}
    
    
    
?>
<link rel="stylesheet" href="bin/css/bootstrap.css">
<scrpt href="bin/js/bootstrap.js"></scrpt>
<scrpt href="bin/js/jquery-3.4.1.min.js"></scrpt>
<scrpt href="bin/js/jquery-ui.js"></scrpt>
 <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
          <div class="row">
            <div class="col text-center">
              <h1>Update ProFile</h1>
            </div>
          </div>
<form action="" method="post">
          <div class="row align-items-center">
            <!---div class="col mt-4">
             Username
              <input type="text" class="form-control" 
              value="<?php echo escape($user->data()->username);?>"
              name="username" id="username" autocomplete="off">
            </div--->
            <div class="col mt-4">
             Name
              <input type="text" class="form-control" 
              value="<?php echo escape($user->data()->name);?>"
              name="name" id="name" autocomplete="off">
            </div>
          </div>

          <div class="row justify-content-start mt-4">
            <div class="col">

              <input type="hidden" name="token"
              value="<?php echo Token::generate(); ?>">
              <input class="btn btn-primary mt-4" type="submit" value="Update">
            </div>
          </div>
</form>
        </div>
      </div>
    </div>
  </section>
<?php

require_once 'core/init.php';

if(!$username = Input::get('user')){
    Redirect::to('index.php');
}else{
    $user = new User($username);
    
    if(!$user->exists()){
        Redirect::to(404);
    }else{
        //echo 'exists';
        $data = $user->data();
    }
    if($data->username == "Admin"){
    Redirect::to(404);//you ccontrol the world now  
    }//issAdmin
    else
    {?>
    <h3><?php   echo escape($data->username);?></h3>
    <p>
        Full name: <?php echo escape($data->name);?>
    </p>
    <?php
    }//Not admin
}

?>
<?php
require_once 'core/init.php';
include 'classes/connection.php';
if(Session::exists('home')){ // check class 'success' if it exists
    echo '<p>'.Session::flash('home').'</p>'; // 'success' is a flash class called, not the actuall message
}


$user = new User();

$css_msg = "";
$rec_msg = "";
  $id = "";
  $name = "";
  $lname = "";
  $pck = "";
  $dp = "";
  $grp = "";
if($user->isLoggedIn()){
    //echo 'Logged In';
    //echo $user->data()->username; //----> displays user(username) logged in
    $dpmsg = "";
    $css_class = "";


if (isset($_POST['btnEdit'])) {

  $id = $_POST['btnEdit'];

$query = "Select * from member where id=?";
$stmt=$conn->prepare($query);
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();

  $name = $row['name'];
  $lname = $row['surname'];
  $pck = $row['packageid'];

}

if (isset($_POST['btnE'])) {

$id = $_POST['id'];
$nm = $_POST['_name'];
$lnm = $_POST['_lname'];
$mil = $_POST['_email'];
$pck = $_POST['_pack'];
$grp = $_POST['_group'];

  $query = "UPDATE member SET name=?, surname=?, email=?, packageid=?, group_=?  WHERE id=? ";
  $stmt=$conn->prepare($query);
  $stmt->bind_param("sssiii",$nm,$lnm,$mil,$pck,$grp,$id);

//  $result=$stmt->get_result();
//  $row=$result->fetch_assoc();
//      $data = mysqli_query($conn, $query);

if (  $stmt->execute()){
        $rec_msg = $nm.'\'s record was Updated successfully';
        $css_class = 'alert-success';

      }else{

        $rec_msg = 'Could not update '.$nm.'\'s record <br>, Because ' . $e;
        $css_class = 'alert-warning';

        }

  }






if (isset($_POST['btnDel'])) {

  $id = $_POST['id'];
  $name = $_POST['name'];
  $query = "DELETE FROM member WHERE id='$id'";

  $data = mysqli_query($conn, $query);
  if($data){

    $rec_msg = $name.'\'s record was Deleted successfully';
    $css_class = 'alert-info';

    }else{

    $rec_msg = 'Could not delete '.$name.'\'s record';
    $css_class = 'alert-danger';

    }


}








?>

<html lang="en">
  <head>
    <title>G|M|S</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="./dist/css/adminx.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="bin/flatpickr.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="bin/css/animate.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="bin/css/lightslider.css" />

    <!--
      # Optional Resources
      Feel free to delete these if you don't need them in your project
    -->
  </head>
  <body>
    <div class="adminx-container">
       <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block" href="index.php">
          <img  src="bin/dps/<?php echo $user->data()->photo; ?>" class="navbar-brand-image d-inline-block align-top mr-2" alt="" style="border-radius:50%">
          <?php
            echo $user->data()->username;
            ?>
        </a>

        G|M|S

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
            <a class="nav-link nav-link-notifications" id="dropdownNotifications" data-toggle="dropdown" href="#">
              <i class="oi oi-bell display-inline-block align-middle"></i>
              <span class="nav-link-notification-number">3</span>
            </a>

          </li>
          <!-- Notifications -->
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
              <i data-feather="user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="uppdate.php">My Profile</a>
              <a class="dropdown-item" href="#">My Tasks</a>
              <a class="dropdown-item" href="#">Payment</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="logout.php">Sign out</a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- expand-hover push -->
      <!-- Sidebar -->
      <div class="adminx-sidebar expand-hover push">
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="index.php" class="sidebar-nav-link active">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#healthb" aria-expanded="false" aria-controls="healthb">
              <span class="sidebar-nav-icon">
                <i data-feather="pie-chart"></i>
              </span>
              <span class="sidebar-nav-name">
                Health
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="healthb">
              <li class="sidebar-nav-item">
                <a href="index.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    BC
                  </span>
                  <span class="sidebar-nav-name">
                    BMI Calculator
                  </span>
                </a>
              </li>
            </ul>
          </li>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navTables" aria-expanded="false" aria-controls="navTables">
              <span class="sidebar-nav-icon">
                <i data-feather="layout"></i>
              </span>
              <span class="sidebar-nav-name">
                Tables
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="navTables">
              <li class="sidebar-nav-item">
                <a href="admin.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    MT
                  </span>
                  <span class="sidebar-nav-name">
                    Member Table
                  </span>
                </a>
              </li>

              <li class="sidebar-nav-item">
                <a href="admin.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    TT
                  </span>
                  <span class="sidebar-nav-name">
                    Trainer Tables
                  </span>
                </a>
              </li>
            </ul>
          </li>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link" data-toggle="collapse" href="#update" aria-expanded="false" aria-controls="update">
              <span class="sidebar-nav-icon">
                <i data-feather="edit"></i>
              </span>
              <span class="sidebar-nav-name">
                Update Profile
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="update">
              <li class="sidebar-nav-item">
                <a href="uppdate.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    DP
                  </span>
                  <span class="sidebar-nav-name">
                    Profile Picture
                  </span>
                </a>
              </li>

              <li class="sidebar-nav-item">
                <a href="uppdate.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    PD
                  </span>
                  <span class="sidebar-nav-name">
                    Profile Details
                  </span>
                </a>
              </li>
            </ul>
          </li>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link" data-toggle="collapse" href="#gallery" aria-expanded="false" aria-controls="gallery">
              <span class="sidebar-nav-icon">
                <i data-feather="image"></i>
              </span>
              <span class="sidebar-nav-name">
               Gallery
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="gallery">
              <li class="sidebar-nav-item">
                <a href="uppdate.php" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    UP
                  </span>
                  <span class="sidebar-nav-name">
                    Upload Picture
                  </span>
                </a>
              </li>
            </ul>
          </li>


           <li class="sidebar-nav-item">
            <a href="payment.php" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Payment
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>

           <li class="sidebar-nav-item">
            <a href="logout.php" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="log-out" style="color:red"></i>
              </span>
              <span class="sidebar-nav-name" style="color:red">
                Sign Out
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>

        </ul>

      </div><!-- Sidebar End -->

      <!-- -content-aside -->
      <div class="adminx-content">
        <!-- <div class="-aside">

        </div> -->

        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard(Admin)</li>
              </ol>
            </nav>
<?php

?>
            <div class="pb-3">
              <h1>Manage Members</h1>
            </div>
            <?php    if(!empty($rec_msg)):    ?>

            <div class="alert
            <?php echo $css_class;?> alert-dismissible">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php    echo $rec_msg;?>
            </div>

            <?php    endif;?>

            <div class="row">
              <div class="col-md-6 col-lg-4 d-flex">
                <div class=" mb-grid w-100">
                          <a class="card d-flex flex-row align-items-center h-100" href="#">

                            <div class="card-body text-center">
                            <div class="card-head">CRUD</div>

                              <h3 class="card-title mb-0">
                                Members
                              </h3>
                            </div>
                          </a>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 d-flex">
                <div class=" mb-grid w-100">
                          <a class="card d-flex flex-row align-items-center h-100" href="#">

                            <div class="card-body text-center">
                            <div class="card-head">CRUD</div>

                              <h3 class="card-title mb-0">
                                Trainers
                              </h3>
                            </div>
                          </a>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 d-flex">
                <div class=" mb-grid w-100">
                              <a class="card d-flex flex-row align-items-center h-100" href="#">

                                <div class="card-body text-center">
                                <div class="card-head">Manage</div>

                                  <h3 class="card-title mb-0">
                                    Packages
                                  </h3>
                                </div>
                              </a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-4">


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab"
                    href="#home" role="tab" aria-controls="home" aria-selected="true">
                      Personal Details
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab"
                     href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                     Tabs
                   </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab"
                     href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                     Permissons
                   </a>
                  </li>
                </ul>
                <div class="tab-content mb-grid pt-3" id="myTabContent">

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <form method="post" action="admin.php" novalidate>
                      <?php
                      //
if(isset($_POST['btnEdit'])){
  $pck = $_POST['packageid'];
  $grp = $_POST['group'];
}
                      ?>
                    <input type="text" name="id" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['id']; ?>" class="d-none">
<div class="form-row input-group-prepand">

    <div class="col-md-6 mb-3 Input-group-sm ">

        <label class="form-label" for="">ID</label>
        <input type="text" class="form-control" id="" name=""
        placeholder="Member ID" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['id'];?>" disabled>

    </div>
  <div class="col-md-6 mb-3 Input-group-sm ">

      <label class="form-label" for="">Email</label>
      <input type="email" class="form-control" id="_email" name="_email"placeholder="Email"
      value="<?php if(isset($_POST['btnEdit']))  echo $_POST['email'];?>" required>

  </div>
</div>
<div class="form-row input-group-prepand">


    <div class="col-md-6 mb-3 Input-group-sm ">

        <label class="form-label" for="">First name</label>

        <input type="text" class="form-control" id="_name" name="_name"
        placeholder="First Name" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['name'];?>" required>

    </div>

    <div class="col-md-6 mb-3 Input-group-sm ">

        <label class="form-label" for="">Last name</label>
        <input type="text" class="form-control" id="_lname" name="_lname"
        placeholder="Last Name" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['surname'];?>" required>

    </div>

</div>
</div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<div class="form-row input-group-prepand">
      <div class="col-md-6 mb-3 Input-group-sm ">

<label class="form-label" for="">Change user package</label>
<select class="form-control" id="_pack" name="_pack">
    <option value="1" <?php  if($pck == 1) echo "selected";?>>Default</option>
    <option value="2" <?php if($pck == 2) echo "selected";?>>Pro</option>
    <option value="3" <?php if($pck == 3) echo "selected";?>>Ultimate</option>
</select>
</div>
<div class="col-md-6 mb-3 Input-group-sm ">

<label class="form-label" for="">Change user permission</label>
<select class="form-control" id="_group" name="_group">
    <option value="1" <?php  if($grp == 1) echo "selected";?>>Standard</option>
    <option value="2" <?php if($grp == 2) echo "selected";?>>Trainer</option>
    <option value="3" <?php if($grp == 3) echo "selected";?>>Admin</option>
</select>

      </div>

    </div>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
    </div>



    <input class="btn btn-success" name="btnE" id="btnE" type="submit" value="Edit User">
    </form>
  </div>









                </div>




















<!--div class="card-header">
<div class="card-header-title">Validation</div>
</div>
<div class="card-body">

<form method="post" action="admin.php" novalidate>
<div class="form-row">
<div class="col-md-6 mb-3">
<label class="form-label" for="">First name</label>
<input type="text" name="id" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['id']; ?>" class="d-none">
<input type="text" class="form-control" id="E_name" name="E_name"
placeholder="" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['name'];?>" required>
</div>
<div class="col-md-6 mb-3">
<label class="form-label" for="">Last name</label>
<input type="text" class="form-control" id="E_lname" name="E_lname"
placeholder="lname" value="<?php if(isset($_POST['btnEdit']))  echo $_POST['surname'];?>" required>
</div>
</div>
<div class="form-row">

<div class="col-mb-4">
<label class="form-label" for=""></label>
<input type="text" class="form-control" id="" placeholder="" required>

</div>
<div class="col">
<label class="form-label" for=""></label>
<select class="form-control" id="packageid" name="packageid"
>
<?php
$pck = $_POST['packageid'];
switch($_POST['packageid']){
case 1;
   echo "Default";
break;
case 2;
   echo "Pro";
break;

case 3;
   echo "Ultimate";
break;
}

?>
<option value="1" <?php  if($pck == 1) echo "selected";?>>Default</option>
<option value="2" <?php if($pck == 2) echo "selected";?>>Pro</option>
<option value="3" <?php if($pck == 3) echo "selected";?>>Ultimate</option>
</select>
</div>
</div>
<div class="form-row">

</div>
<input class="btn btn-success" name="btnE" id="btnE" type="submit" value="Edit User">
</form>
</div>
</div>



</div-->



              <div class="col-md-8">

<div class="mb-grid">


<div class="table-responsive">
<table class="table table-actions table-striped table-hover mb-0">
<thead>
  <tr>
    <th>#</th>
    <th>Profile Photo</th>
    <th>Full Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th></th>
  </tr>
</thead>

<?php
$result= $conn->query("SELECT * FROM member WHERE username != 'admin'") or die();
if ($result->num_rows > 0)
{while ($row = $result->fetch_assoc()){
?>
<tbody>
  <tr>
    <form class="" action="admin.php" method="post">
      <style media="screen">
        .d-none{
          display: none;
        }
      </style>
      <td>
          <input type="text" name="id" value="<?php echo $row['id']; ?>" class="d-none">
          <?php echo $row['id']; ?>
      </td>
      <td>
          <img src="bin\dps\<?php echo $row['photo']; ?>" alt="" class="navbar-brand-image d-inline-block align-top mr-2"  style="border-radius:50%">
      </td>
      <td>
          <input type="text" name="name" value="<?php echo $row['name']; ?>" class="d-none">
          <?php echo $row['name']; ?>
      </td>
      <td>
          <input type="text" name="surname" value="<?php echo $row['surname']; ?>" class="d-none">
          <?php echo $row['surname']; ?>
      </td>
      <td>
          <input type="text" name="email" value="<?php echo $row['email']; ?>" class="d-none">
          <input type="text" name="group" value="<?php echo $row['group_']; ?>" class="d-none">
          <input type="number" name="packageid" value="<?php echo $row['packageid']; ?>" class="d-none">
          <?php echo $row['email']; ?>
      </td>
      <td>
          <input type="submit" name="btnEdit" value="Edit">
        </td>
      <td>
          <input type="submit" name="btnRead" value="Read">
      </td>
      <td>

      <input type="submit" name="btnDel" id="btnDel" class="btn btn-outline-light"value="Delete">
      <style media="screen">
        #btnDel{
          border: 2px solid red;
          border-radius: 25px;
          color: red;
          width: 80px;
          height: 30px;
          padding: 0
        }
      </style>
      </td>
    </form>
  </tr>
<?php
}
}
?>
</tbody>
</table>
</div>


                            </div>
              </div>
            </div>



<div class="col row-card">

</div>






        </div>
      </div>
      </div>
      </div>


    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="./dist/js/vendor.js"></script>
    <script src="./dist/js/adminx.js"></script>

    <!-- If you prefer vanilla JS these are the only required scripts -->
    <!-- script src="./dist/js/vendor.js"></script>
    <script src="./dist/js/adminx.vanilla.js"></script-->
  </body>
</html>
<?php

}
?>

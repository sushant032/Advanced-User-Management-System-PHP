<?php require_once('bootstrap/init.php');
$student = new Student();
$company = new Company();
if($student->isLoggedIn()||$student->isLoggedIn())
  Redirect::to('index.php');
  if(Input::exists()){
    if(Token::check(Input::get('token'))){
      $company = new Company();
      $salt = Hash::make(uniqid());
      try{
        $company->create(array(
          'organization_name'=>Input::get('organization_name'),
          'email'=>Input::get('email'),
          'password'=>Hash::make(Input::get('password'),$salt),
          'salt'=>$salt,
          'first_name'=>Input::get('first_name'),
          'last_name'=>Input::get('last_name'),
          'mobile_no'=>Input::get('mobile_no'),
          'created_at'=>date("Y-m-d h:i:s"),
          'updated_at'=>date("Y-m-d h:i:s")
        ));
        Redirect::to('index.php');
      }catch(Exception $e){
        die($e->getMessage());
      }

    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternMax</title>
    <?php include('includes/css_includes.php'); ?>
    <style media="screen">
    p{
      color:#777;
    }
    </style>
  </head>
  <body>
    <?php include 'offcanvas-navigation.php'; ?>
    <!-- Offcanvas Navigation End -->
    <nav class="navbar navbar-default container-fluid">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">InternMax</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="view-all-internships.php">Internships</a></li>
          </ul>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Find internships...">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          <?php $student = new Student();
                $company = new Company();
              if(!$student->isLoggedIn()&&!$company->isLoggedIn()):

           ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="student-login.php">Login: Student</a></li>
                <li><a href="company-login.php">Login: Company</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="student-registration.php">New Student: Register</a></li>
                <li><a href="company-registration.php">New Company: Hire Interns</a></li>
              </ul>
            </li>
          </ul>
        <?php else: ?>
          <ul class="nav navbar-nav navbar-right">
            <?php if($student->isLoggedIn()): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $student->data()->first_name; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="student-logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $company->data()->organization_name; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="company-logout.php">Logout</a></li>
              </ul>
            </li>
          <?php endif; ?>
          </ul>
        <?php endif; ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="offcanvas-overlay"></div>

    <div class="content-wrapper container">
        <div class="container col-md-6 col-md-offset-3" style="text-align:left; margin-top:30px;">
          <div class="panel panel-default" style="padding:20px;">
            <center><h2>Organization registration</h2></center><br><br>
          <form class="" action="" method="post">
            <div class="form-group">
              <label for="">Organization name</label>
              <input type="text" name="organization_name" value="" class="form-control">
            </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Mobile No.</label>
                <input type="text" name="mobile_no" value="" class="form-control">
              </div>
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
              <div class="form-group">
                <input type="submit" class="btn btn-primary form-control" name="submit" value="SIGNUP">
              </div>
          </form>
          <p>By registering, you agree to the Terms and Conditions.</p>
        </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/hamburger-navigation.js"></script>
  </body>
</html>

<?php require_once('bootstrap/init.php'); ?>
<?php
if(Input::exists()){
    if(isset($_POST['student-login'])){
      //Student Login
      $student = new Student();
        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $student->login(Input::get('email'), Input::get('password'),$remember);
        if($login) {
            Redirect::to('student-dashboard.php');
        } else {
            echo 'Incorrect username or password';
        }

    }
    else {
      //Company-Login
      $company = new Company();
        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $company->login(Input::get('email'), Input::get('password'),$remember);
        if($login) {
            Redirect::to('company-dashboard.php');
        } else {
            echo 'Incorrect username or password';
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
                <li><a href="#" data-toggle="modal" data-target=".student-login-modal">Login: Student</a></li>
                <li><a href="#" data-toggle="modal" data-target=".company-login-modal">Login: Company</a></li>
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

    <div class="content-wrapper container-fluid">

        <h1>
            Welcome to InternMax
        </h1>
        <p>
          Here you find the most valuable internships in India.
        </p>
        <div class="container" style="margin-top:50px;">
          <a href="view-all-internships.php">
            <div class="col-md-6 col-md-offset-3" style="background-color:#fff; height:200px;">
              <h2 style="top:65px; position: relative; color:#000;">Find Internships</h2>
            </div>
          </a>
        </div>
    </div>

    <!-- Login modal -->
  <div class="modal fade student-login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="row">
          <h3>Student Login</h3>
        <div class="col-md-8 col-md-offset-2 form-holder">
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" value="" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="" required>
          </div>
          <div class="form-group">
            <input type="checkbox" name="remember" value="on">
            <label for="">Remember me?</label>
          </div>
          <div class="form-group">
            <input type="submit" class="form-control btn btn-primary" name="student-login" value="Login" required>
          </div>
        </form>
        <h5>New to InternMax? Register(<a href="student-registration.php">Student</a>/<a href="company-registration.php"> Company</a>)</h5>
      </div>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade company-login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="row">
          <h3>Company Login</h3>
        <div class="col-md-8 col-md-offset-2">
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" value="" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="" required>
          </div>
          <div class="form-group">
            <input type="checkbox" name="remember" value="on">
            <label for="">Remember me?</label>
          </div>
          <div class="form-group">
            <input type="submit" class="form-control btn btn-primary" name="company_login" value="Login" required>
          </div>

        </form>
      </div>
      </div>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/hamburger-navigation.js"></script>
  </body>
</html>

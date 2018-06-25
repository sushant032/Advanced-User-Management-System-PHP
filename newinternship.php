<?php require_once('bootstrap/init.php'); ?>
<?php
$company = new Company();
if(!$company->isLoggedIn())
  Redirect::to('index.php');
  if(Input::exists()){
    if(Token::check(Input::get('token'))){
      try{
      $company->createNewInternship(array('company_id'=>$company->data()->id,
      'title'=>Input::get('title'),
      'about_company'=>Input::get('about_company'),
      'about_internship'=>Input::get('about_internship'),
      'available'=>Input::get('available'),
      'skills'=>Input::get('skills'),
      'who_can_apply'=>Input::get('who_can_apply'),
      'perks'=>Input::get('perks'),
      'start_date'=>Input::get('start_date'),
      'duration'=>Input::get('duration'),
      'stipend'=>Input::get('stipend'),
      'apply_by'=>Input::get('apply_by'),
      'created_at'=>date("Y-m-d h:i:s"),
      'updated_at'=>date("Y-m-d h:i:s")));
      Redirect::to('company-dashboard.php');
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
            <li><a href="view-all-internships.php">Internship</a></li>
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
        <div class="row container-fluid">
          <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">

              <h2>New Internship</h2>
              <br><br>
            <div class="panel-body" style="text-align:left;">
              <form action="" method="post">
                <div class="form-group">
                  <label>Title</label>
                  <textarea name="title" class="form-control" required></textarea>
                </div>
                  <div class="form-group">
                    <label>About your company</label>
                    <textarea name="about_company" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>About internship</label>
                    <textarea name="about_internship" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>No of seats available</label>
                    <input type="text" name="available" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Skills Required</label>
                    <textarea name="skills"  class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Who can apply?</label>
                    <textarea name="who_can_apply" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Perks</label>
                    <textarea name="perks" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Start date (Eg: 22 Jun 2018 or Immideatly)</label>
                    <input type="text" name="start_date" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Duration (in months)</label>
                    <input type="text" name="duration" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Stipend</label>
                    <input type="text" name="stipend" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Apply by (Eg: 22 Jun 2018)</label>
                    <input type="text" name="apply_by" class="form-control" value="" required>
                  </div>
                  <input type="hidden" name="token" value="<?php echo  Token::generate(); ?>">
                  <div class="form-group">
                    <input type="submit" name="apply" class="btn btn-primary" value="Submit">
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

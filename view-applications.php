<?php require_once('bootstrap/init.php'); ?>
<?php
$company = new Company();
if(!$company->isLoggedIn())
  Redirect::to('index.php');
$i = new Internship();
$internship = $i->getInternship(Input::get('id'));
$company_id = $i->getInternship(Input::get('id'))->company_id;
if($company->data()->id==$company_id){
  $applications = $i->getApplications(Input::get('id'));
}else{
  echo 'Not your internship!';
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
          <a class="navbar-brand" href="#">InternMax</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Internships</a></li>
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
            View Applications
        </h1>
        <div class="row container-fluid">
          <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">All Applications for <b><?php echo $internship->title;  ?></b></h3>
            </div>
            <div class="panel-body">
              <?php
                if(!count($applications)):
              ?>
              <h2>Sorry you have no applications to view.</h2>
            <?php else:
              echo "<h2>You have got ".count($applications)." applications.</h2><br><br>";
              echo '<table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Applied on</th>
                        <th>Status</th>
                        <th>Hire</th>
                      </tr>
                    </thead>
                    <tbody style="text-align:left;">';
                foreach ($applications as $applicant) {
                  $student = new Student($applicant->user_id);
                  // var_dump($student);
                echo "<tr>
                  <td>{$student->data()->first_name} {$student->data()->last_name}</td>
                  <td>{$student->data()->email}</td>
                  <td>{$applicant->status}</td>
                  <td>{$applicant->created_at}</td>
                  <td><a href='' class='btn btn-success'>Hire</a></td>
                  </tr>";

                }
                echo'</tbody>
                  </table>';
            ?>

            <?php endif; ?>
              <a href="company-dashboard.php" class="btn btn-primary" style="margin-top:30px;">Go back</a>
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

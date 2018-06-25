<?php require_once('bootstrap/init.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternMax</title>
    <?php
    include('includes/css_includes.php');
    ?>
    <style media="screen">
      .internship-link,.internship-link:hover,.internship-link:active,.internship-link:visited{
        color:#337ab7;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <?php include 'offcanvas-navigation.php'; ?>
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

    <div class="content-wrapper container-fluid">

        <h1>
            All available internships.
        </h1>
        <?php
          $i = new Internship();
        ?>
        <div class="row container-fluid">
          <?php
            $internships = $i->getAll();
            foreach ($internships as $internship) {
          ?>
          <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:left;">
            <a class="internship-link" href="internship.php?id=<?php echo $internship->id; ?>">
              <h3 class="panel-title"><?php echo $internship->title; ?></h3>
            </a>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Start Date</th>
                    <th>Duration</th>
                    <th>Stipend</th>
                    <th>Posted on</th>
                    <th>Apply By</th>
                  </tr>
                </thead>
                <tbody style="text-align:left;">
                  <tr>
                    <td><?php echo $internship->start_date; ?></td>
                    <td><?php echo $internship->duration; ?> months</td>
                    <td><?php echo $internship->stipend; ?> /month</td>
                    <td><?php echo $internship->created_at; ?></td>
                    <td><?php echo $internship->apply_by; ?></td>

                  </tr>
                </tbody>
              </table>
            </div>
            <div class="panel-footer" style="padding-top:10px;padding-bottom:20px;">
              <span style="float:left;display:inline-block; margin-top:-5px;">Intermax verified internship</span>
              <a style="display:inline-block;float:right; margin-top:-5px;" class="internship-link" href="internship.php?id=<?php echo $internship->id; ?>"><span class="">ENROLL NOW</span></a>
            </div>
          </div>
          </div>
        <?php } ?>
        </div>
      </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/hamburger-navigation.js"></script>
  </body>
</html>

<?php require_once('bootstrap/init.php'); ?>
<?php
  if(!Input::exists('get'))
    Redirect::to('index.php');

  //Logic for applyin to the internship
  if(Input::exists()){
    if(Token::check(Input::get('token'))){
      $student = new Student();
      if($student->isLoggedIn()){

        try{
          $student->applyToInternship(array('user_id'=>$student->data()->id,
                                            'internship_id'=>Input::get('id'),
                                            'status'=>'pending',
                                            'created_at'=>date("Y-m-d h:i:s"),
                                            'updated_at'=>date("Y-m-d h:i:s")));
        Redirect::to('internship.php?id='.Input::get('id'));
      }catch(Exception $e){
        die($e->getMessage());
      }
      }else{
        Redirect::to('student-login.php');
      }
    }
  }

    $i = new Internship();
    $internship = $i->getInternship(Input::get('id'));
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
      <h3 style="text-align:left; color:white; margin-bottom:16px; margin-left:20px;">Apply to internship</h3>
        <div class="row container-fluid">
          <div class="col-md-10 pull-left">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:left;">
              <h3 class="panel-title"><?php echo $internship->title; ?></h3>
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
                    <td>₹ <?php echo $internship->stipend; ?> /month</td>
                    <td><?php echo $internship->created_at; ?></td>
                    <td><?php echo $internship->apply_by; ?></td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
        <div class="row container-fluid">
          <div class="col-md-10 pull-left">
          <div class="panel panel-default">
            <?php $company = $i->getOrganization($i->data()->company_id); ?>
            <div class="panel-body" style="text-align:left; color:black;">
                <div class="section">
                  <h4>About <?php echo $company->organization_name; ?>:</h4>
                  <p><?php echo $internship->about_company;?></p>
                </div>
                <div class="section">
                  <h4>About the internship:</h4>
                  <p><?php echo $internship->about_internship;?></p>
                </div>
                <div class="section">
                  <h4>#of Internships Available: <?php echo $internship->available; ?></h4>
                </div>
                <div class="section">
                  <h4>Skills Required:</h4>
                  <p><?php echo $internship->skills; ?></p>
                </div>
                <div class="section">
                  <h4>Who can apply? :</h4>
                  <p><?php echo $internship->who_can_apply;?></p>
                </div>
                <div class="section">
                  <h4>Perks :</h4>
                  <p><?php echo $internship->perks;?></p>
                </div>
                <?php
                  $student = new Student();
                  $company = new Company();
                  if(!$student->isLoggedIn()&&!$company->isLoggedIn()): ?>
                <center>
               <form action="" method="post">
               <input type="hidden" name="token" value="<?php echo Token::generate();?>">
               <input type="submit" name="apply" class="btn btn-primary" value="Apply">
               </form>
               </center>
             <?php endif; ?>
                <?php
                 if($student->isLoggedIn()):
                        if($i->isAlreadyApplied($student->data()->id)):
                 ?>
                 <center>
                   <span class="btn btn-primary disabled">Already Applied</span>
                 </center>
               <?php else: ?>
                 <center>
                <form action="" method="post">
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                <input type="submit" name="apply" class="btn btn-primary" value="Apply">
                </form>
                </center>
              <?php endif;
              elseif($company->isLoggedIn()):
               ?>
               <center>
                 <span class="btn btn-primary disabled">Companies can't apply!</span>
               </center>
             <?php endif; ?>
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

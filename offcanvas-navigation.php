<?php
require_once('bootstrap/init.php');
$student = new Student();
$company = new Company();
if($student->isLoggedIn()):
 ?>
<a id="offCanvas" class="hamburger" style="text-decoration:none;"><i class="ti-menu"></i></a>
<!-- Offcanvas Navigation Start -->
<div class="nav-offcanvas">
    <button type="button" class="close" id="offCanvasClose" aria-label="Close">
        <i class="ti-close"></i>
    </button>
    <div class="nav-offcanvas-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="view-application-status.php">View My Applications</a></li>
            <li><a href="student-dashboard.php">Dashboard</a></li>
            <li><a href="view-all-internships.php">Find Internships</a></li>
            <li><a href="student-logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<?php elseif($company->isLoggedIn()) :?>

 <a id="offCanvas" class="hamburger" style="text-decoration:none;"><i class="ti-menu"></i></a>
 <!-- Offcanvas Navigation Start -->
 <div class="nav-offcanvas">
     <button type="button" class="close" id="offCanvasClose" aria-label="Close">
         <i class="ti-close"></i>
     </button>
     <div class="nav-offcanvas-menu">
         <ul>
             <li><a href="index.php">Home</a></li>
             <li><a href="company-dashboard.php">Company dashboard</a></li>
             <li><a href="newinternship.php">New internship</a></li>
             <li><a href="view-all-internships.php">Find Internships</a></li>
             <li><a href="company-logout.php">Logout</a></li>
         </ul>
     </div>
 </div>
<?php else: ?>

 <a id="offCanvas" class="hamburger" style="text-decoration:none;"><i class="ti-menu"></i></a>
 <!-- Offcanvas Navigation Start -->
 <div class="nav-offcanvas">
     <button type="button" class="close" id="offCanvasClose" aria-label="Close">
         <i class="ti-close"></i>
     </button>
     <div class="nav-offcanvas-menu">
         <ul>
             <li><a href="index.php">Home</a></li>
             <li><a href="student-login.php">Student Login</a></li>
             <li><a href="company-login.php">Company Login</a></li>
             <li><a href="student-registration.php">Student Registration</a></li>
             <li><a href="company-registration.php">Company Registration</a></li>
         </ul>
     </div>
 </div>
<?php endif; ?>
<!-- Offcanvas Navigation End -->

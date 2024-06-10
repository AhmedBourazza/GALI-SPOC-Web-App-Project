
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>

    <title>Sign in</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="aboutStyle.css" />
    
  </head>
  <body>
    
    <div class="main-container">
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
              <span>
                  <img src="images/logo.png" alt="">
              </span>
            </a>
  
            <div class="navbar-collapse" id="">
              <div class="custom_menu-btn">
                <button onclick="openNav()">
                  <span class="s-1" style="  background-color: black; "> </span>
                  <span class="s-2" style="  background-color: black; "> </span>
                  <span class="s-3" style="  background-color: black; "> </span>
                </button>
              </div>
              <div id="myNav" class="overlay">
                <div class="overlay-content">
                  <a href="index.html">HOME</a>
                  <a href="index.html">ABOUT</a>
              
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <div class="forms-container">
        <div class="signinUser-signinConsultant">
          <form action="includes/login.inc.php" method="post" class="signin-user-form">
            <h2 class="title">Hello user</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" required name="email" placeholder="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required name="password" placeholder="Password" />
            </div>
            <input type="submit" name="submit" value="Login" class="btn solid" />
          </form>
          
          <form action="includes/loginconsultant.inc.php" method="post" class="signin-consultant-form">
            <h2 class="title">Hello Consultant</h2>
           
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" required name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required name="password" placeholder="Password" />
            </div>
            <input type="submit" name="submit" class="btn" value="Login" />
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Are you a consultant ?</h3>
            <p>
              
If you are a consultant, click here to proceed to the consultant login page. This will allow you to access the dedicated features and services tailored to your role within Gali.
            </p>
            <button class="btn transparent" id="consultantLogin">
              consultant
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Are you an user? </h3>
            <p>
            click here for the beneficiary login page, to access the user-friendly interface and utilize the services provided by Gali.
            </p>
            <button class="btn transparent" id="userLogin">
              user
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    
    <script>
      function openNav() {
        document.getElementById("myNav").classList.toggle("menu_width");
        document
          .querySelector(".custom_menu-btn")
          .classList.toggle("menu_btn-style");
      }
    </script>    

<script src="app.js"></script>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>

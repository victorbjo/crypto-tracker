<style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }
    
    li {
      float: left;
      list-style-type: none;
    }
    
    li a {
      
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    li a:hover {
      background-color: #111;
    }

    .current{
        background-color: #444;
    }
    </style>
    </head>
    <body>
    <?php
    session_start();
    if (isset($_SESSION["user"])){
    ?>
    <ul>
      <li><a class="active, header-link" href="index.php">Home</a></li>
      <li><a href="explorer.php" class="header-link">Explore</a></li>
      <li>Logged in as <?php echo $_SESSION['user'] ?></li>
      <li><a href="logout.php" class="header-link">Log out</a></li>
      <?php
    }   
    else{
        ?>
      <li><a href="login.php" class="header-link">Log in</a></li>
      <li><a href="signup.php" class="header-link">Register</a></li>
      <?php
    }
      ?>
    </ul>
    <script>
        function markCurrentLocation(){
        var currentUrl = window.location.href;
        var links = document.getElementsByClassName("header-link");
        for (var i = 0; i < links.length; i++){
            if (currentUrl == links[i].href){
                links[i].classList.add("current");
            }
        }}
        markCurrentLocation();
    </script>
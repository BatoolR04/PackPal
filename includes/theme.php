<?php
// Ensure $theme is defined to avoid warnings
if (!isset($theme)) {
  $theme = 'default';
}

$themeStyle = "";

switch (strtolower($theme)) {
  case 'tropical':
    $themeStyle = "body {
      background: linear-gradient(to right, #fff176, #ffb74d, #f06292, #ba68c8, #64b5f6);
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      color: #000000;
    }";
    break;

  case 'city':
    $themeStyle = "body {
      background: linear-gradient(to right, #cfd8dc, #b0bec5, #90a4ae, #78909c, #546e7a);
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      color: #000000;
    }";
    break;

  case 'nature':
    $themeStyle = "body {
      background: linear-gradient(to right, #fff59d, #aed581, #81c784, #66bb6a, #388e3c);
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      color: #000000;
    }";
    break;

  case 'dark':
    $themeStyle = "body {
      background: linear-gradient(to right, #1c1c1c, #121212, #0e0e0e, #050505);
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      color: #ffffff;
    }";
    break;

  default:
    $themeStyle = "body {
      background: #ffffff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      color: #000000;
    }";
    break;
}
?>

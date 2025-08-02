<?php
session_start();
include 'includes/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About PackPal</title>
  <meta name="description" content="Learn more about PackPal, a smart packing list generator and trip planner built using PHP and MySQL.">
  <meta name="keywords" content="about PackPal, travel planner project, trip packing tool, project info">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/theme-<?= $theme ?>.css">
  <style>
    body {
      background: url('assets/images/cover.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
    }
    .overlay {
      background: rgba(255, 255, 255, 0.8);
      padding: 60px 30px;
      border-radius: 12px;
      max-width: 800px;
      margin: 80px auto;
      color: black;
    }
    h1 {
      font-size: 2.8em;
      margin-bottom: 20px;
    }
    p, li {
      font-size: 1.1em;
      text-align: left;
      margin-bottom: 10px;
    }
    ul {
      list-style: disc;
      margin: 20px auto;
      text-align: left;
      max-width: 600px;
      padding-left: 20px;
    }
    .buttons {
      margin-top: 30px;
    }
    .buttons a {
      text-decoration: none;
      color: white;
      background: #0984e3;
      padding: 10px 20px;
      border-radius: 8px;
      margin: 10px;
      display: inline-block;
      font-weight: bold;
    }
    .buttons a:hover {
      background: #74b9ff;
    }
    .media-credits {
      font-size: 0.95em;
      text-align: left;
      margin-top: 20px;
      color: black;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h1>About PackPal</h1>
    <p><strong>PackPal</strong> is a web-based travel assistant that helps users generate personalized packing lists based on their trip type and destination. It is built using PHP, MySQL, HTML5, CSS3, and JavaScript.</p>

    <ul>
      <li>Create and save customized packing lists for Beach, City, Hiking, and Winter trips.</li>
      <li>Interactive checklist with pie chart progress tracking.</li>
      <li>Save, print, or download packing lists.</li>
      <li>Includes helpful multimedia: videos, maps, images.</li>
      <li>Admin dashboard with user and trip management.</li>
      <li>Fully responsive and SEO-optimized.</li>
    </ul>

    <p><strong>Created by:</strong> Batool Raza</p>

    <p class="media-credits">
      <em><strong>Media credits:</strong> Trip videos are embedded from YouTube and are linked to official travel creators. Images used throughout the site are sourced from royalty-free platforms like Unsplash and Pexels. This website is built for educational purposes only, and all media used is either under fair use or open licensing.</em>
    </p>

    <div class="buttons">
      <a href="index.php">← Back to Home</a>
      <a href="tripForm.php">Plan a Trip</a>
      <a href="faq.html">FAQ</a>
    </div>
    <footer>
    &copy; 2025 PackPal. All rights reserved. |
    <a href="terms.html">Terms</a> |
    <a href="privacy.html">Privacy</a> |
    <a href="sitemap.html">Sitemap</a>
  </footer>
  </div>
</body>
</html>



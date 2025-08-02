<?php
session_start();
$destination = $_GET['destination'] ?? '';
$trip_type = $_GET['trip_type'] ?? '';
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

$items = [
  "Beach" => ["Sunscreen", "Swimsuit", "Beach Towel", "Flip Flops", "Sunglasses", "Hat", "Aloe Vera", "Beach Umbrella"],
  "Winter" => ["Jacket", "Gloves", "Scarf", "Boots", "Thermal Wear", "Beanie", "Hand Warmers", "Snow Goggles"],
  "City" => ["Phone Charger", "Wallet", "ID", "Map", "Sneakers", "Camera", "Reusable Bag", "Transit Card"],
  "Hiking" => ["Hiking Boots", "Water Bottle", "Trail Map", "Snacks", "First-Aid Kit", "Sunscreen", "Hat", "Insect Repellent"]
];

$videos = [
  "Beach" => "https://www.youtube.com/embed/3Ay4Sk7NRCY",
  "City" => "https://www.youtube.com/embed/jCbEI2-mFMQ",
  "Hiking" => "https://www.youtube.com/embed/d9PL5ml3Hzw",
  "Winter" => "https://www.youtube.com/embed/ITkPBnsPyXY"
];

$images = [
  "Beach" => "assets/images/beach.jpg",
  "City" => "assets/images/city.jpg",
  "Hiking" => "assets/images/hiking.jpg",
  "Winter" => "assets/images/winter.jpg"
];

$packing_list = $items[$trip_type] ?? [];
$bg_image = $images[$trip_type] ?? "assets/images/default.jpg";
$video_url = $videos[$trip_type] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Your personalized packing list for <?= htmlspecialchars($trip_type) ?> trip to <?= htmlspecialchars($destination) ?>.">
  <meta name="keywords" content="Packing list, travel, <?= htmlspecialchars($trip_type) ?>, <?= htmlspecialchars($destination) ?>, trip planning">
  <meta name="author" content="PackPal Team">
  <title>Packing List | <?= htmlspecialchars($trip_type) ?> to <?= htmlspecialchars($destination) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background: url('<?= $bg_image ?>') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Help Dropdown */
    details {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 1000;
    }

    details summary {
      background: white;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      color: #3498db;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      list-style: none;
    }

    details[open] > summary::after {
      content: "▲";
      float: right;
      margin-left: 10px;
    }

    details summary::after {
      content: "▼";
      float: right;
      margin-left: 10px;
    }

    details ul {
      background: white;
      list-style: none;
      margin: 0;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      position: absolute;
      right: 0;
      top: 40px;
      width: 200px;
      z-index: 1001;
    }

    details ul {
  background: white;
  list-style: none;
  margin: 0;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  position: absolute;
  right: 0;
  top: 40px;
  width: 200px;
  z-index: 1001;
}

details ul {
  background: rgba(0, 0, 0, 0.6); 
  list-style: none;
  margin: 0;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  position: absolute;
  right: 0;
  top: 40px;
  width: 200px;
  z-index: 1001;
}

details ul li {
  margin: 0;
  padding: 0;
  background: transparent;
  list-style: none;
}

details ul li a {
  display: block;
  background-color: white;
  padding: 10px 14px;
  margin: 8px 0;
  border-radius: 8px;
  color: #3498db;
  font-weight: normal;
  text-align: center;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
}

details ul li a:hover {
  background-color: #3498db;
  color: white;
  font-weight: bold;
}


    .container {
      background-color: rgba(255, 255, 255, 0.85);
      padding: 30px;
      border-radius: 15px;
      max-width: 850px;
      margin: 60px auto 30px;
      text-align: left;
      color: #000;
    }

    h1, h2 {
      color: #2c3e50;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      margin: 10px 0;
      padding: 10px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 8px;
      color: #fff;
    }

    .item-check:checked + label {
      color: #81ecec;
      font-weight: bold;
    }

    iframe {
      display: block;
      margin: 30px auto;
      width: 100%;
      max-width: 650px;
      height: 350px;
      border: none;
      border-radius: 12px;
    }

    a {
      color: #2980b9;
    }

    canvas {
      display: block;
      margin: 30px auto;
      background-color: white;
      border-radius: 12px;
      max-width: 400px;
    }

    button {
      margin-top: 20px;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 6px;
      border: none;
      background-color: #0984e3;
      color: white;
      cursor: pointer;
    }

    .download-buttons {
      margin-top: 20px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
      justify-content: center;
    }

    .gallery-img {
      width: 200px;
      height: auto;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .gallery-img:hover {
      transform: scale(1.05);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      padding-top: 60px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.9);
      text-align: center;
    }

    .modal-content {
      max-width: 90%;
      max-height: 80%;
      margin-top: 40px;
      border-radius: 10px;
    }

    .close, .prev, .next {
      color: white;
      font-size: 40px;
      cursor: pointer;
      position: absolute;
      top: 50%;
      user-select: none;
    }

    .close { top: 20px; right: 30px; }
    .prev { left: 0; }
    .next { right: 0; }
  </style>
</head>
<body>

<!-- Help Dropdown -->
<details>
  <summary>Need Help?</summary>
  <ul>
    <li><a href="help/howtopack.php">How to Pack</a></li>
    <li><a href="help/savinglists.php">Saving Lists</a></li>
    <li><a href="help/triptypes.php">Trip Types</a></li>
    <li><a href="help/customizing.php">Customizing Items</a></li>
    <li><a href="help/adminfeatures.php">Admin Features</a></li>
    <li><a href="faq.html">FAQ</a></li>
    <li><a href="contact.html">Contact Us</a></li>
  </ul>
</details>

<div class="container">
  <h1>Packing List for <?= htmlspecialchars($destination) ?></h1>
  <h2><?= htmlspecialchars($trip_type) ?> Trip | <?= htmlspecialchars($start_date) ?> – <?= htmlspecialchars($end_date) ?></h2>

  <ul id="packingList">
    <?php foreach ($packing_list as $item): ?>
      <li>
        <input type="checkbox" class="item-check" id="<?= htmlspecialchars($item) ?>">
        <label for="<?= htmlspecialchars($item) ?>"><?= htmlspecialchars($item) ?></label>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="download-buttons">
    <button onclick="window.print()">🖨️ Print Packing List</button>
    <button onclick="downloadList()">📥 Download as TXT</button>
  </div>

  <canvas id="packingChart"></canvas>

  <?php if (!empty($destination)): ?>
    <h2>Map of <?= htmlspecialchars($destination) ?></h2>
    <iframe src="https://www.google.com/maps?q=<?= urlencode($destination) ?>&output=embed" loading="lazy" allowfullscreen></iframe>
  <?php endif; ?>

  <?php
    $trip_type_lower = strtolower($trip_type);
    $galleries = [
      "beach" => ["folder" => "beach_gallery", "prefix" => "b", "title" => "🌴 Beach Gallery"],
      "winter" => ["folder" => "winter_gallery", "prefix" => "w", "title" => "❄️ Winter Gallery"],
      "city"   => ["folder" => "city_gallery",   "prefix" => "c", "title" => "🏙️ City Gallery"],
      "hiking" => ["folder" => "hiking_gallery", "prefix" => "h", "title" => "🥾 Hiking Gallery"]
    ];

    if (array_key_exists($trip_type_lower, $galleries)):
      $gallery = $galleries[$trip_type_lower];
      $galleryPath = "assets/images/" . $gallery['folder'] . "/";
      $galleryImages = glob($galleryPath . $gallery['prefix'] . "*.{jpg,JPG,png}", GLOB_BRACE);
  ?>
    <h2 style="margin-top: 30px;"><?= $gallery['title'] ?></h2>
    <div class="gallery">
      <?php foreach ($galleryImages as $index => $img): ?>
        <img src="<?= $img ?>" alt="Gallery Image" class="gallery-img" data-index="<?= $index ?>">
      <?php endforeach; ?>
    </div>

    <div id="imgModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="modalImg">
      <a class="prev">&#10094;</a>
      <a class="next">&#10095;</a>
    </div>
  <?php endif; ?>

  <?php if ($video_url): ?>
    <iframe src="<?= $video_url ?>" allowfullscreen></iframe>
  <?php endif; ?>

  <?php if (isset($_SESSION['user_id'])): ?>
    <form method="POST" action="saveTrip.php">
      <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">
      <input type="hidden" name="trip_type" value="<?= htmlspecialchars($trip_type) ?>">
      <input type="hidden" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
      <input type="hidden" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
      <button type="submit">Save This Trip</button>
    </form>
  <?php else: ?>
    <p>Log in to save this trip!</p>
  <?php endif; ?>

  <a href="tripForm.php">← Plan Another Trip</a>
</div>

<script>
  const checkboxes = document.querySelectorAll('.item-check');
  const ctx = document.getElementById('packingChart').getContext('2d');
  let chart;

  function updateChart() {
    const checked = Array.from(checkboxes).filter(cb => cb.checked).length;
    const total = checkboxes.length;
    const data = {
      labels: ["Packed", "Remaining"],
      datasets: [{
        label: "Packing Progress",
        data: [checked, total - checked],
        backgroundColor: ["#00cec9", "#dfe6e9"]
      }]
    };

    if (chart) {
      chart.data.datasets[0].data = data.datasets[0].data;
      chart.update();
    } else {
      chart = new Chart(ctx, {
        type: 'pie',
        data: data
      });
    }
  }

  checkboxes.forEach(cb => cb.addEventListener('change', updateChart));
  updateChart();

  function downloadList() {
    const listItems = document.querySelectorAll('#packingList li label');
    let text = "Packing List for <?= htmlspecialchars($trip_type) ?> Trip to <?= htmlspecialchars($destination) ?>:\n\n";
    listItems.forEach(label => {
      text += "- " + label.textContent + "\n";
    });

    const blob = new Blob([text], { type: 'text/plain' });
    const link = document.createElement('a');
    link.download = "PackPal_Packing_List.txt";
    link.href = window.URL.createObjectURL(blob);
    link.click();
  }

  const modal = document.getElementById("imgModal");
  const modalImg = document.getElementById("modalImg");
  const galleryImgs = document.querySelectorAll(".gallery-img");
  const closeBtn = document.querySelector(".close");
  const nextBtn = document.querySelector(".next");
  const prevBtn = document.querySelector(".prev");

  let currentIndex = 0;
  const imgSources = Array.from(galleryImgs).map(img => img.src);

  galleryImgs.forEach((img, index) => {
    img.onclick = () => {
      modal.style.display = "block";
      modalImg.src = img.src;
      currentIndex = index;
    };
  });

  closeBtn.onclick = () => {
    modal.style.display = "none";
  };

  nextBtn.onclick = () => {
    currentIndex = (currentIndex + 1) % imgSources.length;
    modalImg.src = imgSources[currentIndex];
  };

  prevBtn.onclick = () => {
    currentIndex = (currentIndex - 1 + imgSources.length) % imgSources.length;
    modalImg.src = imgSources[currentIndex];
  };

  modal.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
</script>
</body>
</html>

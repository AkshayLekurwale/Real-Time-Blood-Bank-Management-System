<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>News Ticker</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }

    .news {
      display: flex;
      align-items: center;
      background: linear-gradient(90deg, #0066cc, #004080);
      color: white;
      border-radius: 12px;
      padding: 10px 15px;
      margin: 30px auto;
      max-width: 1000px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .news-label {
      background-color: #e60000;
      padding: 10px 15px;
      border-radius: 30px;
      font-weight: bold;
      margin-right: 15px;
      white-space: nowrap;
    }

    .news-text {
      flex-grow: 1;
      overflow: hidden;
      white-space: nowrap;
    }

    .news-text marquee {
      color: #fffcd9;
      font-size: 16px;
      font-weight: 500;
    }

    @media screen and (max-width: 600px) {
      .news {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
        height: auto;
      }

      .news-label {
        margin-bottom: 10px;
      }

      .news-text marquee {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

<div class="news">
  <div class="news-label">📰 Latest Updates</div>
  <div class="news-text">
    <marquee scrollamount="5">📢 Upcoming Blood Donation Camp Alert! We’re excited to announce our next donation drive at Sinhgad College on 15th June 2025. Join hands with us and become a real-life hero by donating blood. Your one unit can save up to 3 lives. Let’s make a difference—together! ❤️🩸</marquee>
  </div>
</div>

</body>
</html>

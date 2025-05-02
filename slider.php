<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Donation Carousel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .carousel-inner > .item > img {
      width: 100%;
      height: 550px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .carousel-control .glyphicon {
      font-size: 30px;
      margin-top: 50%;
    }

    .carousel-indicators li {
      background-color: #999;
    }

    .carousel-indicators .active {
      background-color: #d9534f;
    }

    @media screen and (max-width: 768px) {
      .carousel-inner > .item > img {
        height: 300px;
      }
    }
  </style>
</head>
<body>

<div class="container" style="margin-top:100px">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="image/_107317099_blooddonor976.jpg" alt="Blood Donation Awareness">
      </div>
      <div class="item">
        <img src="image/Blood-facts_10-illustration-graphics__canteen.png" alt="Blood Facts">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
</div>

</body>
</html>

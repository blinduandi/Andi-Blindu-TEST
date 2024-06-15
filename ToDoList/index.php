<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/homepage.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ToDoList</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  d-flex justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Log In</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://www.caa.ca/app/uploads/2021/01/CAA_Travel_AAA_Diamond_Program-1500x500-cropped.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnBDiX7sBH9zVizCxhiTqGwmLBMlxE27yq3Q&s" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://www.valmet-automotive.com/wp-content/uploads/2018/06/va_bg_hris_3-1500x500.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<section id="about" class="mt-5">
<div class="title"><span class="title_section">About Us</span></div>
<div class="container mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi hic aut consequatur possimus facilis doloribus inventore fugit eum dolores assumenda!</div>
        <div class="col-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos libero suscipit est. Rerum qui accusamus voluptatibus consequatur dolore asperiores dolorem totam!</div>
        <div class="col-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quam quaerat sed nemo necessitatibus accusantium voluptate nostrum distinctio laboriosam.</div>
    </div>
</div>
</section>



<section class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti enim rem consequatur iste ab minima error, hic voluptate! Quos, magni fugiat excepturi aspernatur nostrum totam ab, facere accusantium earum ex consequuntur quisquam veritatis impedit omnis laborum odit atque ipsa molestiae quasi minus odio deleniti? Nesciunt hic incidunt cupiditate at quam.</div>
            <div class="col-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint expedita fugiat voluptate, fugit recusandae eveniet? Voluptatem sit assumenda ipsum vel fugiat blanditiis quod quas recusandae, repellat facere perspiciatis voluptatum! Ipsum reiciendis laborum illo ratione corporis eveniet in dolor aliquam eos. Asperiores iusto eum tenetur voluptates minus aliquam aperiam adipisci consectetur!</div>
        </div>
    </div>
</section>
</body>
</html>
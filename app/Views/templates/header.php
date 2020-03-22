<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <link rel="manifest" href="/manifest.json">
  <style>
    #slash a:after {
      content: "/";
      margin-left: 20px;
    }

    #slash a:last-child:after {
      content: "";
      margin-left: 20px;
    }

    #slash a {
      color: black;
    }

    .no-gutters {
      margin-right: 0;
      margin-left: 0;
    }

    .dropdown-toggle::after {
      display: none;
    }
  </style>
  <title>Blog</title>
</head>

<body style="font-family: 'Barlow', sans-serif;">
  <div class="container sticky-top" style="background-color: white;">
    <header class="blog-header py-3" style="line-height: 1;border-bottom: 2px solid #eeeeee;">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark h2 text-decoration-none" href="/">CI Blog</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="text-muted" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false">
              <title>Search</title>
              <circle cx="10.5" cy="10.5" r="7.5"></circle>
              <path d="M21 21l-5.2-5.2"></path>
            </svg>
          </a>
          <?php if(! isset($_SESSION['session-id'])): ?>
          <a class="btn btn-sm btn-outline-secondary" href="/login">LOGIN</a>
          <?php else: ?>
          <div class="dropdown ml-2">
            <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item mt-1" href="<?=base_url()?>/users/profile"><i class="fa fa-user" aria-hidden="true"></i>
                My Profile</a>
              <a class="dropdown-item mt-1" href="<?=base_url()?>/users/post"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                Write a Post</a>
              <a class="dropdown-item mt-1" href="<?=base_url()?>/users/categories"><i class="fa fa-object-group" aria-hidden="true"></i>
                Create a Category</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>
                Logout</a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2" id="slash">
      <nav class="nav d-flex justify-content-between" style="line-height:2;border-bottom: 2px solid #eeeeee;">
        <a class="p-2 font-weight-normal text-decoration-none" href="#">World</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">U.S.</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Technology</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Design</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Culture</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Business</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Politics</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Opinion</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Science</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Health</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Style</a>
        <a class="p-2 font-weight-normal text-decoration-none" href="#">Travel</a>
      </nav>
    </div>
  </div>
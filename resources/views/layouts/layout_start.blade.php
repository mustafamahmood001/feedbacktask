<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    

<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/owl.carousel.min.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Product Feedback</title>
</head>
<body>
<!-- start -->
<div class="navbarContent">
            <div id="spinner">
                <div class="spinner-grow text-primary m-0" role="status">
                    <span class="visually-hidden"></span>
                    <a href="/"> <h1 style=" margin-left:20%;  font-weight: 100px; font-size:35px;color: blue; margin: 0;"> Product</h1></a>
                </div>
            </div>
            @if(Request::is('/'))
  <form class="form-inline" action="{{ route('indexUser') }}" method="GET">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
    @if(auth()->guest())
        <div class="buttonLogin">
            <button type="button" class="btn btn-outline-light"><a href="{{ route('login') }}">Log In</a></button>
        </div>
    @else
        @if(auth()->user()->role === 'user')
        <div class="userContent">   
        <!-- Only show the following options for users with the 'user' role -->
            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Picture" class="img-fluid rounded-circle img-thumbnail" style="width:33%;" id="userProfileShow">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name ?? 'My Account' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                <li><a class="dropdown-item" >My Feedbacks</a></li>
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
        @csrf
        <li style="margin-left: 9%; color:black;">Log Out</li>
    </form>
</a>
            </ul>
        @else
        </div>
            <!-- Show a simplified version for users with roles other than 'user' -->
            <div class="buttonLogin">
                <button type="button" class="btn btn-outline-light"><a href="{{ route('logout') }}">Log Out</a></button>
            </div>
        @endif
    @endif
@endif

</div>

<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
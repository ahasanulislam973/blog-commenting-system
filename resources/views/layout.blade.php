<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <style>
        /* Basic layout styles */
        body {
            background-color: #f4f4f9;
            /* Light background color for the page */
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #333;
            /* Dark background for navbar */
        }

        .navbar .navbar-brand,
        .navbar .nav-link {
            color: white !important;
            /* White text for navbar links */
        }

        .navbar .nav-link:hover {
            color: #f39c12 !important;
            /* Hover effect for links */
        }

        .container.mt-5 {
            background-color: #fff;
            /* White background for login form */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin-top: 100px;
            /* Center the login form vertically */
        }

        /* Heading styling */
        h2.text-center {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }

        /* Button Styling */
        button[type="submit"] {
            background-color: #f39c12;
            /* Golden button color */
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #e67e22;
            /* Darker shade on hover */
        }

        /* Input fields */
        input.form-control {
            border-radius: 30px;
            font-size: 16px;
        }

        /* Error message styling */
        .text-danger {
            font-size: 14px;
            color: #e74c3c;
        }

        /* Link Styling */
        a {
            color: #f39c12;
        }

        a:hover {
            color: #e67e22;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Blog</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feed') }}">Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}">Create Post</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 Blog System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

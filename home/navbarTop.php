<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/bciflogo.png">
    <title>BCIF Santa Barbara</title>
    <!-- Bootstrap CSS -->
    <link id="pagestyle" href="../assets/dashboard.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #E8F1F2;
    }


    a,
    .toggle-btn {
        cursor: pointer;
    }

    .navbar {
        background-color: #13293D;
    }

    .navbar-nav .nav-link {
        color: #E8F1F2;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    .navbar-nav .nav-link:hover {
        color: #1B98E0;
        transform: translateY(-2px);
    }

    .navbar-nav .nav-link.active {
        color: #247ba0;
        font-weight: bold;
    }

    .modal-content {
        background-color: #FFFFFF;
    }

    .form-label {
        font-weight: bold;
        color: #13293D;
    }

    .btn-close {
        background: transparent;
        border: none;
        color: #13293D;
    }

    .btn-close:hover {
        color: red;
    }

    .text-info {
        color: #1B98E0;
    }

    .text-info:hover {
        color: #006494;
    }

    .toggle-btn:hover {
        text-decoration: underline;
        color: #1B98E0;
    }

    .btn-primary {
        background-color: #1B98E0;
        border: none;
    }

    .btn-primary:hover {
        background-color: #006494;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .valid-feedback {
        color: red;
        font-size: 0.875rem;
    }
    </style>
</head>

<body>
    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="home.php">
                <img src="../img/logomock.png" alt="Logo" width="120" height="70"
                    class="d-inline-block align-text-center">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="material-icons">menu</i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    $nav_items = [
                        'home.php' => 'Home',
                        'event.php' => 'Events',
                        'about.php' => 'About Us',
                    ];

                    foreach ($nav_items as $page => $title) {
                        $active_class = ($current_page === $page) ? 'active' : '';
                        echo "<li class='nav-item'>
                                <a class='nav-link fs-5 $active_class' href='$page'>$title</a>
                              </li>";
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 me-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
                    </li>
                </ul>

                <button class="btn btn-primary btn-auth ms-3 mt-3 px-5" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </nav>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">Login Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="material-icons">close</i></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">Welcome back</h2>
                    <form class="needs-validation" id="loginForm" action="login.php" method="POST" novalidate>
                        <div class="mb-3 form-floating">
                            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Email"
                                required>
                            <label for="loginEmail">Email</label>
                            <div class="valid-feedback" id="emailFeedback"></div>
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="password" name="password" class="form-control" id="loginPassword"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                            <div class="valid-feedback" id="passwordFeedback"></div>
                            <div class="invalid-feedback">
                                Please enter your password.
                            </div>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary fs-6">Login</button>
                <div class="text-center my-3">
                    <span>Don't have an account?
                        <a class="toggle-btn fs-5" data-bs-toggle="modal" data-bs-target="#signupModal">Sign
                            Up</a>
                    </span>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signupModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="signupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="material-icons">close</i></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">Join us today!</h2>
                    <form class="needs-validation" id="signupForm" action="register.php" method="POST" novalidate>
                        <div class="mb-3 form-floating">
                            <input type="text" name="first_name" class="form-control" id="firstName"
                                placeholder="First Name" required>
                            <label for="firstName">First Name</label>
                            <div class="invalid-feedback">
                                First name is required.
                            </div>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" name="last_name" class="form-control" id="lastName"
                                placeholder="Last Name" required>
                            <label for="lastName">Last Name</label>
                            <div class="invalid-feedback">
                                Last name is required.
                            </div>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="email" name="email" class="form-control" id="signupEmail" placeholder="Email"
                                required>
                            <label for="signupEmail">Email</label>
                            <div class="valid-feedback" id="signupEmailFeedback">Looks Good!</div>
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="password" name="password" class="form-control" id="signupPassword"
                                placeholder="Password" required>
                            <label for="signupPassword">Password</label>
                            <div class="valid-feedback" id="signupPasswordFeedback"></div>
                            <div class="invalid-feedback">
                                Please enter a password.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary fs-6">Sign Up</button>
                        <div class="text-center my-3">
                            <span>Already have an account?
                                <a class="toggle-btn fs-5" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+qB9qY5tY5LW2NxO9EJh58mOh7H0d" crossorigin="anonymous">
    </script>

    <script>
    // valid input validation
    document.getElementById('loginEmail').addEventListener('input', function() {
        const emailFeedback = document.getElementById('emailFeedback');
        const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/; // Simple email pattern for .com
        if (!emailPattern.test(this.value)) {
            emailFeedback.textContent = "Email must be valid and end with .com";
        } else {
            emailFeedback.textContent = "";
        }
    });

    document.getElementById('loginPassword').addEventListener('input', function() {
        const passwordFeedback = document.getElementById('passwordFeedback');
        const passwordPattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(this.value)) {
            passwordFeedback.textContent =
                "Password must be at least 8 characters, with a number, a capital letter, and a special character.";
        } else {
            passwordFeedback.textContent = "";
        }
    });

    document.getElementById('signupEmail').addEventListener('input', function() {
        const signupEmailFeedback = document.getElementById('signupEmailFeedback');
        const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/; // Simple email pattern for .com
        if (!emailPattern.test(this.value)) {
            signupEmailFeedback.textContent = "Email must be valid and end with .com";
        } else {
            signupEmailFeedback.textContent = "";
        }
    });

    document.getElementById('signupPassword').addEventListener('input', function() {
        const signupPasswordFeedback = document.getElementById('signupPasswordFeedback');
        const passwordPattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(this.value)) {
            signupPasswordFeedback.textContent =
                "Password must be at least 8 characters, with a number, a capital letter, and a special character.";
        } else {
            signupPasswordFeedback.textContent = "";
        }
    });

    // Password visibility toggle
    document.getElementById('togglePasswordLogin').addEventListener('click', function() {
        const passwordField = document.getElementById('loginPassword');
        const passwordFieldType = passwordField.getAttribute('type');
        passwordField.setAttribute('type', passwordFieldType === 'password' ? 'text' : 'password');
    });

    document.getElementById('togglePasswordSignup').addEventListener('click', function() {
        const passwordField = document.getElementById('signupPassword');
        const passwordFieldType = passwordField.getAttribute('type');
        passwordField.setAttribute('type', passwordFieldType === 'password' ? 'text' : 'password');
    });
    </script>
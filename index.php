<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/student_management/images/logo.png">
    <title>Student Hub | Home</title>

    <link rel="stylesheet" href="/student_management/css/style.css">

    <style>
        /* ===== GENERAL STYLES ===== */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #f5f8f6;
            color: #183b2d;
            font-family: Arial, Helvetica, sans-serif;
        }

        main {
            width: 100%;
        }

        section {
            margin-top: 2px;
        }

        /* ===== HERO SECTION ===== */

        .hero {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;

            min-height: 350px;
            margin: 8px;
            padding: 60px 25px 30px;

            border-radius: 10px;
            overflow: hidden;

            background:
                linear-gradient(
                    90deg,
                    rgba(6, 74, 6, 0.96) 0%,
                    rgba(8, 59, 8, 0.96) 10%,
                    rgba(4, 53, 4, 0.96) 20%,
                    rgba(4, 44, 33, 0.9) 35%,
                    rgba(0, 45, 32, 0.60) 65%,
                    rgba(0, 45, 32, 0.20) 100%
                ),
                url("/student_management/images/image.png");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            box-shadow: 0 4px 12px rgba(0, 45, 32, 0.12);
        }

        /* ===== LOGIN AND REGISTER ===== */

        .top-buttons {
            position: absolute;
            top: 18px;
            right: 20px;

            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 95px;
            padding: 10px 18px;

            border: 2px solid white;
            border-radius: 7px;

            font-size: 15px;
            font-weight: bold;
            text-decoration: none;

            transition: 0.2s ease;
        }

        .login-btn {
            background: transparent;
            color: white;
        }

        .login-btn:hover {
            background: white;
            color: #043f2e;
        }

        .register-btn {
            background: #65d995;
            border-color: #65d995;
            color: #003b29;
        }

        .register-btn:hover {
            background: white;
            border-color: white;
            color: #043f2e;
        }

        /* ===== HERO CONTENT ===== */

        .hero .content {
            width: 100%;
            max-width: 850px;
            margin: auto;

            text-align: center;
            color: white;
        }

        .hero .subtitle {
            margin: 0 0 10px;

            color: #8ce7b1;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hero h1 {
            margin: 0;

            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.2;

            color: white;
        }

        .hero .description {
            max-width: 620px;
            margin: 15px auto 0;

            color: #e7f3ec;
            font-size: 16px;
            line-height: 1.6;
        }

        .hero .description strong {
            color: white;
        }

        /* ===== FEATURE CARDS ===== */

        .features-section {
            max-width: 1500px;
            margin: 15px auto;
            padding: 0 15px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
        }

        .feature-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;

            min-height: 200px;
            padding: 20px;

            background: white;
            border: 1px solid #e0ebe4;
            border-radius: 10px;

            box-shadow: 0 3px 10px rgba(0, 45, 32, 0.06);

            color: inherit;
            text-decoration: none;

            transition: 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            border-color: #65c995;
            box-shadow: 0 6px 16px rgba(0, 45, 32, 0.12);
        }

        /* Feature icons */

        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 48px;
            height: 48px;
            margin-bottom: 12px;

            border-radius: 10px;
            background: #e2f4e9;

            color: #08613e;
            font-size: 25px;
        }

        .feature-card h3 {
            margin: 0 0 8px;

            color: #06452f;
            font-size: 18px;
            line-height: 1.4;
        }

        .feature-card p {
            margin: 0;

            color: #64766c;
            font-size: 14px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
<main>
    <!-- HERO SECTION -->

    <section class="hero">

        <div class="top-buttons">
            <a href="login.php" class="hero-btn login-btn">
                Login
            </a>

            <a href="register.php" class="hero-btn register-btn">
                Register
            </a>
        </div>

        <div class="content">

            <p class="subtitle">
                Welcome to Student Hub
            </p>

            <h1>
                Manage Your<br>
                Academic Journey
            </h1>

            <p class="description">
                Manage courses, enrollments, and results easily
                from one place.  <br><strong>Your academic journey starts here.</strong>
            </p>

        </div>
    </section>

    <!-- FEATURE CARDS -->

    <section class="features-section">

        <div class="features">

            <!-- Course Management -->

            <div class="feature-card">

                <div class="feature-icon">
                    📚
                </div>

                <h3>Course Management</h3>

                <p>
                    Explore available courses and find detailed
                    information about each course.
                </p>


        </div>


            <!-- Enrollment -->

            <div class="feature-card">

                <div class="feature-icon">
                    📝
                </div>

                <h3>Easy Enrollment</h3>

                <p>
                    Access your student account and manage
                    your course enrollments easily.
                </p>

                

        </div>


            <!-- Results -->

            <div class="feature-card">

                <div class="feature-icon">
                    📊
                </div>

                <h3>View Results</h3>

                <p>
                    Check your marks, grades, and academic
                    progress in one convenient place.
                </p>   

        </div>


            <!-- Student Profile -->

            <div class="feature-card">

                <div class="feature-icon">
                    👤
                </div>

                <h3>Student Profile</h3>

                <p>
                    Access your personal information and
                    manage your student account.
                </p>

                
            </div>

        </div>

    </section>


</main>


<!-- EXISTING FOOTER -->

<?php
    include "includes/footer.php";
?>

</body>
</html>
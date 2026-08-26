<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Forgot Password</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
            color: #666;
        }

        .container input[type="email"] {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            margin: 8px 0;
            padding: 10px;
            font-size: 14px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        /* .container button {
            background-color: #4CAF50;
            color: #fff;
            font-size: 14px;
            padding: 10px 0;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        } */

        button {
            width: 100%;
            background-color: #f39c12;
            font-size: 14px;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #d68910;
        }

        .container a {
            display: block;
            margin-top: 15px;
            color: #333;
            font-size: 13px;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h1>Forgot Password</h1>
            <p>Please enter your registered email</p>
            <input type="email" name="email" placeholder="Email" required />
            <button type="submit" name="reset_password">Submit</button>
        </form>
    </div>
</body>

</html>
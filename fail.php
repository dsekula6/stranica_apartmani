<?php
// fail.php

// Output the HTML content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        #counter {
            font-size: 48px;
            color: #ff0000;
        }
    </style>
    <script>
        // JavaScript counter
        var count = 3;

        // Function to update the counter and redirect after reaching 0
        function updateCounter() {
            var counterElement = document.getElementById("counter");
            counterElement.innerHTML = count;

            if (count === 0) {
                window.location.href = "index.php";
            } else {
                count--;
                setTimeout(updateCounter, 1000);
            }
        }

        // Start the counter on page load
        window.onload = updateCounter;
    </script>
</head>
<body>
    <div class="container">
        <h1>Payment Failed</h1>
        <p>Oops! Something went wrong with the payment.</p>
        <p>Redirecting to the homepage in <span id="counter">3</span> seconds...</p>
        <p>if you didn't get redirected <a href="index.php">click here</a></p>
    </div>
</body>
</html>

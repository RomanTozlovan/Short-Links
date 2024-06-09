<?php
session_start();
if (isset($_SESSION['firstname'])) {
    require 'head.php';
}

else{
    require 'header.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .pricing-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 80px;
        }

        .plan {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            width: 260px;
            text-align: center;
        }

        .plan.popular {
            border: 2px solid #007bff;
        }

        .plan h3 {
            margin-top: 0;
            color: #333;
        }

        .plan .price {
            font-size: 24px;
            color: #007bff;
            margin: 10px 0;
        }

        .plan .price span {
            font-size: 14px;
            color: #999;
            display: block;
        }

        .plan ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .plan ul li {
            margin: 10px 0;
            color: #666;
        }

        .plan button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .plan button:hover {
            background-color: #0056b3;
        }

        .features {
            text-align: left;
            margin-top: 20px;
        }

        .features p {
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .features ul {
            list-style: none;
            padding: 0;
        }

        .features ul li {
            margin: 10px 0;
            color: #666;
        }

        .features ul li i {
            color: #007bff;
            margin-right: 10px;
        }

    </style>
</head>
<body>
<h1 style="text-align: center; margin-top: 50px;font-size: 30; color: #0b1315; margin-bottom: -50px "  >Price for Subscription</h1>
<div class="pricing-container">
    <div class="plan">
        <h3>FREE</h3>
        <p class="price">$0/month</p>
        <ul>
            <li>2 QR Codes/month</li>
            <li>10 links/month</li>
            <li>1 landing page</li>
        </ul>
        <button>Get Started</button>
        <div class="features">
            <p>Includes:</p>
            <ul>
                <li><i class="fas fa-check"></i> 5 custom back-halves</li>
                <li><i class="fas fa-check"></i> Unlimited clicks & QR Code scans</li>
                <li><i class="fas fa-check"></i> QR Code customizations</li>
            </ul>
        </div>
    </div>
    <div class="plan popular">
        <h3>CORE</h3>
        <p class="price">$8/month <span>(annual charge of $96)</span></p>
        <ul>
            <li>5 QR Codes/month</li>
            <li>100 links/month</li>
            <li>1 landing page</li>
        </ul>
        <button>Get Started</button>
        <div class="features">
            <p>Everything in Free, plus:</p>
            <ul>
                <li><i class="fas fa-check"></i> 30 days of click & scan data</li>
                <li><i class="fas fa-check"></i> UTM Builder</li>
                <li><i class="fas fa-check"></i> Advanced QR Code customizations</li>
                <li><i class="fas fa-check"></i> Link & QR Code redirects</li>
            </ul>
        </div>
    </div>
    <div class="plan">
        <h3>GROWTH</h3>
        <p class="price">$29/month <span>(annual charge of $348)</span></p>
        <ul>
            <li>10 QR Codes/month</li>
            <li>500 links/month</li>
            <li>2 landing pages</li>
        </ul>
        <button>Get Started</button>
        <div class="features">
            <p>Everything in Core, plus:</p>
            <ul>
                <li><i class="fas fa-check"></i> Complimentary custom domain</li>
                <li><i class="fas fa-check"></i> Branded links</li>
                <li><i class="fas fa-check"></i> 4 months of click & scan data</li>
                <li><i class="fas fa-check"></i> Bulk link shortening</li>
            </ul>
        </div>
    </div>
    <div class="plan">
        <h3>PREMIUM</h3>
        <p class="price">$199/month <span>(annual charge of $2,388)</span></p>
        <ul>
            <li>200 QR Codes/month</li>
            <li>3,000 links/month</li>
            <li>5 landing pages</li>
        </ul>
        <button>Get Started</button>
        <div class="features">
            <p>Everything in Growth, plus:</p>
            <ul>
                <li><i class="fas fa-check"></i> 1 year of click & scan data</li>
                <li><i class="fas fa-check"></i> Custom campaign-level tracking</li>
                <li><i class="fas fa-check"></i> City-level & device type click & scan data</li>
                <li><i class="fas fa-check"></i> Mobile deep linking</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>

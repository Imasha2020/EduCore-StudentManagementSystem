<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted - EduCore</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand-primary: #2563eb;
            --brand-dark: #1e3a8a;
            --body-bg: #f0f4f9;
            --card-border: #dbeafe;
            --success-color: #10b981;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            padding: 24px;
        }

        .success-card {
            max-width: 540px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            background: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .success-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
        }

        .icon-container {
            width: 96px;
            height: 96px;
            background-color: #ecfdf5;
            color: var(--success-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
            font-size: 3.5rem;
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.1);
        }

        .tracking-tight {
            letter-spacing: -0.025em;
        }

        /* Premium Buttons Custom Variants */
        .btn-custom-primary {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #ffffff;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-custom-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-custom-outline {
            color: var(--brand-primary);
            border-color: var(--card-border);
            background-color: #eff6ff;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-custom-outline:hover {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #ffffff;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">

    <div class="card success-card shadow-lg">
        <div class="card-body text-center p-5">
            
            <div class="icon-container mb-4">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <h2 class="fw-bold tracking-tight text-dark mb-2">
                All Set! Application Received 🎉
            </h2>

            <p class="text-secondary fs-6 px-2">
                Thank you for applying to EduCore. We've successfully received your application details!
            </p>

            <p class="text-muted px-3 mb-4" style="font-size: 0.9rem; line-height: 1.5;">
                Our admissions team is already looking over your academic profile. We review every application carefully and will reach out to you via email with your next steps very soon. You can also log in to your portal anytime to check your real-time status.
            </p>

            <hr class="my-4" style="border-color: var(--card-border);">

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="index.php" class="btn btn-custom-primary px-4 py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-house-fill"></i> 
                    Return to Home
                </a>
                <a href="login.php" class="btn btn-custom-outline px-4 py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> 
                    Portal Login
                </a>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
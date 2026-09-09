<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal — Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-alt: #0d1b2a;
            --panel: rgba(15, 23, 42, 0.8);
            --line: rgba(148, 163, 184, 0.2);
            --primary: #60a5fa;
            --primary-strong: #2563eb;
            --accent: #8b5cf6;
            --success: #22c55e;
            --danger: #ef4444;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --shadow: 0 30px 60px rgba(15, 23, 42, 0.45);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 36px 18px;
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.2), transparent 32%),
                linear-gradient(135deg, var(--bg) 0%, #0b1220 100%);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            margin-bottom: 28px;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid var(--line);
            border-radius: 999px;
            backdrop-filter: blur(10px);
        }

        nav a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 999px;
            transition: all 0.2s ease;
        }

        nav a:hover {
            background: rgba(96, 165, 250, 0.08);
            color: var(--text);
        }

        .card {
            width: min(100%, 520px);
            background: rgba(15, 23, 42, 0.76);
            border: 1px solid var(--line);
            border-radius: 28px;
            padding: 32px 28px 26px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .badge-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 22px;
            display: grid;
            place-items: center;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--primary-strong), var(--accent));
            box-shadow: 0 22px 36px rgba(37, 99, 235, 0.35);
            font-size: 2rem;
        }

        h1 {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            letter-spacing: -0.05em;
            margin-bottom: 12px;
        }

        .sub {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .notice {
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fecaca;
            margin-bottom: 22px;
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-strong), var(--accent));
            color: white;
            text-decoration: none;
            padding: 14px 22px;
            border-radius: 14px;
            font-weight: 700;
            box-shadow: 0 18px 32px rgba(37, 99, 235, 0.28);
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
    </nav>

    <div class="card">
        <div class="badge-icon">🎓</div>
        <h1>Welcome, <?= htmlspecialchars($name); ?></h1>
        <p class="sub">This is your student portal home page. Visiting this page grants you a temporary access badge to view your profile.</p>

        <?php if ($denied): ?>
            <div class="notice">
                Access denied: you need an active badge before viewing the profile page. It has been granted now — try the link below.
            </div>
        <?php endif; ?>

        <a class="btn" href="<?= site_url('student/profile'); ?>">View My Profile →</a>
    </div>
</body>
</html>

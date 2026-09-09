<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information — <?= htmlspecialchars($name); ?></title>
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

        .id-card {
            width: min(100%, 600px);
            overflow: hidden;
            background: rgba(15, 23, 42, 0.76);
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: var(--shadow);
        }

        .id-header {
            padding: 28px 24px 22px;
            background: linear-gradient(135deg, var(--primary-strong), var(--accent));
            text-align: center;
        }

        .id-header h1 {
            font-size: 1.6rem;
            letter-spacing: -0.04em;
        }

        .avatar {
            width: 76px;
            height: 76px;
            margin: 18px auto 0;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.18);
            color: white;
            font-weight: 800;
            font-size: 1.8rem;
            border: 2px solid rgba(255,255,255,0.25);
        }

        .id-body {
            padding: 22px 22px 18px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        }

        .label {
            color: var(--muted);
            font-weight: 700;
        }

        .value {
            text-align: right;
            color: var(--text);
            font-weight: 600;
            max-width: 60%;
            word-break: break-word;
        }

        .bio {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid rgba(148, 163, 184, 0.15);
            color: #dbeafe;
            font-style: italic;
            line-height: 1.7;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
    </nav>

    <div class="id-card">
        <div class="id-header">
            <h1>Student Information</h1>
            <div class="avatar"><?= htmlspecialchars(strtoupper(substr($name, 0, 1))); ?></div>
        </div>
        <div class="id-body">
            <div class="row"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student_id); ?></span></div>
            <div class="row"><span class="label">Name</span><span class="value"><?= htmlspecialchars($name); ?></span></div>
            <div class="row"><span class="label">Course</span><span class="value"><?= htmlspecialchars($course); ?></span></div>
            <div class="row"><span class="label">Year Level</span><span class="value"><?= htmlspecialchars($year); ?></span></div>
            <div class="row"><span class="label">Section</span><span class="value"><?= htmlspecialchars($section); ?></span></div>
            <div class="row"><span class="label">Email</span><span class="value"><?= htmlspecialchars($email); ?></span></div>
            <div class="row"><span class="label">Address</span><span class="value"><?= htmlspecialchars($address); ?></span></div>
            <div class="row"><span class="label">Contact</span><span class="value"><?= htmlspecialchars($contact); ?></span></div>
            <div class="row"><span class="label">Skills</span><span class="value"><?= htmlspecialchars($skills); ?></span></div>
            <p class="bio">"<?= htmlspecialchars($bio); ?>"</p>
        </div>
    </div>
</body>
</html>

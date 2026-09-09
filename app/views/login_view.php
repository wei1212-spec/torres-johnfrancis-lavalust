<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0d1b2a;
            --panel: rgba(15, 23, 42, 0.86);
            --panel-strong: #111827;
            --surface: #f8fafc;
            --line: rgba(148, 163, 184, 0.22);
            --primary: #60a5fa;
            --primary-strong: #2563eb;
            --accent: #8b5cf6;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --shadow: 0 30px 60px rgba(15, 23, 42, 0.45);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.22), transparent 30%),
                radial-gradient(circle at bottom right, rgba(139, 92, 246, 0.18), transparent 28%),
                linear-gradient(135deg, var(--bg) 0%, #0b1220 100%);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            padding: 24px;
        }

        .auth-shell {
            width: min(100%, 980px);
            min-height: 620px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid var(--line);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .brand-panel {
            background: linear-gradient(160deg, rgba(37, 99, 235, 0.18), rgba(13, 27, 42, 0.95));
            padding: 42px 38px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(148,163,184,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,0.08) 1px, transparent 1px);
            background-size: 38px 38px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 100%);
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            box-shadow: 0 20px 30px rgba(96, 165, 250, 0.24);
            font-size: 1.5rem;
            margin-bottom: 18px;
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 16px;
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--primary);
            font-weight: 700;
        }

        .brand-panel h1 {
            font-size: clamp(2.4rem, 4vw, 4rem);
            line-height: 1.05;
            margin-bottom: 18px;
            letter-spacing: -0.06em;
        }

        .brand-panel p {
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 420px;
        }

        .mini-metrics {
            display: flex;
            gap: 18px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .metric {
            min-width: 110px;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--line);
            border-radius: 16px;
        }

        .metric strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .metric span {
            color: var(--muted);
            font-size: 0.82rem;
        }

        .form-panel {
            background: rgba(15, 23, 42, 0.92);
            padding: 48px 34px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            width: min(100%, 360px);
        }

        .title-row {
            margin-bottom: 24px;
        }

        h2 {
            font-size: 2rem;
            letter-spacing: -0.05em;
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.96rem;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .alert.error { background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239,68,68,0.35); color: #fca5a5; }
        .alert.info { background: rgba(96,165,250,0.12); border: 1px solid rgba(96,165,250,0.35); color: #bfdbfe; }
        .alert.success { background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.35); color: #bbf7d0; }

        form { display: grid; gap: 16px; }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            font-size: 0.8rem;
            color: var(--muted);
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.25);
            background: rgba(15, 23, 42, 0.7);
            color: var(--text);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 0.96rem;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        input:focus {
            outline: none;
            border-color: rgba(96, 165, 250, 0.9);
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.16);
        }

        button {
            margin-top: 8px;
            width: 100%;
            border: none;
            cursor: pointer;
            padding: 15px 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary-strong), var(--accent));
            color: white;
            font-weight: 700;
            font-size: 0.98rem;
            letter-spacing: 0.02em;
            box-shadow: 0 18px 32px rgba(37, 99, 235, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 22px 36px rgba(37, 99, 235, 0.42);
        }

        .footer-link {
            margin-top: 20px;
            text-align: center;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .footer-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 820px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .brand-panel,
            .form-panel {
                padding: 30px 22px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="brand-panel">
            <div class="brand-content">
                <div class="brand-badge">L</div>
                <span class="eyebrow">LavaLust</span>
                <h1>Manage your workflow with clarity.</h1>
                <p>Track, create, and update your product inventory from one modern dashboard built for fast, focused work.</p>
                <div class="mini-metrics">
                    <div class="metric">
                        <strong>24/7</strong>
                        <span>Monitoring</span>
                    </div>
                    <div class="metric">
                        <strong>50+</strong>
                        <span>Entries</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-card">
                <div class="title-row">
                    <h2>Welcome back</h2>
                    <p class="subtitle">Sign in to continue to your workspace.</p>
                </div>

                <?php if (!empty($denied)): ?>
                    <div class="alert info">Please log in to continue.</div>
                <?php endif; ?>
                <?php if (!empty($registered)): ?>
                    <div class="alert success">Account created successfully. You can now log in.</div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('login'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" autocomplete="username" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" required>
                    </div>

                    <button type="submit">Log In</button>
                </form>

                <div class="footer-link">
                    Don’t have an account? <a href="<?= base_url('register'); ?>">Create one</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

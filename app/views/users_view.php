<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Directory | LavaLust</title>
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
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.18), transparent 30%),
                linear-gradient(135deg, var(--bg) 0%, #0b1220 100%);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            padding: 32px 18px 56px;
        }

        .shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
            flex-wrap: wrap;
        }

        h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: -0.06em;
        }

        .summary {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .panel {
            background: rgba(15, 23, 42, 0.76);
            border: 1px solid var(--line);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--line);
            background: rgba(15, 23, 42, 0.45);
        }

        .panel-head h2 {
            font-size: 1.15rem;
            letter-spacing: -0.04em;
        }

        .chip {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(96, 165, 250, 0.12);
            border: 1px solid rgba(96, 165, 250, 0.3);
            color: #bfdbfe;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 16px 18px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        }

        th {
            background: rgba(15, 23, 42, 0.9);
            color: #dfeafc;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        tbody tr:hover {
            background: rgba(96, 165, 250, 0.04);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 0.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
        }

        .meta {
            display: grid;
            gap: 2px;
        }

        .meta strong {
            font-size: 0.96rem;
        }

        .meta span {
            color: var(--muted);
            font-size: 0.8rem;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 32px 18px;
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div>
                <h1>User Directory</h1>
                <div class="summary">Manage team members and account profiles.</div>
            </div>
            <div class="chip"><?= is_array($users ?? null) ? count($users) : 0; ?> members</div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>All members</h2>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Member ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <?php
                                    $firstname = $user['firstname'] ?? 'User';
                                    $lastname = $user['lastname'] ?? '';
                                    $initials = strtoupper(substr($firstname, 0, 1) . substr($lastname, 0, 1));
                                ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <span class="avatar"><?= htmlspecialchars($initials ?: 'U'); ?></span>
                                            <div class="meta">
                                                <strong><?= htmlspecialchars(trim($firstname . ' ' . $lastname)); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($user['email'] ?? ''); ?></td>
                                    <td>@<?= htmlspecialchars($user['username'] ?? ''); ?></td>
                                    <td>#<?= htmlspecialchars($user['id'] ?? ''); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="empty">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #172126;
            --muted: #657277;
            --paper: #f5f1e8;
            --panel: #fffdf8;
            --line: #d8d0c1;
            --coral: #e85d46;
            --teal: #176b68;
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--paper); color: var(--ink); font-family: 'Space Grotesk', sans-serif; }
        .shell { max-width: 1120px; margin: auto; padding: 2rem 1.5rem 4rem; }
        header { display: flex; align-items: end; justify-content: space-between; gap: 1rem; padding-bottom: 1.5rem; border-bottom: 2px solid var(--ink); }
        .eyebrow { margin: 0 0 .5rem; color: var(--coral); font: 500 .75rem 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(2.5rem, 7vw, 5rem); line-height: .95; font-weight: 600; letter-spacing: -.04em; }
        .count { margin: 0; color: var(--teal); font: 500 .8rem 'DM Mono', monospace; text-align: right; text-transform: uppercase; }
        .table-wrap { margin-top: 2rem; overflow-x: auto; background: var(--panel); border: 1px solid var(--line); box-shadow: 10px 10px 0 rgba(23, 33, 38, .08); }
        table { border-collapse: collapse; width: 100%; min-width: 700px; }
        th, td { padding: 1rem 1.1rem; border-bottom: 1px solid var(--line); text-align: left; }
        th { color: var(--muted); background: #eeeadf; font: 500 .72rem 'DM Mono', monospace; letter-spacing: .08em; text-transform: uppercase; }
        td { font-size: .98rem; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr { transition: background .15s ease; }
        tbody tr:hover { background: #fff2e5; }
        td:first-child { color: var(--coral); font: 500 .9rem 'DM Mono', monospace; }
        @media (max-width: 600px) {
            .shell { padding: 1.25rem 1rem 3rem; }
            header { align-items: start; flex-direction: column; }
            .count { text-align: left; }
            .table-wrap { margin-top: 1.5rem; box-shadow: 6px 6px 0 rgba(23, 33, 38, .08); }
        }
    </style>
</head>
<body>
    <main class="shell">
        <header>
            <div>
                <p class="eyebrow">LavaLust / Directory</p>
                <h1>Users</h1>
            </div>
            <p class="count"><?= count($users) ?> record<?= count($users) === 1 ? '' : 's' ?></p>
        </header>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['firstname'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['lastname'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
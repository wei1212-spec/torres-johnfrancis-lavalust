<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function auth_escape($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Product Desk</title>
    <style>
        :root { --ink: #172126; --muted: #657277; --paper: #f5f1e8; --panel: #fffdf8; --line: #d8d0c1; --coral: #e85d46; --teal: #176b68; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: var(--paper); color: var(--ink); font-family: Georgia, serif; }
        .panel { width: min(440px, calc(100% - 2rem)); padding: 2.5rem; background: var(--panel); border: 1px solid var(--line); box-shadow: 12px 12px 0 rgba(23, 33, 38, .09); }
        .eyebrow { margin: 0 0 .75rem; color: var(--coral); font: 700 .72rem Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 0 0 .6rem; font-size: 3.2rem; font-weight: 400; line-height: .95; }
        .intro { margin: 0 0 2rem; color: var(--muted); font: 1rem/1.5 Arial, sans-serif; }
        label { display: block; margin: 1rem 0 .4rem; font: 700 .75rem Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: .85rem .9rem; border: 1px solid var(--line); background: #fff; color: var(--ink); font: 1rem Arial, sans-serif; }
        input:focus { outline: 2px solid var(--teal); outline-offset: 2px; }
        button { width: 100%; margin-top: 1.5rem; padding: .9rem 1rem; border: 0; background: var(--teal); color: #fff; cursor: pointer; font: 700 .82rem Arial, sans-serif; letter-spacing: .1em; text-transform: uppercase; }
        .error { padding: .75rem; border-left: 4px solid var(--coral); background: #fff0ea; color: #8b3427; font: .9rem/1.4 Arial, sans-serif; }
    </style>
</head>
<body>
    <main class="panel">
        <p class="eyebrow">LavaLust / Product Desk</p>
        <h1>Sign in.</h1>
        <p class="intro">Authenticate to manage the product inventory.</p>
        <?php if (!empty($error)): ?><p class="error"><?= auth_escape($error) ?></p><?php endif; ?>
        <form method="post" action="<?= auth_escape(site_url('login')) ?>">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" autocomplete="username" required>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            <button type="submit">Continue</button>
        </form>
    </main>
</body>
</html>
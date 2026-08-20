<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function student_profile_escape($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= student_profile_escape($student['name']) ?> | Profile</title>
    <style>
        :root { --navy: #14253d; --blue: #3c77b6; --gold: #e5ad42; --cloud: #eef3f7; --white: #fff; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--cloud); color: var(--navy); font-family: Arial, sans-serif; }
        .page { min-height: 100vh; padding: 30px 24px; }
        .card { background: var(--white); box-shadow: 0 18px 50px rgba(20,37,61,.12); margin: auto; max-width: 820px; overflow: hidden; }
        .top { background: var(--navy); color: var(--white); padding: 46px 52px; position: relative; }
        .top::after { background: var(--gold); content: ''; height: 8px; left: 0; position: absolute; right: 0; top: 0; }
        .top a { color: #b9d4ee; font-size: .82rem; text-decoration: none; }
        .protected-badge { align-items: center; background: rgba(229,173,66,.14); border: 1px solid rgba(229,173,66,.65); color: #f4ce78; display: inline-flex; font-size: .68rem; font-weight: 700; gap: 9px; letter-spacing: .12em; margin-top: 24px; padding: 9px 12px; text-transform: uppercase; }
        .lock { border: 2px solid currentColor; border-radius: 2px; display: inline-block; height: 12px; position: relative; width: 13px; }
        .lock::before { border: 2px solid currentColor; border-bottom: 0; border-radius: 8px 8px 0 0; content: ''; height: 8px; left: 1px; position: absolute; top: -9px; width: 7px; }
        h1 { font-size: clamp(2.4rem, 7vw, 4.8rem); font-weight: 400; letter-spacing: -.04em; margin: 42px 0 8px; }
        .top p { color: #b9c8d8; margin: 0; }
        .body { padding: 44px 52px 52px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 42px; }
        .item { border-bottom: 1px solid #dbe3ea; padding: 18px 0; }
        .item label { color: var(--blue); display: block; font-size: .7rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        .item p { font-size: 1.05rem; margin: 8px 0 0; }
        .back { background: var(--blue); color: var(--white); display: inline-block; font-size: .82rem; margin-top: 36px; padding: 13px 18px; text-decoration: none; }
        @media (max-width: 600px) { .top, .body { padding-left: 26px; padding-right: 26px; } .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<main class="page"><article class="card">
    <header class="top"><a href="<?= student_profile_escape(site_url('student')) ?>">← Back to Student Desk</a><div class="protected-badge"><span class="lock" aria-hidden="true"></span>Middleware protected route</div><h1>Student<br>Profile</h1><p><?= student_profile_escape($student['student_id']) ?> · <?= student_profile_escape($student['course']) ?></p></header>
    <section class="body"><div class="grid">
        <div class="item"><label>Full name</label><p><?= student_profile_escape($student['name']) ?></p></div>
        <div class="item"><label>Email</label><p><?= student_profile_escape($student['email']) ?></p></div>
        <div class="item"><label>Year level</label><p><?= student_profile_escape($student['year']) ?></p></div>
        <div class="item"><label>Section</label><p><?= student_profile_escape($student['section']) ?></p></div>
        <div class="item"><label>Location</label><p><?= student_profile_escape($student['location']) ?></p></div>
        <div class="item"><label>Interests</label><p><?= student_profile_escape($student['interests']) ?></p></div>
    </div><a class="back" href="<?= student_profile_escape(site_url('student')) ?>">Return home</a></section>
</article></main>
</body>
</html>
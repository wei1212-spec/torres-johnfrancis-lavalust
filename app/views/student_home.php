<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function student_escape($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rivera Student Desk</title>
    <style>
        :root { --ink: #172126; --paper: #f5f1e8; --coral: #e85d46; --teal: #176b68; --line: #d8d0c1; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: Georgia, serif; }
        .shell { max-width: 980px; margin: auto; padding: 28px 24px 64px; }
        nav { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--ink); padding-bottom: 18px; }
        nav strong { font-size: 1.15rem; letter-spacing: .08em; text-transform: uppercase; }
        nav a { color: var(--teal); margin-left: 22px; font: 600 .85rem Arial, sans-serif; text-decoration: none; }
        .hero { display: grid; grid-template-columns: 1.2fr .8fr; gap: 48px; align-items: end; padding: 92px 0 70px; }
        .eyebrow { color: var(--coral); font: 700 .75rem Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { font-size: clamp(3.2rem, 8vw, 6.6rem); line-height: .92; margin: 16px 0 24px; font-weight: 400; }
        .hero p { color: #526066; font: 1.05rem/1.7 Arial, sans-serif; max-width: 500px; }
        .note { border-left: 5px solid var(--coral); padding: 18px 0 18px 22px; font: 600 1.1rem/1.5 Arial, sans-serif; }
        .note span { display: block; color: var(--coral); font-size: .72rem; letter-spacing: .14em; margin-bottom: 12px; text-transform: uppercase; }
        .details { border-top: 1px solid var(--line); display: grid; grid-template-columns: repeat(3, 1fr); }
        .detail { border-right: 1px solid var(--line); padding: 24px 18px 24px 0; }
        .detail:nth-child(3n) { border-right: 0; }
        .detail label { color: #7d8587; display: block; font: 700 .7rem Arial, sans-serif; letter-spacing: .12em; margin-bottom: 8px; text-transform: uppercase; }
        .detail p { font-size: 1.1rem; margin: 0; }
        @media (max-width: 680px) { .hero { grid-template-columns: 1fr; gap: 24px; padding: 64px 0 48px; } .details { grid-template-columns: 1fr 1fr; } .detail:nth-child(3n) { border-right: 1px solid var(--line); } .detail:nth-child(2n) { border-right: 0; padding-left: 12px; } nav a { margin-left: 10px; } }
    </style>
</head>
<body>
<main class="shell">
    <nav>
        <strong>Student Desk</strong>
        <div><a href="<?= student_escape(site_url('student')) ?>">Home</a><a href="<?= student_escape(site_url('student/profile')) ?>">Profile</a></div>
    </nav>
    <section class="hero">
        <div>
            <div class="eyebrow">Personal academic index</div>
            <h1>Hi, I'm<br><?= student_escape($student['name']) ?>.</h1>
            <p>As an IT student, I am passionate about technology, problem-solving, and innovation. I strive to turn ideas into useful solutions while continuously learning, improving my skills, and preparing to make a meaningful impact through technology.</p>
        </div>
        <div class="note"><span>Current focus</span><?= student_escape($student['interests']) ?></div>
    </section>
    <section class="details" aria-label="Student summary">
        <div class="detail"><label>Student ID</label><p><?= student_escape($student['student_id']) ?></p></div>
        <div class="detail"><label>Course</label><p><?= student_escape($student['course']) ?></p></div>
        <div class="detail"><label>Year Level</label><p><?= student_escape($student['year']) ?></p></div>
        <div class="detail"><label>Section</label><p><?= student_escape($student['section']) ?></p></div>
        <div class="detail"><label>Email</label><p><?= student_escape($student['email']) ?></p></div>
        <div class="detail"><label>Based in</label><p><?= student_escape($student['location']) ?></p></div>
    </section>
</main>
</body>
</html>
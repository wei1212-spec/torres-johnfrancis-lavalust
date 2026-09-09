<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_edit = ($mode === 'edit');
$form_action = $is_edit ? base_url('products/edit/' . $product['id']) : base_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit Product' : 'Add Product'; ?> | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-alt: #0d1b2a;
            --panel: rgba(15, 23, 42, 0.82);
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
            display: grid;
            place-items: center;
            padding: 26px 18px;
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.22), transparent 28%),
                linear-gradient(135deg, var(--bg) 0%, #0b1220 100%);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        .card {
            width: min(100%, 620px);
            background: rgba(15, 23, 42, 0.76);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        h1 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            letter-spacing: -0.05em;
        }

        a.back {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .msg {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 0.9rem;
        }

        .msg.error { background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239,68,68,0.35); color: #fca5a5; }
        .msg.success { background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34,197,94,0.35); color: #bbf7d0; }

        form {
            display: grid;
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            color: var(--muted);
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 700;
        }

        input, textarea {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.25);
            background: rgba(15, 23, 42, 0.7);
            color: var(--text);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 0.96rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        textarea {
            min-height: 112px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: rgba(96, 165, 250, 0.9);
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.14);
        }

        .row {
            display: grid;
            grid-template-columns: repeat(2, minmax(180px, 1fr));
            gap: 16px;
        }

        button {
            margin-top: 8px;
            width: 100%;
            padding: 15px 18px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary-strong), var(--accent));
            color: white;
            font-weight: 700;
            font-size: 0.98rem;
            cursor: pointer;
            box-shadow: 0 18px 32px rgba(37, 99, 235, 0.32);
        }

        @media (max-width: 620px) {
            .card { padding: 20px; }
            .row { grid-template-columns: 1fr; }
            .topline { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="topline">
            <h1><?= $is_edit ? 'Edit Product' : 'Add Product'; ?></h1>
            <a class="back" href="<?= base_url('products'); ?>">&larr; Back to list</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="msg error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="msg success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="post" action="<?= $form_action; ?>">
            <div class="field">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>" autofocus>
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>
            </div>

            <div class="row">
                <div class="field">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required value="<?= htmlspecialchars($product['price'] ?? ''); ?>">
                </div>
                <div class="field">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" step="1" min="0" required value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>">
                </div>
            </div>

            <button type="submit"><?= $is_edit ? 'Save Changes' : 'Add Product'; ?></button>
        </form>
    </div>
</body>
</html>

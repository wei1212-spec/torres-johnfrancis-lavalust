<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function form_escape($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }
$product = $product ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= form_escape($heading) ?> | Product Desk</title>
    <style>
        :root { --ink: #172126; --muted: #657277; --paper: #f5f1e8; --panel: #fffdf8; --line: #d8d0c1; --coral: #e85d46; --teal: #176b68; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--paper); color: var(--ink); font-family: Arial, sans-serif; }
        .shell { width: min(760px, calc(100% - 2rem)); margin: auto; padding: 2rem 0 4rem; }
        header { display: flex; align-items: end; justify-content: space-between; padding-bottom: 1.5rem; border-bottom: 2px solid var(--ink); }
        .eyebrow { margin: 0 0 .5rem; color: var(--coral); font: 700 .72rem monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font: 400 clamp(2.5rem, 7vw, 5rem)/.9 Georgia, serif; }
        a { color: var(--teal); font-weight: 700; text-decoration: none; }
        form { margin-top: 2rem; padding: 2rem; background: var(--panel); border: 1px solid var(--line); box-shadow: 10px 10px 0 rgba(23, 33, 38, .08); }
        label { display: block; margin: 1rem 0 .4rem; font: 700 .72rem monospace; letter-spacing: .08em; text-transform: uppercase; }
        input, textarea { width: 100%; padding: .85rem; border: 1px solid var(--line); background: #fff; color: var(--ink); font: 1rem Arial, sans-serif; }
        textarea { min-height: 150px; resize: vertical; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .errors { padding: .75rem 1rem; border-left: 4px solid var(--coral); background: #fff0ea; color: #8b3427; line-height: 1.5; }
        .submit { margin-top: 1.5rem; padding: .9rem 1.2rem; border: 0; background: var(--teal); color: white; cursor: pointer; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        @media (max-width: 560px) { .shell { padding-top: 1.25rem; } header { align-items: start; flex-direction: column; gap: 1rem; } form { padding: 1.25rem; } .grid { grid-template-columns: 1fr; gap: 0; } }
    </style>
</head>
<body>
<main class="shell">
    <header><div><p class="eyebrow">LavaLust / Inventory</p><h1><?= form_escape($heading) ?></h1></div><a href="<?= form_escape(site_url('products')) ?>">Back to products</a></header>
    <form method="post" action="<?= form_escape($form_action) ?>">
        <?php if (!empty($errors)): ?><div class="errors"><ul><?php foreach ($errors as $error): ?><li><?= form_escape($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <label for="product_name">Product name</label>
        <input id="product_name" name="product_name" type="text" maxlength="100" value="<?= form_escape($product['product_name'] ?? '') ?>" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?= form_escape($product['description'] ?? '') ?></textarea>
        <div class="grid">
            <div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" value="<?= form_escape($product['price'] ?? '') ?>" required></div>
            <div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= form_escape($product['quantity'] ?? '') ?>" required></div>
        </div>
        <button class="submit" type="submit">Save product</button>
    </form>
</main>
</body>
</html>
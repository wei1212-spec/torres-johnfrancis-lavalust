<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function product_escape($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Product Desk</title>
    <style>
        :root { --ink: #172126; --muted: #657277; --paper: #f5f1e8; --panel: #fffdf8; --line: #d8d0c1; --coral: #e85d46; --teal: #176b68; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--paper); color: var(--ink); font-family: Arial, sans-serif; }
        .shell { max-width: 1120px; margin: auto; padding: 2rem 1.5rem 4rem; }
        header { display: flex; align-items: end; justify-content: space-between; gap: 1rem; padding-bottom: 1.5rem; border-bottom: 2px solid var(--ink); }
        .eyebrow { margin: 0 0 .5rem; color: var(--coral); font: 700 .72rem monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font: 400 clamp(2.8rem, 7vw, 5.5rem)/.9 Georgia, serif; }
        .actions { display: flex; align-items: center; gap: .75rem; }
        a, button { color: var(--teal); font-weight: 700; text-decoration: none; }
        .button { padding: .7rem .9rem; background: var(--teal); color: white; font-size: .8rem; text-transform: uppercase; letter-spacing: .08em; }
        .link-button { padding: 0; border: 0; background: none; cursor: pointer; font-size: .85rem; }
        .table-wrap { margin-top: 2rem; overflow-x: auto; background: var(--panel); border: 1px solid var(--line); box-shadow: 10px 10px 0 rgba(23, 33, 38, .08); }
        table { width: 100%; min-width: 760px; border-collapse: collapse; }
        th, td { padding: 1rem 1.1rem; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; }
        th { color: var(--muted); background: #eeeadf; font: 700 .7rem monospace; letter-spacing: .08em; text-transform: uppercase; }
        td { font-size: .95rem; }
        td:first-child { color: var(--coral); font-family: monospace; }
        tbody tr:last-child td { border-bottom: 0; }
        .description { max-width: 300px; color: var(--muted); line-height: 1.45; }
        .row-actions { white-space: nowrap; }
        .row-actions a { margin-right: 1rem; font-size: .82rem; }
        .empty { padding: 3rem; color: var(--muted); text-align: center; }
        @media (max-width: 620px) { .shell { padding: 1.25rem 1rem 3rem; } header { align-items: start; flex-direction: column; } .actions { width: 100%; justify-content: space-between; } }
    </style>
</head>
<body>
<main class="shell">
    <header>
        <div><p class="eyebrow">LavaLust / Inventory</p><h1>Products</h1></div>
        <div class="actions">
            <a class="button" href="<?= product_escape(site_url('products/create')) ?>">Add product</a>
            <form method="post" action="<?= product_escape(site_url('logout')) ?>"><button class="link-button" type="submit">Sign out</button></form>
        </div>
    </header>
    <div class="table-wrap">
        <?php if (empty($products)): ?>
            <div class="empty">No products yet. Add the first item to begin.</div>
        <?php else: ?>
            <table>
                <thead><tr><th>ID</th><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= product_escape($product['id']) ?></td>
                        <td><?= product_escape($product['product_name']) ?></td>
                        <td class="description"><?= product_escape($product['description']) ?></td>
                        <td><?= number_format((float) $product['price'], 2) ?></td>
                        <td><?= product_escape($product['quantity']) ?></td>
                        <td class="row-actions">
                            <a href="<?= product_escape(site_url('products/edit/' . $product['id'])) ?>">Edit</a>
                            <form method="post" action="<?= product_escape(site_url('products/delete/' . $product['id'])) ?>" style="display:inline" onsubmit="return confirm('Delete this product?');">
                                <button class="link-button" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
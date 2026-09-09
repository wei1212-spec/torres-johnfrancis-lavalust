<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
$total_products = is_array($products ?? null) ? count($products) : 0;
$total_inventory = 0;
if (!empty($products)) {
    foreach ($products as $product) {
        $total_inventory += (int) ($product['quantity'] ?? 0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Dashboard | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-alt: #0d1b2a;
            --panel: rgba(15, 23, 42, 0.82);
            --panel-strong: #111827;
            --surface: #f8fafc;
            --line: rgba(148, 163, 184, 0.2);
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
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.2), transparent 30%),
                linear-gradient(135deg, var(--bg) 0%, #0b1220 100%);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            padding: 32px 18px 56px;
        }

        .shell {
            max-width: 1200px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .title-wrap h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: -0.06em;
            margin-bottom: 8px;
        }

        .title-wrap p {
            color: var(--muted);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .user-pill {
            padding: 10px 14px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid var(--line);
            border-radius: 999px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .user-pill strong {
            color: var(--text);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            font-size: 0.72rem;
            font-weight: 700;
            border-radius: 999px;
            background: rgba(96, 165, 250, 0.12);
            color: #bfdbfe;
            border: 1px solid rgba(96, 165, 250, 0.3);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 12px;
            padding: 11px 16px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: linear-gradient(135deg, var(--primary-strong), var(--accent)); color: white; box-shadow: 0 18px 32px rgba(37, 99, 235, 0.25); }
        .btn-muted { background: rgba(148, 163, 184, 0.12); color: var(--text); border: 1px solid var(--line); }
        .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        .btn-sm { padding: 8px 12px; font-size: 0.8rem; border-radius: 10px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(180px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: rgba(15, 23, 42, 0.74);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 22px 20px;
            box-shadow: var(--shadow);
        }

        .label {
            color: var(--muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            letter-spacing: -0.06em;
        }

        .stat-trend {
            margin-top: 12px;
            color: #a7f3d0;
            font-size: 0.82rem;
        }

        .panel {
            background: rgba(15, 23, 42, 0.74);
            border: 1px solid var(--line);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--line);
            background: rgba(15, 23, 42, 0.4);
        }

        .panel-head h2 {
            font-size: 1.15rem;
            letter-spacing: -0.04em;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 780px;
        }

        th, td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
            font-size: 0.93rem;
            vertical-align: middle;
        }

        th {
            background: rgba(15, 23, 42, 0.8);
            color: #dfeafc;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        tbody tr:hover {
            background: rgba(96, 165, 250, 0.04);
        }

        td.desc {
            color: #cbd5e1;
            max-width: 260px;
        }

        td.numeric {
            text-align: right;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .row-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .empty {
            text-align: center;
            padding: 36px 18px;
            color: var(--muted);
        }

        .msg {
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 0.92rem;
        }

        .msg.success { background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34, 197, 94, 0.3); color: #bbf7d0; }
        .msg.error { background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; }

        form.inline { display: inline; }

        @media (max-width: 720px) {
            .stats-grid { grid-template-columns: 1fr; }
            .panel-head { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div class="title-wrap">
                <h1>Products</h1>
                <p>Track inventory and manage product details.</p>
            </div>

            <div class="actions">
                <span class="user-pill">Signed in as <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></strong></span>
                <?php if (!$is_admin): ?>
                    <span class="badge">View only</span>
                <?php endif; ?>
                <?php if ($is_admin): ?>
                    <a class="btn btn-primary" href="<?= base_url('products/create'); ?>">+ Add Product</a>
                <?php endif; ?>
                <a class="btn btn-muted" href="<?= base_url('logout'); ?>">Logout</a>
            </div>
        </div>

        <?php if (!empty($success)): ?>
            <div class="msg success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="msg error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="label">Total Products</span>
                <div class="stat-value"><?= htmlspecialchars($total_products); ?></div>
                <div class="stat-trend">Updated today</div>
            </div>
            <div class="stat-card">
                <span class="label">Inventory</span>
                <div class="stat-value"><?= htmlspecialchars($total_inventory); ?></div>
                <div class="stat-trend">Units in stock</div>
            </div>
            <div class="stat-card">
                <span class="label">Status</span>
                <div class="stat-value"><?= $is_admin ? 'Admin' : 'User'; ?></div>
                <div class="stat-trend">Access level</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>Product Inventory</h2>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created</th>
                            <?php if ($is_admin): ?><th>Actions</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($product['id']); ?></td>
                                    <td><?= htmlspecialchars($product['product_name']); ?></td>
                                    <td class="desc"><?= htmlspecialchars($product['description']); ?></td>
                                    <td class="numeric">₱<?= number_format((float) ($product['price'] ?? 0), 2); ?></td>
                                    <td class="numeric"><?= htmlspecialchars($product['quantity'] ?? 0); ?></td>
                                    <td><?= htmlspecialchars($product['created_at'] ?? ''); ?></td>
                                    <?php if ($is_admin): ?>
                                        <td>
                                            <div class="row-actions">
                                                <a class="btn btn-muted btn-sm" href="<?= base_url('products/edit/' . $product['id']); ?>">Edit</a>
                                                <form class="inline" method="post" action="<?= base_url('products/delete/' . $product['id']); ?>" onsubmit="return confirm('Delete this product?');">
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= $is_admin ? 7 : 6; ?>" class="empty">
                                    <?= $is_admin ? 'No products yet. Click “Add Product” to create one.' : 'No products yet.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

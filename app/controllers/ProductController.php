<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function index()
    {
        $this->call->model('ProductModel');
        $products = ProductModel::order_by('created_at', 'DESC');
        $this->call->view('products/index', ['products' => $products]);
    }

    public function create()
    {
        $this->call->view('products/form', [
            'product' => null,
            'errors' => [],
            'form_action' => site_url('products/create'),
            'heading' => 'Add product',
        ]);
    }

    public function store()
    {
        $data = $this->product_data();
        $errors = $this->validate_product($data);

        if (!empty($errors)) {
            $this->call->view('products/form', [
                'product' => $data,
                'errors' => $errors,
                'form_action' => site_url('products/create'),
                'heading' => 'Add product',
            ]);
            return;
        }

        $this->call->model('ProductModel');
        ProductModel::insert($data);
        redirect('products');
    }

    public function edit($id)
    {
        $this->call->model('ProductModel');
        $product = ProductModel::find((int) $id);

        if (!$product) {
            show_404();
            return;
        }

        $this->call->view('products/form', [
            'product' => $product,
            'errors' => [],
            'form_action' => site_url('products/edit/' . (int) $id),
            'heading' => 'Edit product',
        ]);
    }

    public function update($id)
    {
        $data = $this->product_data();
        $errors = $this->validate_product($data);
        $this->call->model('ProductModel');

        if (!ProductModel::find((int) $id)) {
            show_404();
            return;
        }

        if (!empty($errors)) {
            $data['id'] = (int) $id;
            $this->call->view('products/form', [
                'product' => $data,
                'errors' => $errors,
                'form_action' => site_url('products/edit/' . (int) $id),
                'heading' => 'Edit product',
            ]);
            return;
        }

        ProductModel::update((int) $id, $data);
        redirect('products');
    }

    public function delete($id)
    {
        $this->call->model('ProductModel');
        ProductModel::delete((int) $id);
        redirect('products');
    }

    private function product_data()
    {
        return [
            'product_name' => trim((string) $this->call->request->post('product_name')),
            'description' => trim((string) $this->call->request->post('description')),
            'price' => trim((string) $this->call->request->post('price')),
            'quantity' => trim((string) $this->call->request->post('quantity')),
        ];
    }

    private function validate_product($data)
    {
        $errors = [];
        if ($data['product_name'] === '') {
            $errors[] = 'Product name is required.';
        }
        if ($data['description'] === '') {
            $errors[] = 'Description is required.';
        }
        if ($data['price'] === '' || !is_numeric($data['price']) || (float) $data['price'] < 0) {
            $errors[] = 'Price must be a non-negative number.';
        }
        if ($data['quantity'] === '' || filter_var($data['quantity'], FILTER_VALIDATE_INT) === false || (int) $data['quantity'] < 0) {
            $errors[] = 'Quantity must be a non-negative whole number.';
        }

        return $errors;
    }
}
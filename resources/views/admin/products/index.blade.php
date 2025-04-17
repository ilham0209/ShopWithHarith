@extends('layouts.frontend')

@section('title', 'Manage Products')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Manage Products</h1>
        <button onclick="document.getElementById('addProductModal').style.display='block'" 
                style="background-color: var(--color-blue-1); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer;">
            Add New Product
        </button>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Products List -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #eee;">
                    <th style="padding: 1rem; text-align: left;">Image</th>
                    <th style="padding: 1rem; text-align: left;">Name</th>
                    <th style="padding: 1rem; text-align: right;">Price</th>
                    <th style="padding: 1rem; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 1rem;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td style="padding: 1rem;">{{ $product->name }}</td>
                    <td style="padding: 1rem; text-align: right;">RM{{ number_format($product->price, 2) }}</td>
                    <td style="padding: 1rem; text-align: center;">
                        <button onclick="editProduct({{ $product->id }})" 
                                style="background-color: #4a5568; color: white; padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer; margin-right: 0.5rem;">
                            Edit
                        </button>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')"
                                    style="background-color: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="background: white; width: 90%; max-width: 600px; margin: 50px auto; padding: 2rem; border-radius: 8px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                <h2>Add New Product</h2>
                <button onclick="document.getElementById('addProductModal').style.display='none'"
                        style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem;">Product Name</label>
                    <input type="text" id="name" name="name" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="price" style="display: block; margin-bottom: 0.5rem;">Price (RM)</label>
                    <input type="number" id="price" name="price" step="0.01" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="description" style="display: block; margin-bottom: 0.5rem;">Description</label>
                    <textarea id="description" name="description" required
                              style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; min-height: 100px;"></textarea>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="image" style="display: block; margin-bottom: 0.5rem;">Product Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" 
                        style="background-color: var(--color-blue-1); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; width: 100%;">
                    Add Product
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
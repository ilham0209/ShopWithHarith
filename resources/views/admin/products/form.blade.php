<div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name', $product->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" name="description" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price (RM)</label>
    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
           id="price" name="price" value="{{ old('price', $product->price ?? '') }}">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
           id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}">
    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Product Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" 
           id="image" name="image">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($product) && $product->image)
        <div class="mt-2">
            <img src="{{ Storage::url($product->image) }}" alt="Current image" class="img-thumbnail" width="200">
        </div>
    @endif
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
               value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>
</div>
@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-6">Products</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                                <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">RM{{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
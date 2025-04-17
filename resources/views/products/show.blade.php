@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
            
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-64 object-cover mb-4">
            @endif
            
            <div class="text-xl font-semibold text-gray-800 mb-2">
                RM{{ number_format($product->price, 2) }}
            </div>
            
            <p class="text-gray-600">
                {{ $product->description }}
            </p>
        </div>
    </div>
</div>
@endsection
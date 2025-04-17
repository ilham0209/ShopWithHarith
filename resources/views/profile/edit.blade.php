@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            Profile updated successfully.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $profile->address) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" style="margin-top: 20px;">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <label for="password">Confirm Password to Delete Account</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-danger">Delete Account</button>
    </form>
</div>
@endsection
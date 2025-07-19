@extends('layouts.auth')

@section('content')
<x-auth-card title="Reset Password" subtitle="Create a new password for your account">
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <x-auth-validation-errors />
        
        <x-auth-input name="email" type="email" label="Email Address" placeholder="your@email.com" required autofocus />
        <x-auth-input name="password" type="password" label="New Password" placeholder="••••••••" required />
        <x-auth-input name="password_confirmation" type="password" label="Confirm New Password" placeholder="••••••••" required />
        
        <x-auth-button>
            Reset Password
        </x-auth-button>
    </form>
</x-auth-card>
@endsection
@extends('layouts.auth')

@section('content')
<x-auth-card title="Welcome Back" subtitle="Please sign in to your account">
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        <x-auth-validation-errors />
        
        <x-auth-input name="email" type="email" label="Email Address" placeholder="your@email.com" required autofocus />
        <x-auth-input name="password" type="password" label="Password" placeholder="••••••••" required />
        
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
            </div>
            
            <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Forgot password?</a>
            </div>
        </div>
        
        <x-auth-button>
            Sign In
        </x-auth-button>
        
        <x-auth-socialite />
    </form>
    
    <x-slot name="footer">
        <p class="text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Sign up</a>
        </p>
    </x-slot>
</x-auth-card>
@endsection
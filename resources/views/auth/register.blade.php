@extends('layouts.auth')

@section('content')
<x-auth-card title="Create Account" subtitle="Join us today and get started">
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf
        
        <x-auth-validation-errors />
        
        
        <x-auth-input name="name" label="Full Name" placeholder="John Doe" required autofocus />
        
        
        <x-auth-input name="email" type="email" label="Email Address" placeholder="your@email.com" required />
        <x-auth-input name="password" type="password" label="Password" placeholder="••••••••" required />
        <x-auth-input name="password_confirmation" type="password" label="Confirm Password" placeholder="••••••••" required />
        
        <div class="flex items-center">
            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
            <label for="terms" class="ml-2 block text-sm text-gray-700">
                I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
            </label>
        </div>
        
        <x-auth-button>
            Create Account
        </x-auth-button>
        
        <x-auth-socialite />
    </form>
    
    <x-slot name="footer">
        <p class="text-center text-sm text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Sign in</a>
        </p>
    </x-slot>
</x-auth-card>
@endsection
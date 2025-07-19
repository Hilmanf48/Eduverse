@extends('layouts.auth')

@section('content')
<x-auth-card title="Reset Password" subtitle="Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.">
    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf
        
        <x-auth-validation-errors />
        
        @if (session('status'))
            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        
        <x-auth-input name="email" type="email" label="Email Address" placeholder="your@email.com" required autofocus />
        
        <x-auth-button>
            Email Password Reset Link
        </x-auth-button>
    </form>
    
    <x-slot name="footer">
        <p class="text-center text-sm text-gray-600">
            Remember your password? 
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Sign in</a>
        </p>
    </x-slot>
</x-auth-card>
@endsection
@extends('layouts.auth')

@section('content')
<x-auth-card title="Confirm Password" subtitle="This is a secure area of the application. Please confirm your password before continuing.">
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf
        
        <x-auth-validation-errors />
        
        <x-auth-input name="password" type="password" label="Password" placeholder="••••••••" required autofocus />
        
        <x-auth-button>
            Confirm Password
        </x-auth-button>
    </form>
</x-auth-card>
@endsection
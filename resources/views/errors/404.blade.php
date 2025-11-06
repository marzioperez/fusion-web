@extends('components.layouts.error')
@section('content')
    <div class="flex min-h-full flex-col bg-white pt-12 pb-12">
        <main class="mx-auto flex w-full max-w-7xl grow flex-col justify-center px-6 lg:px-8">
            <div class="py-6">
                <div class="text-center">
                    <div class="flex items-center justify-center font-bold font-castoro text-primary md:text-9xl text-4xl">
                        404
                    </div>
                    <h4 class="mt-2 text-secondary">Page not found</h4>
                    <p class="mt-2">The page may have been deleted or the address may not exist.</p>
                    <div class="flex justify-center mt-6">
                        <a href="{{config('app.url')}}" class="btn btn-lg btn-primary">Go to home</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@extends('layouts.frontend')
@section('content')
        <!-- START: BREADCRUMB -->
        <section class="bg-gray-100 py-8 px-4">
            <div class="container mx-auto">
            <ul class="breadcrumb">
                <li>
                <a href="index.html">Home</a>
                </li>
                <li>
                <a href="#" aria-label="current-page">Success Checkout</a>
                </li>
            </ul>
            </div>
        </section>
        <!-- END: BREADCRUMB -->
    
        <!-- START: CONGRATS -->
        <section class="">
            <div class="container mx-auto min-h-screen">
            <div class="flex flex-col items-center justify-center">
                <div class="w-full md:w-4/12 text-center">
                    <img
                        src="/frontend/images/content/illustration-success.png"
                        alt="congrats illustration"
                    />
                    <h2 class="text-3xl font-semibold mb-6">Ah yes it’s success!</h2>
                    <p class="text-lg mb-12">
                        Item yang anda beli akan kami proses hari ini juga, mohon bersabar menunggu ya!!
                    </p>
                    <a href="https://wa.me/6282374338273?text=selamat pagi" class="text-gray-900 bg-green-200 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-5 cursor-pointer">Chat admin</a>
                </div>
                    <br class=""/>
                <div class="my-5 w-full md:w-4/12 text-center">
                    <a
                    href="{{ route('index') }}"
                    class="text-gray-900 bg-red-200 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-5 cursor-pointer"
                    >
                    Back to Shop
                     </a>
                </div>
            </div>
            </div>
        </section>
        <!-- END: CONGRATS -->
@endsection
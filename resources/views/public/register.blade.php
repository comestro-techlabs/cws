@extends('public.layout')


@section('title')
    Sign up
@endsection
@section('content')
    <div
        class="font-[sans-serif] md:max-w-5xl md:mt-8 mt-4 bg-white  flex w-full h-screen items-center mx-auto md:h-screen p-4">
        <div class=" grid w-full md:grid-cols-3 grid-cols-1 items-center shadow-xl border rounded-xl  overflow-hidden">
            <div
                class="max-md:order-1 hidden md:block flex-col justify-center space-y-16 max-md:6 min-h-full bg-gradient-to-r from-gray-800 to-gray-600 lg:px-8 px-4 py-4">
                <div class="mt-24">
                    <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
                    <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">
                        Register now and access:
                    </p>
                    <ul class="text-[13px] text-gray-300 mt-2 leading-relaxed list-disc pl-5">
                        <li>Assignments & Exams</li>
                        <li>Payment Management</li>
                        <li>Certificates</li>
                        <li>All Programming Courses</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold">Why Choose Us?</h4>
                    <ul class="text-[13px] text-gray-300 mt-2 leading-relaxed list-disc pl-5">
                        <li>Affordable ₹700/month</li>
                        <li>Quality Training</li>
                        <li>Learn Any Programming Language</li>
                        <li>Career-Oriented Courses</li>
                    </ul>
                </div>
            </div>


            <div class="md:col-span-2 w-full py-6 px-6 sm:px-16">
                <div class="my-3">
                    <h3 class="text-gray-800 text-2xl font-bold">Create an account</h3>
                </div>

                <livewire:auth.register />

            </div>
        </div>
    </div>
   
@endsection

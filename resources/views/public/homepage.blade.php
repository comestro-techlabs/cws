@extends('public.layout')


@section('content')
    <x-hero />


    <!-- Heading Section -->
    <div class="bg-blue-100 py-12 px-4 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
            Elevate Your Skills with Our Courses
        </h2>
        <p class="text-lg font-medium text-gray-700">
            Unleash your potential and take the first step towards a successful career. Our expert-led courses are designed
            to equip you with the skills you need to excel.
        </p>
        <p class="text-sm font-light text-gray-600 mt-4">
            Join a community of learners and transform your passion into proficiency. Your journey starts here!
        </p>
    </div>

    <div class="grid md:grid-cols-4 px-3 md:px-10 gap-5 grid-cols-1 py-5 bg-white flex-1">
        @foreach ($courses as $course)
            <x-course-card :course="$course" />
        @endforeach
    </div>

    <div class="flex flex-1 w-full">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center my-8 flex-1">
            Students' Reviews on <span class="text-blue-600">Google Business</span>
        </h2>
    </div>

    <div class="grid flex-1 grid-cols-3 gap-3">
        <x-review-card img="https://lh3.googleusercontent.com/a-/ALV-UjWWABThjAM4ufxXV8z7hgfDkQd28z74Gq3kmZZuuPPdugJmveCv=s45-c-rp-mo-br100" fullname="Md Faiyyaj Alam (Faizi)" review="Being your student was a fantastic experience. Your dedication to teaching, clear explanations, and supportive approach made learning programming enjoyable and accessible. Thank you for being an excellent mentor!"
 star="5.0"/>
        <x-review-card img="https://lh3.googleusercontent.com/a-/ALV-UjWhnN83U4cyemlTe_6wpKeghb8-_ViwewXh264-0SiQHiTOaQFR0g=s45-c-rp-mo-br100" fullname="Jay Bharti" review="Best coaching and best instructor of my life. I have got best experience from this coaching by Sadique sir for learning , motivation and more things from him and always support me to keep growing and growing. Thanks for your support and instructing me like this. I never forget this forever.This is important part of my life.A lot of memories are attached with this coaching.
"
 star="5.0"/>
        <x-review-card img="https://lh3.googleusercontent.com/a/ACg8ocLbsLNIpUeRJQjVX1_ebOgQS8mpUYFZtyWth080et-FABAzKA=s45-c-rp-mo-br100" fullname="Neeraj Kumar" review="Really talented teacher praises students and work hard along with them, motivating to be next level Software Engineer/Developer. Purnia has never such practical teacher on field of computer education, we need more teachers like Sadique Sir 💥"
 star="5.0"/>
    </div>
    
@endsection

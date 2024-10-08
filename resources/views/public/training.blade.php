@extends('public.layout')

@section('title')
    Programming Training 
@endsection

@section('meta')
    <meta name="description" content="Comestro offers comprehensive training in Full-Stack Web Development, C Programming, Laravel, SQL Database Management, and JavaScript & React. Our hands-on courses are designed to equip you with practical skills for real-world software and web development projects."/>
@endsection

@section('content')
    <div class="bg-white overflow-x-hidden">

        <livewire:page-heading title="Comestro TechLabs Training"
            description="Comestro offers comprehensive training in Full-Stack Web Development, C Programming, Laravel, SQL Database Management, and JavaScript & React. Our hands-on courses are designed to equip you with practical skills for real-world software and web development projects." image="about-header.png" />

        <div class="md:px-10">
            <!-- Header Section -->


            <div class="grid md:grid-cols-4 px-2 md:px-10 gap-2 grid-cols-2 md:py-5 mt-9 bg-white flex-1">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>


            <div class="flex flex-1 w-full">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center my-8 flex-1">
                    Students' Reviews on <span class="text-blue-600">Google Business</span>
                </h2>
            </div>`

            <div class="grid flex-1 grid-cols-1 md:grid-cols-3 gap-3">
                <x-review-card
                    img="https://lh3.googleusercontent.com/a-/ALV-UjWWABThjAM4ufxXV8z7hgfDkQd28z74Gq3kmZZuuPPdugJmveCv=s45-c-rp-mo-br100"
                    fullname="Md Faiyyaj Alam (Faizi)"
                    review="Being your student was a fantastic experience. Your dedication to teaching, clear explanations, and supportive approach made learning programming enjoyable and accessible. Thank you for being an excellent mentor!"
                    star="5.0" />
                <x-review-card
                    img="https://lh3.googleusercontent.com/a-/ALV-UjWhnN83U4cyemlTe_6wpKeghb8-_ViwewXh264-0SiQHiTOaQFR0g=s45-c-rp-mo-br100"
                    fullname="Jay Bharti"
                    review="Best coaching and best instructor of my life. I have got best experience from this coaching by Sadique sir for learning , motivation and more things from him and always support me to keep growing and growing. Thanks for your support and instructing me like this. I never forget this forever.This is important part of my life.A lot of memories are attached with this coaching.
        "
                    star="5.0" />
                <x-review-card
                    img="https://lh3.googleusercontent.com/a/ACg8ocLbsLNIpUeRJQjVX1_ebOgQS8mpUYFZtyWth080et-FABAzKA=s45-c-rp-mo-br100"
                    fullname="Neeraj Kumar"
                    review="Really talented teacher praises students and work hard along with them, motivating to be next level Software Engineer/Developer. Purnia has never such practical teacher on field of computer education, we need more teachers like Sadique Sir 💥"
                    star="5.0" />
            </div>
        </div>
    </div>
@endsection

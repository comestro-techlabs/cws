<div>
<div class="bg-white overflow-x-hidden">
        <livewire:page-heading title="Our Courses"
            description="Learn Syntax offers comprehensive training in Full-Stack Web Development, C Programming, Laravel, SQL Database Management, and JavaScript & React. Our hands-on courses are designed to equip you with practical skills for real-world software and web development projects." image="about-header.png" />

        <div class="md:px-10">
            <!-- Header Section -->


            <div class="grid md:grid-cols-4 px-2 md:px-10 gap-2 grid-cols-2 ml-28 md:py-5 mt-9 bg-white flex-1">
                @foreach ($published_courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>


            
        </div>
    </div></div>

@extends('public.layout')

@section('title')
    About us
@endsection

@section('meta')
    <meta name="description"
        content="Discover Learn Syntax, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies." />
@endsection

@section('content')

    <div class="bg-white pB-12 overflow-x-hidden">
        <livewire:page-heading title="About Learn Syntax"
            description="Our Learn Syntax platform is one of the top learning platforms in India. We provide 360º learning solutions to empower individuals and businesses across the globe with in-demand tech skills."
            image="about-header.png" />
        <div class=" mt-20 mb-20 py-10 px-5 md:px-20">
            <div class=" mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-10">
                <!-- Badge Section -->
                <div class="flex justify-center">
                    <img src="https://img.freepik.com/free-photo/business-people-using-computers-dark-office_74855-2617.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_hybrid" class="w-96" />
                </div>

                <!-- Text Content Section -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        Empower Your <span class="text-secondary">Future</span> with Learn Syntax
                    </h2>
                    <p class="mt-4 text-gray-600">
                      Learn Syntax is a premier learning platform dedicated to empowering aspiring coders and tech enthusiasts.
                      With a focus on mastering syntax, frameworks, and real-world applications, we provide the tools and
                      resources needed to build a successful career in technology. Backed by 20+ years of expertise, Learn Syntax
                      is where passion for coding meets innovative education.
                  </p>
                    <button
                        class="mt-6 px-6 py-3 bg-secondary text-white font-medium rounded-lg  hover:shadow-xl">
                        Get Started Today!
                    </button>
                </div>

            </div>
        </div>


        <div class="bg-blue-900 text-white py-12 px-6">
            <div class="max-w-5xl mx-auto">
              <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">Our Journey</h2>
              <p class="text-center text-gray-300 mb-12">
                A story of growth, innovation, and commitment to empowering aspiring developers and IT professionals.
              </p>
              <div class="relative">

                <!-- 2014 -->
                <div class="flex items-start border-b-2 border-gray-500 mb-12">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2014</h3>
                  </div>
                  <div class="relative mb-6 pl-8">
                    <h4 class="text-xl font-bold">The Beginning</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Started "Code with Sadiq" with just 2 students in a personal room.</li>
                      <li>Used a 14-inch monitor to teach coding basics and fundamentals.</li>
                    </ul>
                  </div>
                </div>

                <!-- 2016 -->
                <div class="flex items-start border-b-2 border-gray-500 mb-12">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2016</h3>
                  </div>
                  <div class="relative mb-6 pl-8">
                    <h4 class="text-xl font-bold">Growth and Expansion</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Officially adopted the name "Code with Sadiq."</li>
                      <li>Opened a new branch in Madhubani, Purnea, Bihar.</li>
                      <li>Started training BCA, B.Tech, and M.Tech students.</li>
                    </ul>
                  </div>
                </div>

                <!-- 2020 -->
                <div class="flex items-start border-b-2 border-gray-500 mb-12">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2020</h3>
                  </div>
                  <div class="relative mb-6 pl-8">
                    <h4 class="text-xl font-bold">Milestone Achievement</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Reached a remarkable milestone of training 10,000 students.</li>
                      <li>Empowered students with skills to excel in the IT industry.</li>
                    </ul>
                  </div>
                </div>

                <!-- 2022 -->
                <div class="flex items-start border-b-2 border-gray-500 mb-12">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2022</h3>
                  </div>
                  <div class="relative mb-6 pl-8">
                    <h4 class="text-xl font-bold">Student Placements</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Achieved 800 student placements in renowned IT companies.</li>
                      <li>Placed students both in India and abroad, ensuring career success.</li>
                    </ul>
                  </div>
                </div>

                <!-- 2024 -->
                <div class="flex items-start border-b-2 border-gray-500 mb-12">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2024</h3>
                  </div>
                  <div class="relative mb-6 pl-8">
                    <h4 class="text-xl font-bold">New Horizons</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Registered "Comestro Techlabs Pvt. Ltd." as an IT service company.</li>
                      <li>Expanded focus to include IT services alongside training.</li>
                    </ul>
                  </div>
                </div>

                <!-- 2025 -->
                <div class="flex items-start">
                  <div class="w-16 text-right pr-4">
                    <h3 class="text-lg font-bold">2025</h3>
                  </div>
                  <div class="relative pl-8">
                    <h4 class="text-xl font-bold">Rebranding for the Future</h4>
                    <ul class="mt-2 text-gray-300 list-disc ml-5">
                      <li>Rebranded "Code with Sadiq" to "Learn Syntax."</li>
                      <li>Introduced a modernized learning platform to empower developers.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class=" mt-20 mb-20 py-12 px-6">
            <div class="max-w-5xl mx-auto">
              <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-8">
                Frequently <span class="text-secondary">Asked</span> Questions
              </h2>
              <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-300 rounded-lg shadow">
                  <button
                    class="w-full flex justify-between items-center p-4 bg-white text-left hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-500"
                    onclick="toggleFaq('faq1')"
                  >
                    <span class="text-lg font-medium text-gray-800">What services does Learn Syntax provide?</span>
                    <svg
                      id="faq1-icon"
                      class="w-6 h-6 transform transition-transform text-gray-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <div id="faq1-content" class="hidden p-4 bg-gray-50 text-gray-700">
                    Learn Syntax provides comprehensive training in programming languages, frameworks, and coding best practices to help students and professionals excel in their careers.
                  </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-300 rounded-lg shadow">
                  <button
                    class="w-full flex justify-between items-center p-4 bg-white text-left hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-500"
                    onclick="toggleFaq('faq2')"
                  >
                    <span class="text-lg font-medium text-gray-800">How can I enroll in a course?</span>
                    <svg
                      id="faq2-icon"
                      class="w-6 h-6 transform transition-transform text-gray-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <div id="faq2-content" class="hidden p-4 bg-gray-50 text-gray-700">
                    You can enroll in our courses by visiting the Learn Syntax website, selecting a course, and following the instructions for registration.
                  </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-300 rounded-lg shadow">
                  <button
                    class="w-full flex justify-between items-center p-4 bg-white text-left hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-500"
                    onclick="toggleFaq('faq3')"
                  >
                    <span class="text-lg font-medium text-gray-800">Do you offer placement assistance?</span>
                    <svg
                      id="faq3-icon"
                      class="w-6 h-6 transform transition-transform text-gray-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <div id="faq3-content" class="hidden p-4 bg-gray-50 text-gray-700">
                    Yes, Learn Syntax offers dedicated placement assistance to ensure our students secure jobs in top companies.
                  </div>
                </div>
              </div>
            </div>
          </div>



    </div>


    <script>
        // Function to toggle FAQ content visibility
        function toggleFaq(id) {
          const content = document.getElementById(`${id}-content`);
          const icon = document.getElementById(`${id}-icon`);

          if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
          } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
          }
        }
      </script>

@endsection

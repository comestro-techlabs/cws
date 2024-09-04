<div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
    <div
        class="bg-white w-full border p-6 hover:bg-sky-600 hover:text-white rounded-lg shadow-lg h-full flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold flex items-center">
                <i class="{{ $iconClass }} mr-2"></i> <!-- Dynamic Icon -->
                {{ $title }}
            </h3>
            <p class="mt-2 text-sm">
                {{ $description }}
            </p>
        </div>
        <a href="#" class="mt-4 inline-block text-sm font-medium transition duration-300">
            <i class="fas fa-arrow-right mr-1"></i> <!-- Static Icon for link -->
            Read More
        </a>
    </div>
</div>

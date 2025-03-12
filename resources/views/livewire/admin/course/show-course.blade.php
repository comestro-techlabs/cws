<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-6">
            <div class="relative h-48 bg-purple-600">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $course->title }}</h1>
                    <p class="text-purple-200">{{ $course->course_code }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl rounded-xl">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 border-l-4 border-purple-600 pl-4">
                        Course Details
                    </h1>
                    <a href="{{ route('admin.course.manage') }}"
                       class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Courses
                    </a>
                </div>
            </div>

            <!-- Course Basic Info -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach([
                        ['Title', $course->title, 'fa-heading'],
                        ['Course Code', $course->course_code, 'fa-hashtag'],
                        ['Instructor', $course->instructor, 'fa-chalkboard-teacher'],
                        ['Duration', $course->duration . ' Weeks', 'fa-clock'],
                        ['Fees', '₹' . $course->fees, 'fa-money-bill'],
                        ['Discounted Fees', '₹' . $course->discounted_fees, 'fa-tags']
                    ] as [$label, $value, $icon])
                    <div class="bg-white rounded-xl p-5 shadow-sm hover:shadow-md transform hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas {{ $icon }} text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400">{{ $label }}</h3>
                                <p class="text-lg font-semibold text-gray-800">{{ $value }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Course Image -->
            @if($course->course_image)
            <div class="p-6 border-t border-gray-200 bg-gradient-to-r from-purple-50 to-white">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-image text-purple-500 mr-2"></i>
                    Course Image
                </h2>
                <div class="relative group">
                    <img src="{{ asset('storage/' . $course->course_image) }}"
                         alt="{{ $course->title }}"
                         class="w-72 h-72 object-cover rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-purple-600 opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </div>
            </div>
            @endif

            <!-- Description -->
            <div class="p-6 border-t border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                    Description
                </h2>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                </div>
            </div>

            <!-- Batches -->
            <div class="p-6 border-t border-gray-200 bg-gradient-to-r from-purple-50 to-white">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-users text-purple-500 mr-2"></i>
                    Batches
                </h2>
                @if($batches->count() > 0)
                <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach(['Batch Name', 'Start Date', 'End Date', 'Total Seats', 'Available Seats'] as $header)
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $header }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($batches as $batch)
                            <tr class="hover:bg-purple-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $batch->batch_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->start_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->end_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->total_seats }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 py-1 rounded-full {{ $batch->available_seats > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $batch->available_seats }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-500 italic">No batches available for this course.</p>
                @endif
            </div>


        </div>
    </div>
</div>

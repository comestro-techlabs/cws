<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-8 flex flex-col justify-between">
    <div class="px-6 py-4">
        <div class="flex items-center">
            <img class="w-12 h-12 rounded-full mr-4" src="{{$img}}" alt="Student Photo">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">{{$fullname}}</h3>
                <p class="text-gray-600 text-sm">Student at Comestro</p>
            </div>
        </div>
        <p class="mt-4 text-gray-700 text-base">
            {{$review}}
        </p>
    </div>
    <div class="px-6 py-4 bg-gray-100 ">
        <span class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold mr-2 px-2.5 py-1 rounded">
            {{$star}} ★
        </span>
        <span class="text-gray-600 text-sm">Reviewed on Google</span>
    </div>
</div>
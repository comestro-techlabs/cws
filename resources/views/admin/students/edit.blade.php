@extends('admin.base')

@section('title', 'View Student Details | ')

@php
$fields = ['name', 'email', 'contact', 'gender', 'education_qualification', 'dob', 'profile_picture'];
$countCompletedFields = 0;
foreach ($fields as $field) {
if ($student->$field) {
$countCompletedFields++;
}
}
$totalFields = count($fields);
@endphp

@section('content')
@if (session('success'))
<div class="mb-4 p-4 mt-5 bg-green-100 text-green-800 rounded-md">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="mb-4 p-4 mt-5 bg-red-100 text-red-800 rounded-md">
    {{ session('error') }}
</div>
@endif

<div class="flex flex-1 w-full px-[2%] py-0 flex-col">
    <div class="flex flex-1 gap-3 my-5 flex-row justify-between items-center">
        <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
            <h2 class="md:text-xl text-lg font-normal  text-slate-500"> Student</h2>
            {{-- <p class="text-sm text-slate-400 font-normal">Please fill {{ $countCompletedFields }} of {{ $totalFields }}
            fields</p> --}}
        </div>
    </div>

    <div class="flex flex-1 flex-col md:items-start gap-5">
        <div class="grid grid-cols-2 gap-5 w-full">
            @foreach ($fields as $field)
            <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                <div class="flex flex-1 flex-col gap-2">
                    <div class="flex flex-1 justify-between">
                        <strong
                            class="text-lg font-normal text-slate-600">{{ ucfirst(str_replace('_', ' ', $field)) }}</strong>
                        {{-- <button onclick="toggleEdit('{{ $field }}')"
                        class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Edit</button> --}}
                    </div>

                    <span id="{{ $field }}-value">
                        @if ($student->$field)
                        {!! $field == 'profile_picture'
                        ? "<img src='" .
                                            ($student->$field
                                                ? asset(' storage/student_images/' . $student->$field)
                        : 'https://placehold.co/600x400?text=Upload+Image') .
                        "' alt='Profile Picture' class='w-full h-auto object-cover border'>"
                        : e($student->$field) !!}
                        @else
                        <span class="italic">{{ ucfirst(str_replace('_', ' ', $field)) }} is empty</span>
                        @endif
                    </span>

                    <form id="{{ $field }}-form"
                        action="{{ route('student.update', ['student' => $student->id, 'field' => $field]) }}"
                        method="POST" enctype="multipart/form-data" style="display: none;"
                        class="flex flex-col w-full">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3 flex flex-1 flex-col gap-1">
                            @if ($field == 'profile_picture')
                            <input type="file" name="{{ $field }}" id="{{ $field }}"
                                onchange="previewImage(event)">
                            <div class="mt-2">
                                <img id="{{ $field }}-preview"
                                    src="{{ $student->$field ? asset('storage/student_images/' . $student->$field) : 'https://placehold.co/600x400?text=Upload+Image' }}"
                                    alt="Profile Picture Preview" class="w-56 h-32 object-cover border">
                            </div>
                            @elseif ($field == 'dob')
                            <input class="border w-full px-3 py-2" type="date" name="{{ $field }}"
                                value="{{ $student->$field }}">
                            @elseif ($field == 'gender')
                            <select class="border w-full px-3 py-2" name="{{ $field }}">
                                <option value="male" {{ $student->$field == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ $student->$field == 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="other" {{ $student->$field == 'other' ? 'selected' : '' }}>
                                    Other</option>
                            </select>
                            @else
                            <input class="border w-full px-3 py-2"
                                type="{{ $field == 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                                value="{{ $student->$field }}">
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-black text-white px-3 py-2 rounded">Save</button>
                            <button type="button" onclick="toggleEdit('{{ $field }}')"
                                class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <!-- payment table started -->
        <div class="w-full">
            <h2 class="border-s-4 border-s-orange-400 pl-3 text-teal-500 font-semibold text-xl py-2 mb-2">Payment Details</h2>

            <div class="page ">
                <!-- Page Heading -->
                <div class="container mx-auto px-4 py-4">
                    <!-- Invoices Table -->

                    <div class="mx-2">
                        <ul class="flex  -mb-px text-xs font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Course / Workshop</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Membership</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="enrolled-styled-tab" data-tabs-target="#styled-enrolled" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Enrolled Courses</button>
                            </li>
                        </ul>
                    </div>
                    <div id="default-styled-tab-content">

                        <div class="p-4 overflow-x-auto" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="min-w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-2 text-centert text-xs font-medium text-gray-600 ">Course / Workshop Name</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Order Id</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Status</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Method</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Amount</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Date</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Month</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Year</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Error Reason</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @php
                                    $isPayable = true;
                                    @endphp
                                @foreach ($paymentsWithWorkshops as $item)
                                    @if($item->course_id || $item->workshop_id)
                                    <tr>
                                        <td class="p-2 text-center  text-xs">
                                            @if(!empty($item->workshop_title))
                                            {{ $item->workshop_title }}
                                            @elseif(!empty($item->course->title))
                                            {{ $item->course->title }}
                                            @else
                                            {{ 'Membership Fee' }}
                                            @endif
                                        </td>

                                        <td class="p-2 text-center  text-xs text-gray-800">
                                            {{ $item->order_id }}
                                        </td>
                                        <td class="p-2 text-center  text-xs text-gray-800">
                                            @if($item->status === "captured")
                                            <div class="flex items-center justify-center rounded-full bg-green-500 px-2 py-1 text-xs text-center mr-3">
                                                {{$item->status}}
                                            </div>
                                            @elseif($item->status === "failed")
                                            <div class="flex items-center justify-center rounded-full bg-red-500 px-2 py-1 text-xs text-center mr-3">
                                                {{$item->status}}
                                            </div>
                                            @else
                                            <div class="flex items-center justify-center rounded-full bg-yellow-500 px-2 py-1 text-xs text-center mr-3">
                                                {{$item->status}}
                                            </div>
                                            @endif
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            {{ $item->method ?? 'N/A'}}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            ₹{{ $item->transaction_fee }}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            {{ \Carbon\Carbon::create()->month((int)$item->month)->format('M') }}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            {{ $item->year}}
                                        </td>
                                        <td class="p-2 text-gray-800 text-left truncate max-w-xs  text-xs" title="{{ $item->error_reason }}">
                                            {{ $item->error_reason }}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center  text-xs">
                                            @if($item->status === 'captured')
                                            <a href="{{ route('student.viewbilling', $item->id) }}" class="py-2.5 px-6 text-xs font-semibold text-indigo-500 transition-all duration-500 hover:text-indigo-700">Print Invoice</a>
                                            @elseif($item->status === 'failed')
                                            <span class="text-red-500 font-semibold">Failed</span>
                                            
                                        </td>
                                    </tr>
                                             @endif
                                    @endif
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                        <div class="p-4 overflow-x-auto" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <table class="min-w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Due Date</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 "> Month</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Order Id</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Status</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Method</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Amount</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Payment Date</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Action</th>
                                    </tr>
                                </thead>
                                @if(Auth::user()->is_member)
                                <tbody class="divide-y divide-gray-200 text-xs">
                                    @foreach ($paymentsWithWorkshops as $item)
                                    @if(empty($item->course_id) && empty($item->workshop_id))
                                    <tr>
                                        <td class="px-2 py-1 text-gray-800 text-center">
                                            {{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}
                                        </td>
                                        <td class="px-2 py-1 text-gray-800 text-center">
                                            {{ \Carbon\Carbon::create((int)$item->year, (int)$item->month, 1)->format('M Y') }}
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-800">
                                            {{ $item->order_id }}
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-800">
                                            @if($item->status === "captured")
                                            <div class="flex items-center justify-center rounded-full bg-green-500 px-2 py-1 text-center text-xs mr-3">
                                                {{$item->status}}
                                            </div>
                                            @elseif($item->status === "failed" || $item->status==='overdue' )
                                            <div class="flex items-center justify-center rounded-full bg-red-500 px-2 py-1 text-xs text-center mr-3">
                                                {{$item->status}}
                                            </div>
                                            @else
                                            <div class="flex items-center justify-center rounded-full bg-yellow-500 px-2 py-1 text-center text-xs mr-3">
                                                {{$item->status}}
                                            </div>
                                            @endif
                                        </td>
                                        <td class="p-2 text-gray-800 text-center flex justify-center">
                                            @if ($item->method == "upi")
                                            <svg title="{{$item->method}}" width="40px" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 333334 199007' shape-rendering='geometricPrecision' text-rendering='geometricPrecision' image-rendering='optimizeQuality' fill-rule='evenodd' clip-rule='evenodd'>
                                                <path d='M44732 130924h1856l-1738 7215c-265 1061-206 1885 147 2415 354 530 1001 795 1973 795 942 0 1737-265 2356-795 618-531 1031-1355 1296-2415l1737-7215h1885l-1767 7392c-383 1590-1060 2798-2061 3593-972 795-2268 1208-3858 1208s-2680-383-3269-1179c-589-795-707-2002-324-3592l1767-7421zm223507 11868l2826-11868h6449l-383 1649h-4564l-706 2974h4564l-413 1679h-4564l-913 3827h4565l-412 1738h-6449zm-177-8982c-413-470-913-824-1443-1031-531-235-1119-353-1797-353-1266 0-2385 412-3386 1237s-1649 1915-1973 3239c-295 1267-177 2327 413 3181 559 824 1442 1237 2620 1237 677 0 1355-118 2031-383 678-235 1356-619 2062-1119l-530 2179c-589 382-1207 648-1856 825-648 176-1296 265-2002 265-883 0-1679-148-2356-443-678-294-1236-736-1679-1324-441-560-706-1237-824-2002-117-766-88-1590 148-2474 206-883 559-1680 1031-2445 471-766 1089-1443 1796-2002 706-589 1472-1030 2297-1325 824-294 1648-441 2503-441 677 0 1295 88 1885 294 559 207 1089 500 1560 913l-500 1972zm-18317 4300h3209l-530-2710c-29-176-59-383-59-589-30-235-30-471-30-736-118 265-235 500-383 736-118 235-235 442-353 619l-1855 2680zm4093 4682l-589-3062h-4594l-2062 3062h-1972l8539-12338 2650 12338h-1972zm-15548 0l2827-11868h6449l-383 1649h-4565l-706 2945h4563l-412 1679h-4564l-1325 5565h-1885v30zm-5566-6832h353c1001 0 1679-118 2062-354 382-236 648-648 795-1267 146-648 88-1119-207-1384-293-265-913-413-1855-413h-354l-795 3417zm-471 1502l-1267 5300h-1767l2828-11867h2621c766 0 1354 59 1737 148 411 89 736 265 971 500 295 295 471 648 559 1119 89 443 59 943-59 1502-235 943-619 1709-1207 2238-589 530-1326 854-2209 972l2680 5387h-2121l-2562-5300h-206zm-11632 5330l2828-11868h6478l-382 1649h-4565l-706 2974h4564l-411 1679h-4565l-912 3827h4564l-413 1738h-6479zm-2031-10248l-2444 10218h-1884l2444-10218h-3063l383-1649h8010l-382 1649h-3063zm-19170 10248l2945-12338 5595 7244c148 206 294 413 441 648s295 501 471 794l1974-8216h1737l-2945 12310-5713-7392c-147-206-295-412-441-619-147-235-265-442-354-707l-1972 8245h-1737v30zm-4594 0l2827-11868h1884l-2827 11868h-1884zm-13870-2385l1678-707c29 530 176 942 501 1207 324 265 765 413 1354 413 559 0 1031-148 1443-471 412-324 678-736 795-1266 177-707-235-1326-1236-1855-147-89-235-148-325-177-1119-648-1825-1207-2120-1737-294-530-354-1149-176-1884 235-972 736-1738 1530-2356 796-589 1679-913 2740-913 854 0 1530 177 2031 500 501 325 766 825 854 1444l-1648 766c-148-383-325-648-560-825-235-176-530-265-884-265-501 0-942 147-1295 412-354 265-589 619-707 1090-176 707 325 1383 1472 2002 89 59 147 89 207 117 1001 530 1678 1061 1972 1591 295 529 354 1148 178 1943-266 1119-825 2002-1680 2680-853 647-1855 1002-3033 1002-971 0-1737-237-2267-708-589-471-854-1149-824-2002zm-1973-7863l-2444 10218h-1884l2444-10218h-3062l381-1649h8010l-383 1649h-3062zm-19170 10248l2944-12338 5596 7244c147 206 295 413 442 648 146 235 294 501 471 794l1973-8216h1737l-2944 12310-5713-7392c-148-206-294-412-442-619-147-235-265-442-353-707l-1973 8245h-1737v30zm-8599 0l2827-11868h6449l-383 1649h-4564l-707 2974h4564l-412 1679h-4564l-913 3827h4565l-413 1738h-6449zm-3121-5860c0-88 29-354 88-766 30-353 59-618 89-854-118 266-236 530-383 824-147 266-324 560-530 825l-4535 6331-1472-6448c-59-265-118-530-148-766-29-235-59-500-59-736-59 236-147 500-235 794-89 266-206 560-354 855l-2650 5831h-1737l5683-12368 1620 7479c29 118 59 324 89 589 29 266 88 619 147 1031 206-353 471-765 825-1296 88-146 176-235 206-324l5124-7479-177 12368h-1737l148-5890zm-17933 5860l1296-5418-2356-6420h1972l1472 4035c30 117 59 235 118 411 59 178 89 354 147 530 118-176 236-353 354-530 118-176 236-324 353-471l3446-3975h1884l-5506 6390-1296 5417h-1885v30zm-8746-4682h3209l-530-2710c-30-176-59-383-59-589-30-235-30-471-30-736-118 265-236 500-383 736-118 235-235 442-354 619l-1855 2680zm4063 4682l-589-3062h-4594l-2061 3062h-1973l8540-12338 2650 12338h-1973zm-11808-6920h471c1031 0 1767-118 2179-354 412-235 677-647 825-1237 146-618 58-1089-236-1324-324-265-972-383-1943-383h-471l-825 3299zm-501 1590l-1266 5330h-1767l2827-11868h2856c854 0 1443 59 1826 147s678 236 913 471c294 265 500 648 589 1119 88 472 59 972-59 1531-147 560-353 1090-677 1561s-707 854-1119 1119c-353 206-736 382-1148 471-412 88-1060 148-1885 148h-1089v-30zm-17580 3563h1590c854 0 1531-59 2003-176 471-117 883-324 1266-589 530-383 972-854 1325-1443 354-560 619-1237 795-2002 176-766 235-1414 147-1972-88-561-294-1061-648-1444-265-294-589-471-1030-589-442-118-1119-176-2091-176h-1354l-2003 8392zm-2297 1767l2828-11868h2532c1649 0 2798 88 3415 265 619 177 1148 442 1561 854 530 530 884 1208 1031 2002 147 825 88 1767-147 2798-266 1060-648 1972-1178 2796-530 825-1207 1473-2002 2003-589 413-1237 678-1944 854-677 177-1708 265-3063 265h-3033v30zm-8628 0l2827-11868h6449l-383 1649h-4565l-707 2974h4565l-412 1679h-4565l-913 3827h4565l-412 1738h-6449zm-4565 0l2827-11868h1884l-2827 11868h-1885zm-8540 0l2827-11868h6449l-383 1649h-4564l-707 2945h4564l-412 1679h-4565l-1325 5565h-1885v30zm-4565 0l2827-11868h1884l-2827 11868h-1885zm-13015 0l2944-12338 5595 7244c147 206 294 413 442 648 147 235 294 501 471 794l1973-8216h1737l-2944 12310-5713-7392c-147-206-294-412-442-619-147-235-265-442-353-707l-1973 8245h-1737v30z' fill='#3a3734' />
                                                <path d='M233961 120588h-12927l17963-64873h12927l-17963 64873zm-107424-4064c-707 2562-3063 4358-5713 4358H54185c-1826 0-3180-619-4064-1855-883-1238-1089-2769-559-4594l16255-58541h12928l-14518 52298h51710l14517-52298h12928l-16844 60632zm100710-58777c-883-1237-2268-1855-4152-1855h-71027l-3504 12721h64608l-3769 13576h-51680v-30h-12927l-10719 38724h12927l7185-25973h58100c1826 0 3534-619 5124-1855 1590-1237 2651-2768 3151-4594l7185-25972c559-1943 383-3504-501-4741z' fill='#716d6a' />
                                                <path fill='#0e8635' d='M274245 55833l16344 32510-34365 32510 4087-14747 18794-17763-8941-17785z' />
                                                <path fill='#e97208' d='M262762 55833l16343 32510-34395 32510z' />
                                                <path d='M31367 0h270601c8631 0 16474 3528 22156 9210 5683 5683 9211 13526 9211 22156v136275c0 8629-3529 16472-9211 22155-5683 5682-13526 9211-22155 9211H31368c-8629 0-16473-3528-22156-9211C3530 184114 2 176272 2 167641V31366c0-8631 3528-16474 9210-22156S22738 0 31369 0zm270601 10811H31367c-5647 0-10785 2315-14513 6043s-6043 8866-6043 14513v136275c0 5646 2315 10784 6043 14512 3729 3729 8867 6044 14513 6044h270601c5645 0 10783-2315 14512-6044 3728-3729 6044-8867 6044-14511V31368c0-5645-2315-10784-6043-14513-3728-3728-8867-6043-14513-6043z' fill='gray' fill-rule='nonzero' />
                                            </svg>
                                            @elseif($item->method == "netbanking")
                                            <svg title="{{$item->method}}" width="30px" fill="gray" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 111.67">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill-rule: evenodd;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>net-banking</title>
                                                <path class="cls-1" d="M2.6,38.7,57.17,0,112,38.7ZM106.49,58.89a18.63,18.63,0,0,1,16.39,18.45V93.08a18.58,18.58,0,0,1-37.16,0V77.33A18.62,18.62,0,0,1,102.1,58.89V48.62a2.2,2.2,0,0,1,4.4,0V58.89Zm7.83,8.43a14.18,14.18,0,0,0-24.2,10V93.08a14.19,14.19,0,0,0,28.38,0V77.33a14.15,14.15,0,0,0-4.17-10Zm-10.23,6h0a3.54,3.54,0,0,1,3.53,3.53v3.65A3.54,3.54,0,0,1,104.09,84h0a3.56,3.56,0,0,1-3.54-3.53V76.8a3.54,3.54,0,0,1,3.54-3.53ZM0,95.16H6.35V89.27H9.68V86.46h3.58V52.75H5.94V44.68H95.6a9.45,9.45,0,0,0-.86,3.94v4.61c-.59.24-1.18.5-1.75.78a25.88,25.88,0,0,0-5.39,3.51V52.75H76.29V86.46h2.07v6.62h0a25.75,25.75,0,0,0,1.34,8.25H0V95.16Zm30.32-5.89h4.13V86.46H38V52.75H26.74V86.46h3.58v2.81Zm24.78,0h4.14V86.46h3.57V52.75H51.52V86.46H55.1v2.81ZM38.79,28.94,57.25,14.78,75.81,28.94Z" />
                                            </svg>
                                            @elseif($item->method == "card")
                                            <svg title="{{$item->method}}" width="40px" fill="gray" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 513 387.494">
                                                <path stroke="#000" stroke-miterlimit="22.926" d="M426.598 63.797V30.994c0-9.998-8.211-18.246-18.247-18.246H30.996c-10.037 0-18.247 8.21-18.247 18.246v32.803h413.849zM138.055 314.175a7.663 7.663 0 010-15.326h116.353a7.663 7.663 0 010 15.326H138.055zm222.817-60.668c11.435 0 21.582 5.515 27.927 14.032 6.346-8.517 16.491-14.032 27.928-14.032 19.223 0 34.807 15.585 34.807 34.809 0 19.223-15.584 34.807-34.807 34.807-11.437 0-21.582-5.515-27.928-14.03-6.345 8.515-16.492 14.03-27.927 14.03-19.224 0-34.808-15.584-34.808-34.807 0-19.224 15.584-34.809 34.808-34.809zm-212.197-99.17h58.428c7.451 0 13.547 6.096 13.547 13.547v2.96h-85.523v-2.96c0-7.451 6.097-13.547 13.548-13.547zm71.975 21.168v28.883h-26.531v-28.883h26.531zm-31.192 28.883H166.29v-28.883h23.168v28.883zm-27.83 0h-26.501v-28.883h26.501v28.883zm59.022 4.662v3.005c0 7.451-6.097 13.548-13.547 13.548h-58.428c-7.45 0-13.548-6.096-13.548-13.548v-3.005h85.523zm-82.595 68.734a7.663 7.663 0 010-15.325h154.304a7.663 7.663 0 110 15.325H138.055zM12.749 141.627v124.909c0 10.036 8.248 18.247 18.247 18.247h43.163V141.627h-61.41zm426.097-51.164h43.16c8.366 0 15.973 3.436 21.49 8.952l.048.048c5.524 5.527 8.956 13.145 8.956 21.494V356.5c0 8.325-3.438 15.938-8.962 21.484l-.076.075c-5.543 5.508-13.144 8.935-21.456 8.935H104.654c-8.35 0-15.968-3.432-21.495-8.956l-.047-.048c-5.516-5.517-8.953-13.124-8.953-21.49v-59.469H30.996c-8.348 0-15.969-3.433-21.496-8.957l-.048-.048C3.936 282.509.5 274.902.5 266.536V30.995c0-8.399 3.429-16.028 8.948-21.547.287-.286.583-.554.89-.807C15.798 3.594 23.066.5 30.996.5h377.355c8.366 0 15.973 3.436 21.49 8.952l.024.024.024-.024c5.526 5.527 8.957 13.161 8.957 21.543v59.468zm-334.192 12.248h377.352c10.036 0 18.246 8.249 18.246 18.247v235.541c0 9.998-8.248 18.247-18.246 18.247H104.654c-9.998 0-18.246-8.211-18.246-18.247V120.958c0-10.036 8.21-18.247 18.246-18.247z" />
                                            </svg>
                                            @endif

                                        </td>
                                        <td class="p-2 text-gray-800 text-center">
                                            ₹{{ $item->total_amount }}
                                        </td>
                                        <td class="p-2 text-gray-800 text-center">
                                            @if($item->payment_date)
                                            {{ \Carbon\Carbon::parse($item->payment_date)->format('d M Y') }}
                                            @else
                                            @endif
                                        </td>
                                        <td class="p-2 text-gray-800 text-center">
                                            @if($item->status === 'captured')
                                            <a href="{{ route('student.viewbilling', $item->id) }}" class="py-2.5 px-6 text-xs font-semibold text-indigo-500 transition-all duration-500 hover:text-indigo-700">Print Invoice</a>
                                            @elseif($item->status === 'failed')
                                            <span class="text-red-500 font-semibold">Failed</span>
                                            @else
                                            <!-- <button class="refresh-payment py-1 px-2 text-xs bg-indigo-900 text-white rounded-lg font-semibold shadow-xs transition-all duration-500 hover:bg-indigo-700" data-order-id="{{ $item->order_id }}">Refresh</button> -->
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif

                            </table>
                        </div>
                        <!-- here we will show the enrolled courses data -->
                        <div class="p-4 overflow-x-auto hidden" id="styled-enrolled" role="tabpanel" aria-labelledby="enrolled-styled-tab">
                        <table class="min-w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Enrolled Courses</th>
                                        <th class="p-2 text-center text-xs font-medium text-gray-600 ">Enrolling Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($courses as $course)
                                    @php
                                        $enrolling_date = $enrolledCourses->firstWhere('course_id', $course->id)->created_at ?? null;   
                                        $formattedDate = $enrolling_date ? \Carbon\Carbon::parse($enrolling_date)->format('Y-m-d') : 'N/A';
                                    @endphp
                                <tr>
                                <td class="p-2 text-center  text-xs text-gray-800">
                                    {{$course->title}}
                                </td>
                                <td class="p-2 text-center  text-xs text-gray-800">
                                {{ $formattedDate}}                                
                                </td>
                                </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
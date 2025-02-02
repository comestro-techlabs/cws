@extends('admin/base')

@section('title', 'Manage Students |')

@section('content')
    <div class="flex flex-1 flex-col">
        <div class="md:px-[2%] px-5 py-5">
            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">

                <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3">@if(isset($_GET['search']) && $_GET['search'] !== "")
                    {{$_GET['search']}}
                @else
                    {{"Manage all"}}
                @endif students ({{count($students)}})</h2>


                {{-- search form starts here --}}

                {{-- search form ends here --}}


                <div class="inline-flex md:flex-row flex-col  md:items-center gap-2" role="group">


                    <form method="GET" action="{{ route('student.manage') }}">
                        <select name="filter" onchange="this.form.submit()" class="border rounded-lg px-3 py-2">
                            <option value="">Filter by</option>
                            <option value="member" {{ request('filter') == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="user" {{ request('filter') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="status_active" {{ request('filter') == 'status_active' ? 'selected' : '' }}>Active</option>
                            <option value="status_inactive" {{ request('filter') == 'status_inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </form>



                    
                    <form action="{{ route('student.search') }}" method="get" class=" md:max-w-md md:mx-auto">

                        <div class="flex border rounded-lg ps-3">

                            <input type="search" id="default-search" name="search"
                                value="{{old('search')}}"
                                class="border-0 focus:outline-none focus:border-none w-full"
                                placeholder="Search student by name..." size="30"  />
                            <button type="submit"
                                class="bg-slate-100 px-3">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg></button>
                        </div>
                    </form>
                        {{-- <a href="{{ route('student.create') }}"
                            class="px-3 py-2 bg-teal-600 rounded-lg text-white self-start">
                            Add student
                        </a> --}}
                </div>

            </div>
            <div class="relative overflow-x-auto flex-1 border  mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                FullName
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>

                            <th scope="col" class="px-6 py-3">
                                education_qualification
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gender
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DOB
                            </th>
                            <th scope="col" class="px-6 py-3">
                                IsMember
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="bg-white border-b ">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $student->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->contact }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->education_qualification }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->gender }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->dob }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="{{ $student->is_member == 1 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $student->is_member == 1 ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                


                                <td class="flex gap-2 items-center px-6 py-4">
                                    <a href="{{ route('student.edit', $student->id) }}"
                                        class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500">
                                        Show
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <div class="flex flex-1 space-x-2 justify-center mt-2 pagination">
                {{$students->links()}}
            </div>
        </div>
    @endsection

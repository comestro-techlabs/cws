@extends('admin.base')

@section('title', 'Show Course | ')

@section('content')
    <div class="flex px-[2%] py-0 flex-col">
        <div class="flex gap-3  my-5  flex-row justify-between items-center">

            <h2 class="md:text-xl text-lg font-semibold dark:text-slate-300 text-slate-500 border-s-4 border-s-orange-400 pl-3">
                Insert Course</h2>

            <div class="inline-flex flex-row  md:items-center gap-2" role="group">
                
                <a href="{{ route('course.index') }}"
                    class="px-3 py-2 bg-teal-600 rounded-lg text-white self-start">
                    Public Course
                </a>
            </div>

        </div>
        <div class="grid grid-cols-2 gap-5">
            @foreach (['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees', 'category_id', 'category_image'] as $field)
                <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                    <div class="flex flex-1 flex-col gap-2">
                        <strong>{{ ucfirst($field) }}:</strong>
                        <span id="{{ $field }}-value">
                            @if ($course->$field) 
                                {{ ($field =="fees" or $field=="discounted_fees") ? "₹" . $course->$field : (($field =="duration") ? $course->$field . " Weeks" : $course->$field) }}
                            
                            @else
                                <span class="italic">{{ $field }} is empty</span>
                            @endif
                        </span>
                        <form id="{{ $field }}-form" action="{{ route('course.update', ['course' => $course->id, 'field' => $field]) }}" method="POST" style="display: none;" class="flex flex-col w-full">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3 flex flex-1 flex-col gap-1">
                                @if ($field == "description")
                                    <textarea id="description" name="{{ $field }}" class="border w-full px-3 py-2" rows="5">{{$course->$field}}</textarea> 
                                @elseif ($field == 'category_image')
                                    <input type="file" name="{{ $field }}">  
                                @elseif ($field == 'category_id')
                                    <select name="{{ $field }}" class="px-3 py-2 w-full">             
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                        @endforeach
                                    </select>                    
                                @else
                                    <input class="border w-full px-3 py-2" type="{{($field == 'fees' || $field == 'discounted_fees' || $field == 'duration') ? 'number' : 'text'}}" name="{{ $field }}" value="{{ $course->$field }}">    
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="bg-black text-white px-3 py-2 rounded">Save</button>
                                <button type="button" onclick="toggleEdit('{{ $field }}')" class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <button onclick="toggleEdit('{{ $field }}')" class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Edit</button>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleEdit(field) {
            const valueSpan = document.getElementById(field + '-value');
            const form = document.getElementById(field + '-form');
            const isFormVisible = form.style.display === 'block';

            if (isFormVisible) {
                valueSpan.style.display = 'block';
                form.style.display = 'none';
            } else {
                valueSpan.style.display = 'none';
                form.style.display = 'block';
            }
        }
    </script>
@endsection

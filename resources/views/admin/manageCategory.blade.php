@extends('admin/base')

@section('title', 'Manage Categories |')

@section('content')
    <div class="flex flex-1 flex-col w-full">
        <div class=" px-5 py-5">
            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">
                <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3">Categories</h2>
            </div>
            @session('success')
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
                <span class="font-medium">Success!</span> {{session('success')}}
              </div>
            @endsession

            @session('error')
            <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
                <span class="font-medium">Success!</span> {{session('error')}}
              </div>
            @endsession
            <div class="flex flex-1 gap-3  mt-5">
                <div class="w-9/12">
                    <div class="relative overflow-x-auto flex-1 border ">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        slug
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $category->id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $category->cat_title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $category->cat_slug }}
                                        </td>


                                        <td class="px-6 py-4">
                                            {{$category->cat_description }}
                                        </td>
                                        <td class="flex gap-2 items-center px-6 py-4">

                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                class="inline-flex items-center">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="delete"
                                                    class="px-3 py-2 text-sm font-medium text-white bg-red-500" value="X">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                    <div class="flex flex-1 space-x-2 justify-center mt-2 pagination">
                        {{$categories->links()}}
                    </div>
                </div>
                <div class="w-full sm:w-3/4 md:w-1/2 lg:w-3/12 max-w-md mx-auto px-4">
                    <div class="bg-slate-100 rounded  p-4 sm:p-6">
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="mb-3 flex flex-col gap-2">
                                <label for="" class="text-base sm:text-lg">Category title</label>
                                <input type="text" name="cat_title" value="{{old('cat_title')}}" class="border w-full px-3 py-2 rounded">
                                @error('cat_title')
                                    <p class="text-xs text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3 flex flex-col gap-2">
                                <label for="" class="text-base sm:text-lg">Category description</label>
                                <textarea rows="5" name="cat_description" class="border w-full px-3 py-2 rounded">{{old('cat_description')}}</textarea>
                                @error('cat_description')
                                    <p class="text-xs text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="bg-emerald-600 px-3 py-2 text-2xl text-center text-white rounded w-full sm:text-lg cursor-pointer" value="Create Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            

        </div>
    @endsection

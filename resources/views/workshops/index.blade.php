@extends('admin.base')

@section('title', 'Workshops')

@section('content')

<div class="flex flex-wrap justify-between items-center p-4">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Workshops List</h2>
    <a href="{{ route('workshops.create') }}" class="px-4 py-2 bg-blue-500 text-white  rounded hover:bg-blue-600">
        Add New Workshops
    </a>
</div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">

            <div class="overflow-x-auto">
            <livewire:admin.workshops.manage-workshop/>
            </div>
        </div>
    </div>
@endsection

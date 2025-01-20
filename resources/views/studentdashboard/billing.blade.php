@extends('studentdashboard.include.base')
@section('content')

<div class="page mt-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
  <!-- Page Heading -->
  <div class="border-b border-gray-300 dark:border-gray-700 py-4">
    <div class="container mx-auto px-6 flex items-center">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Billing</h1>
    </div>
  </div>

  <div class="container mx-auto px-6 py-6">
    <!-- Invoices Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
      <div class="p-4 border-b border-gray-300 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Invoices</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Your past payments</p>
      </div>

      <div class="p-4 overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
              <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Course Name</th>
              <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Course Category</th>
              <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Payment Amount</th>
              <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Payment Date</th>
              <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($payments as $item)
            <tr>
              <td class="py-3 px-4 text-gray-800 dark:text-gray-200">
                {{ $item->course->title }}
              </td>
              <td class="py-3 px-4 text-gray-800 dark:text-gray-200">
                {{ $item->course->category->cat_title }}
              </td>
              <td class="py-3 px-4 text-gray-800 dark:text-gray-200">
                ₹{{ $item->transaction_fee }}
              </td>
              <td class="py-3 px-4 text-gray-800 dark:text-gray-200">
                {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
              </td>
              <td class="py-3 px-4">
                <button class="text-blue-600 dark:text-blue-400 hover:underline" onclick="window.print()">Print Invoice</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

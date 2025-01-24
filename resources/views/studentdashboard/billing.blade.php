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
              <th class="py-3 px-4 text-centert text-sm font-medium text-gray-600 dark:text-gray-400">Course Name</th>
              <!-- <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Course Category</th> -->
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Order Id</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Payment Status</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Method</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Payment Amount</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Payment Date</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($payments as $item)
            <tr>
              <td class="py-3 px-4 text-center text-gray-800 dark:text-gray-200">
                {{ $item->course->title }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800 dark:text-gray-200">
                {{ $item->order_id }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800 dark:text-gray-200">
                <div class="flex items-center justify-center h-full">
                  @if($item->payment_status === 'captured')
                  <p class="inline-block bg-green-500 text-center text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-green-600 dark:text-white">Completed</p>
                  @elseif($item->payment_status === 'cancelled')
                <p class="inline-block bg-red-500 text-center text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-green-600 dark:text-white">Failed</p>
              @else
              <p class="inline-block bg-yellow-300 text-center text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-400 dark:text-gray-900">Pending</p>
              @endif
            </div>
      </td>
      <td class="py-3 px-4 text-gray-800 text-center dark:text-gray-200">
        {{ $item->method }}
      </td>
      <td class="py-3 px-4 text-gray-800 text-center dark:text-gray-200">
        ₹{{ $item->transaction_fee }}
      </td>
      <td class="py-3 px-4 text-gray-800 text-center dark:text-gray-200">
        {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
      </td>

      @if($item->payment_status === 'captured')
      <td class="py-3 px-4 text-center">
        <button class="text-blue-600 dark:text-blue-400 hover:underline" onclick="window.print()">Print Invoice</button>
      </td>
      @elseif($item->payment_status === 'cancelled')
      <td class="py-3 px-4 text-center">
        <button class="text-white bg-red-700  focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700">Failed</button>
      </td>
      @else
      <td class="py-3 px-4 text-center">
        @if($item->payment_status === 'authorized')
        <a href="{{route('payment.refresh','$item->payment_id')}}" id="refresh-button">
          <button class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700">Refresh</button>
        </a>
        @else
        <td class="py-3 px-4 text-center">
        <button class="text-white bg-red-700  focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700">Failed</button>
        </td>
        @endif
      </td>

      @endif
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection
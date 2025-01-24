@extends('studentdashboard.include.base')
@section('content')

<div class="page mt-16 bg-gray-50 min-h-screen">
  <!-- Page Heading -->
  <div class="border-b border-gray-300 py-4">
    <div class="container mx-auto px-6 flex items-center">
      <h1 class="text-2xl font-bold text-gray-800">Billing</h1>
    </div>
  </div>

  <div class="container mx-auto px-6 py-6">
    <!-- Invoices Table -->
    <div class="bg-white shadow rounded-lg">
      <div class="p-4 border-b border-gray-300">
        <h2 class="text-lg font-semibold text-gray-800">Invoices</h2>
        <p class="text-sm text-gray-600">Your past payments</p>
      </div>

      <div class="p-4 overflow-x-auto">
        <table class="min-w-full bg-white divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Course Name</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Order Id</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Payment Status</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Method</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Payment Amount</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Payment Date</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($payments as $item)
            <tr>
              <td class="py-3 px-4 text-center text-gray-800">
                {{ $item->course->title }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                {{ $item->order_id }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                <div class="flex items-center justify-center">
                  @if($item->payment_status === 'captured')
                  <p class="inline-block bg-green-500 text-white text-xs font-medium px-2 py-0.5 rounded">Completed</p>
                  @elseif($item->payment_status === 'cancelled')
                  <p class="inline-block bg-red-500 text-white text-xs font-medium px-2 py-0.5 rounded">Failed</p>
                  @else
                  <p class="inline-block bg-yellow-300 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">Pending</p>
                  @endif
                </div>
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                {{ $item->method }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                ₹{{ $item->transaction_fee }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
              </td>

              @if($item->payment_status === 'captured')
              <td class="py-3 px-4 text-center">
                <button class="text-blue-600 hover:underline" onclick="window.print()">Print Invoice</button>
              </td>
              @elseif($item->payment_status === 'cancelled')
              <td class="py-3 px-4 text-center">
                <button class="text-white bg-red-700 font-medium rounded-full text-sm px-5 py-2.5">Failed</button>
              </td>
              @else
              <td class="py-3 px-4 text-center">
                @if($item->payment_status === 'authorized')
                <a href="{{route('payment.refresh', '$item->payment_id')}}">
                  <button class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-2.5">Refresh</button>
                </a>
                @else
                <button class="text-white bg-red-700 font-medium rounded-full text-sm px-5 py-2.5">Failed</button>
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

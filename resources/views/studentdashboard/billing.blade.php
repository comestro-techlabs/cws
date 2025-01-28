@extends('studentdashboard.include.base')
@section('content')

<div class="page mt-16  min-h-screen">
  <!-- Page Heading -->
  <div class="border-b border-gray-300 py-4">
    <div class="container mx-auto px-6 flex items-center">
      <h1 class="text-2xl font-bold text-gray-800">Manage Your Billing</h1>
    </div>
  </div>

  <div class="container mx-auto px-4 py-4">
    <!-- Invoices Table -->
    <div class="bg-white shadow rounded-lg">
      <div class="p-4 border-b border-gray-300 mt-5">
        <h2 class="text-lg font-semibold text-gray-800">Invoices</h2>
        <p class="text-sm text-gray-600">Your past payments</p>
      </div>
      <div class="p-4 overflow-x-auto">
        <table class="min-w-full bg-white divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-4 text-centert text-sm font-medium text-gray-600 ">Course / Workshop Name</th>
              <!-- <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 ">Course Category</th> -->
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Order Id</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Status</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Method</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Amount</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Date</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Error Reason</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($paymentsWithWorkshops as $item)
            <tr>
              <td class="py-3 px-4 text-center text-gray-800">
                @if(!empty($item->workshop_title))
                {{ $item->workshop_title }}
                @elseif(!empty($item->course->title))
                {{ $item->course->title }}
                @else
                {{ 'No Title Available' }}
                @endif
              </td>

              <td class="py-3 px-4 text-center text-gray-800">
                {{ $item->order_id }}
              </td>
              <td class="py-3 px-4 text-center text-gray-800">
                @if($item->status === "captured")
                <div class="flex items-center justify-center rounded-full bg-green-500 uppercase px-2 py-1 text-center text-xs font-bold mr-3">
                  {{$item->status}}
                </div>
                @elseif($item->status === "failed")
                <div class="flex items-center justify-center rounded-full bg-red-500 uppercase px-2 py-1 text-xs text-center font-bold mr-3">
                  {{$item->status}}
                </div>
                @else
                <div class="flex items-center justify-center rounded-full bg-yellow-500 uppercase px-2 py-1 text-center text-xs font-bold mr-3">
                  {{$item->status}}
                </div>
                @endif
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ $item->method ?? 'N/A'}}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                ₹{{ $item->transaction_fee }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-left truncate max-w-xs" title="{{ $item->error_reason }}">
                {{ $item->error_reason }}
              </td>

              @if($item->status === 'captured')
              <td class="py-3 px-4 text-center">
                <a href="{{ route('student.viewbilling') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5  cursor-pointer">Print Invoice</a>
              </td>
              @elseif($item->status === 'failed')
              <td class="py-3 px-4 text-center">
              </td>
              @else
              <td class="py-3 px-4 text-center">
              <button class="refresh-payment py-2.5 px-6 text-sm bg-indigo-900 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-700" data-order-id="{{ $item->order_id }}">Refresh</button>
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

@section('scripts')



<script>
  document.querySelectorAll('.refresh-payment').forEach(button => {
  button.addEventListener('click', function (e) {
    e.preventDefault();

    const orderId = e.target.getAttribute('data-order-id');
    // Send a request to the backend to refresh the payment status for the given order_id
    fetch("{{ route('refresh.payment.status') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          order_id: orderId
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Payment status updated successfully!');
          window.location.reload(true); // Reload the page to reflect updates
        } else {
          alert('Failed to refresh payment status: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error refreshing payment:', error);
        alert('There was an error refreshing the payment status.');
      });
  });
});

</script>


@endsection
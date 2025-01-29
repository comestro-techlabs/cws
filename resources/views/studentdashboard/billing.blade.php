@extends('studentdashboard.include.base')
@section('content')

<div class="page mt-10  min-h-screen">
  <!-- Page Heading -->
  <div class=" py-4">
    <div class="container mx-auto px-6 flex items-center">
      <h1 class="text-2xl font-bold text-gray-800">Manage Your Billing</h1>
    </div>
  </div>

  <div class="container mx-auto px-4 py-4">
    <!-- Invoices Table -->
   
    <div class="mb-4 ">
      <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
          <li class="me-2" role="presentation">
              <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Invoice</button>
          </li>
          <li class="me-2" role="presentation">
              <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Membership</button>
          </li>
         
      </ul>
    </div>
    <div id="default-styled-tab-content">
    {{-- <div class="bg-white shadow rounded-lg "id="default-styled-tab-content"  > --}}
      {{-- <div class="p-4 border-b border-gray-300 mt-5">
        <h2 class="text-lg font-semibold text-gray-800">Invoices</h2>
        <p class="text-sm text-gray-600">Your past payments</p>
      </div> --}}
      <div class="p-4 overflow-x-auto" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" >
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
              <!-- {{$item->id}} -->
              <td class="py-3 px-4 text-center text-gray-800">
                @if(!empty($item->workshop_title))
                {{ $item->workshop_title }}
                @elseif(!empty($item->course->title))
                {{ $item->course->title }}
                @elseif(empty($item->course_id) && empty($item->workshop_id))
                {{'Subscription Fee'}}
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
                <a href="{{ route('student.viewbilling') }}" class="py-2.5 px-6 text-sm font-semibold text-indigo-500 transition-all duration-500 hover:text-indigo-700">Print Invoice</a>
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
      

    {{-- </div> --}}
    {{-- <div class="bg-white shadow rounded-lg " id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab"> --}}
      {{-- <div class="p-4 border-b border-gray-300 mt-5">
        <h2 class="text-lg font-semibold text-gray-800">MemberShip</h2>
        <p class="text-sm text-gray-600">Your past payments</p>
      </div> --}}
      <div class="p-4 overflow-x-auto" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <table class="min-w-full bg-white divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-4 text-centert text-sm font-medium text-gray-600 ">Month</th>
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
            
          </tbody>

        </table>
      </div>
      

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
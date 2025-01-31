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
      <div class="p-4 overflow-x-auto" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
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
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Month</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Year</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Error Reason</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Action</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            @foreach ($paymentsWithWorkshops as $item)
            @if($item->course_id || $item->workshop_title)
            <tr>
              <!-- {{$item->id}} -->
              <td class="py-3 px-4 text-center">
                @if(!empty($item->workshop_title))
                {{ $item->workshop_title }}
                @elseif(!empty($item->course->title))
                {{ $item->course->title }}
                @else
                {{ 'Membership Fee' }}
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
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ \Carbon\Carbon::create()->month((int)$item->month)->format('M') }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ $item->year}}
              </td>
              <td class="py-3 px-4 text-gray-800 text-left truncate max-w-xs" title="{{ $item->error_reason }}">
                {{ $item->error_reason }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                @if($item->status === 'captured')
                <a href="{{ route('student.viewbilling') }}" class="py-2.5 px-6 text-sm font-semibold text-indigo-500 transition-all duration-500 hover:text-indigo-700">Print Invoice</a>
                @elseif($item->status === 'failed')
                <span class="text-red-500 font-semibold">Failed</span>
                @elseif($item->status === 'unpaid')
                <button class="pay-now-button py-2.5 px-6 text-sm bg-green-500 text-white rounded-lg font-semibold shadow-xs transition-all duration-500 hover:bg-green-700"
                  data-payment-id="{{ $item->id }}"
                  data-order-id="{{ $item->order_id }}"
                  data-amount="{{ $item->transaction_fee }}"
                  data-student-id="{{ $item->student_id }}">
                  Pay Now
                </button>
                @else
                <button class="refresh-payment py-2.5 px-6 text-sm bg-indigo-900 text-white rounded-lg font-semibold shadow-xs transition-all duration-500 hover:bg-indigo-700" data-order-id="{{ $item->order_id }}">Refresh</button>
                @endif
              </td>

            </tr>
            @endif
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
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Date</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 "> Month & Year</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Order Id</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Status</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Method</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Amount</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Payment Date</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Error Reason</th>
              <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 ">Action</th>
            </tr>
          </thead>
          @if(Auth::user()->is_member)
          <tbody class="divide-y divide-gray-200">
            @foreach ($paymentsWithWorkshops as $item)
            @if(empty($item->course_id) && empty($item->workshop_title))
            <tr>
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                {{ \Carbon\Carbon::create((int)$item->year, (int)$item->month, 1)->format('M Y') }}
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
                {{ $item->year}}
              </td>
              <td class="py-3 px-4 text-gray-800 text-left truncate max-w-xs" title="{{ $item->error_reason }}">
                {{ $item->error_reason }}
              </td>
              <td class="py-3 px-4 text-gray-800 text-center">
                @if($item->status === 'captured')
                <a href="{{ route('student.viewbilling') }}" class="py-2.5 px-6 text-sm font-semibold text-indigo-500 transition-all duration-500 hover:text-indigo-700">Print Invoice</a>
                @elseif($item->status === 'failed')
                <span class="text-red-500 font-semibold">Failed</span>
                @elseif($item->status === 'unpaid' || $item->status==='due')
                <button class="pay-now-button py-2.5 px-6 text-sm bg-green-500 text-white rounded-lg font-semibold shadow-xs transition-all duration-500 hover:bg-green-700"
                  data-payment-id="{{ $item->id }}"
                  data-order-id="{{ $item->order_id }}"
                  data-amount="{{ $item->transaction_fee }}"
                  data-student-id="{{ $item->student_id }}">
                  Pay Now
                </button>
                @else
                <button class="refresh-payment py-2.5 px-6 text-sm bg-indigo-900 text-white rounded-lg font-semibold shadow-xs transition-all duration-500 hover:bg-indigo-700" data-order-id="{{ $item->order_id }}">Refresh</button>
                @endif
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
          @endif


        </table>
      </div>


    </div>
  </div>
</div>
</div>




@endsection

@section('scripts')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpayKey = "{{ env('RAZORPAY_KEY') }}";
  var csrfToken = "{{ csrf_token() }}";
  var createOrderRoute = "{{ route('create.razorpay.order') }}"; // Route to create Razorpay order
  var updatePaymentRoute = "{{ route('update.payment.status') }}"; // Route to update payment status

  document.querySelectorAll('.pay-now-button').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      const studentId = this.getAttribute('data-student-id');
      const amount = this.getAttribute('data-amount');

      console.log("Creating order for amount:", amount);

      // ✅ Step 1: Create Razorpay Order before initiating payment
      fetch(createOrderRoute, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
          },
          body: JSON.stringify({
            student_id: studentId,
            amount: amount
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const orderId = data.order_id;

            console.log("Generated Order ID:", orderId);

            // ✅ Step 2: Open Razorpay Payment Popup
            var options = {
              "key": razorpayKey,
              "amount": amount * 100, // Convert to paisa
              "currency": "INR",
              "order_id": orderId, // Pass the correct order ID
              "name": "Comestro Techlabs",
              "description": "Payment for Course Fee",
              "handler": function(response) {
                console.log("Payment Response:", response);

                let bodyData = {
                  student_id: studentId,
                  razorpay_payment_id: response.razorpay_payment_id,
                  razorpay_order_id: response.razorpay_order_id,
                  razorpay_signature: response.razorpay_signature
                };

                console.log("Updating payment status with:", bodyData);

                // ✅ Step 3: Update payment status after successful payment
                fetch(updatePaymentRoute, {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json",
                      "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify(bodyData)
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.success) {
                      alert('Payment successful! Redirecting...');
                      window.location.reload(true);
                    } else {
                      alert('Payment failed: ' + data.message);
                    }
                  })
                  .catch(error => {
                    console.error('Error updating payment:', error);
                    alert('Error updating payment status.');
                  });
              },
              "theme": {
                "color": "#3399cc"
              }
            };

            var rzp1 = new Razorpay(options);

            // ✅ Handle payment failure
            rzp1.on('payment.failed', function(response) {
              alert('Payment failed: ' + response.error.description);
            });

            rzp1.open();
          } else {
            alert("Failed to create order: " + data.message);
          }
        })
        .catch(error => {
          console.error("Error creating order:", error);
          alert("Error creating Razorpay order.");
        });
    });
  });
</script>
</script>

<script>
  document.querySelectorAll('.refresh-payment').forEach(button => {
    button.addEventListener('click', function(e) {
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
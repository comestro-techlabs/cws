<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  
</head>
</body>
<div class="bg-gray-100  flex justify-center items-center">
     <div class=" p-8 bg-white  rounded-lg w-90 h-90 mt-5 mb-20 ">
      
        <div class="flex justify-between items-center mb-6">
            <img src="{{ asset('apple-touch-icon.png') }}" alt="Logo" class="h-16">
            <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
        </div>

        <div class="mb-4">
            <div class="flex justify-between pb-2 mt-5">
                <div>
                    <p class="text-sm text-black font-bold">INVOICE TO:</p>
                    <p class="text-base text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-black font-bold">SEND PAYMENT TO:</p>
                    <p class="text-base text-gray-800">Learn Syntax</p>
                </div>
                <div>
                    <p class="text-sm text-black font-bold">DATE:</p>
                    <p class="text-base text-gray-800">{{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <table class="w-full h-64  border-collapse border border-gray-300 mt-20 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Course Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Order ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Duration</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Amount</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Payment Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $payment->course->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $payment->order_id }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$payment->course->duration}} Week</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">₹{{ $payment->transaction_fee }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ \Carbon\Carbon::parse($payment->transaction_date)->format('d M Y') }}</td>
                    @if($payment->status === 'captured')
                    <td class="border border-gray-300 px-4 py-2 text-center">
                       <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">Paid</span>
                    
                    </td>
                
                  @endif
                   
                </tr>
                @endforeach
            </tbody>
           
        </table>
           
       
        <div class="mt-10 flex justify-between items-center">
            <a href="{{route('student.billing')}}" class="text-blue-500 text-sm hover:underline">Go Back</a>
            <p class="text-black font-bold">THANK YOU</p>
        </div>
        
         
    </div>
</div>
</html>
</body>

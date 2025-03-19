<?php

namespace App\Livewire\Student\Dashboard\Product;

use Illuminate\Support\Str;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckOutPage extends Component
{
    public $my_product;
    public $title;
    public $description;
    public $belongToCategory;
    public $gems;
    //will make these dynamic
    public $totalAvailableGems = 1000;
    public $shipping_charge = 0;
    public $totalPriceOfProduct;
    public $balanceGems;
    public $shippingDetailsFilled;
    public $productImageUrl;
    // public $shippingDetailsAvailablity = true ;


    // Address form fields
    public $first_name, $last_name, $email, $address_line,
        $city, $state, $postal_code, $country, $phone;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address_line' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'postal_code' => 'required|string|max:50',
        'country' => 'required|string|max:100',
        'phone' => 'required|string|max:50',
    ];

    public function mount($productId)
    {
        // dd($productId);
        $this->my_product = Products::with('category')->findOrFail($productId);
        // dd($this->my_product);
        $this->title = $this->my_product->name;
        // dd($this->title);
        $this->description = $this->my_product->description;
        $this->gems = $this->my_product->points;
        $this->belongToCategory = $this->my_product->category->name;
        // dd($this->belongToCategory);
        $this->balanceGems = $this->totalAvailableGems - $this->gems;
        $this->totalPriceOfProduct = $this->gems + $this->shipping_charge;
        // $this->refreshShipDetails();
        $this->shippingDetailsFilled = ShippingDetail::where('user_id', Auth::id())->first();
        $this->productImageUrl =  $this->my_product->imageUrl;
        // dd($this->shippingDetailsFilled);

    }
    public function editShippingAddress()
    {
        $this->shippingDetailsFilled = ShippingDetail::where('user_id', Auth::id())->first();
        // dd($this->shippingDetailsFilled);
        if ($this->shippingDetailsFilled) {
            $this->first_name = $this->shippingDetailsFilled->first_name;
            $this->last_name = $this->shippingDetailsFilled->last_name;
            $this->email = $this->shippingDetailsFilled->email;
            $this->address_line = $this->shippingDetailsFilled->address_line;
            $this->city = $this->shippingDetailsFilled->city;
            $this->state = $this->shippingDetailsFilled->state;
            $this->postal_code = $this->shippingDetailsFilled->postal_code;
            $this->country = $this->shippingDetailsFilled->country;
            $this->phone = $this->shippingDetailsFilled->phone;

            $this->shippingDetailsFilled = false; // Show the form for editing
        }
    }
    #[On('updateshippingDetails')]
    public function refreshShipDetails()
    {
        // dd('shaique');
        $this->shippingDetailsFilled = ShippingDetail::where('user_id', Auth::id())->first();
        // dd($this->shippingDetailsFilled);
        // $this->shippingDetailsAvailablity = true;
    }


    public function saveShippingAddress()
    {

        $validatedData = $this->validate();

        $validatedData['user_id'] = Auth::id(); // Add user_id

        $this->shippingDetailsFilled = ShippingDetail::where('user_id', Auth::id())->first(); //check if already exists
        if ($this->shippingDetailsFilled) {
            $this->shippingDetailsFilled->update($validatedData);
            session()->flash('message', 'Shipping details updated successfully!');
        } else {
            ShippingDetail::create($validatedData); // Save to DB
            session()->flash('message', 'Shipping details saved successfully!');
        }

        $this->dispatch('updateshippingDetails')->self();

        // $this->reset();

    }

    public function completeRedemption()
    {
        // dd('shaique'); 
        try {
            Orders::create([
                'user_id' => Auth::id(),
                'shipping_detail_id' => $this->shippingDetailsFilled->id,
                'product_id' => $this->my_product->id,
                'order_number' => Str::random(6),
                'total_amount' => $this->totalPriceOfProduct,
                'status' => 'pending',
                'payment_method' => 'gems',
                'transaction_id' => Str::random(10),
            ]);
            Mail::raw('Your redemption has been successfully completed.', function ($message) {
                $message->to(auth()->user()->email)
                    ->subject('Redemption Confirmation');
            });

            // session()->flash('message', 'Redemption email sent successfully!');
            $this->dispatch('showAlert', 'Redemption completed successfully!');
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Something went wrong! Please try again.');
        }
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.check-out-page');
    }
}

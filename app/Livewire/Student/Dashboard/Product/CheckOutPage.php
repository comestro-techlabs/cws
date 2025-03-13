<?php

namespace App\Livewire\Student\Dashboard\Product;

use App\Models\Products;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CheckOutPage extends Component
{
    public $my_product;
    public $title;
    public $description;
    public $belongToCategory;
    public $gems;
    //will make these dynamic
    public $totalAvailableGems=1000;
    public $shipping_charge=0;
    public $totalPriceOfProduct;
    public $balanceGems;

    
    // Address form fields
    public $fullName;
    public $addressLine1;
    public $addressLine2;
    public $city;
    public $state;
    public $postalCode;
    public $country;
    public $phoneNumber;
    
    protected $rules = [
        'fullName' => 'required|string|max:100',
        'addressLine1' => 'required|string|max:100',
        'addressLine2' => 'nullable|string|max:100',
        'city' => 'required|string|max:50',
        'state' => 'required|string|max:50',
        'postalCode' => 'required|string|max:20',
        'country' => 'required|string|max:50',
        'phoneNumber' => 'required|string|max:20',
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
        $this->belongToCategory=$this->my_product->category->name;
        // dd($this->belongToCategory);
        $this->balanceGems = $this->totalAvailableGems - $this->gems;
        $this->totalPriceOfProduct = $this->gems+$this->shipping_charge;

      
    }
    
    
    

    
    public function completeRedemption()
    {
        $this->validate();
        
        $user = Products::find($this->product->id);
        
        if ($user->points >= $this->totalPoints) {
            // Process redemption
            // Create redemption record with address details
            // Deduct points from user
            
            // Example redemption logic (you'd need to implement this according to your models)
            // $redemption = Redemption::create([
            //     'user_id' => $user->id,
            //     'product_id' => $this->product->id,
            //     'quantity' => $this->quantity,
            //     'points_used' => $this->totalPoints,
            //     'status' => 'pending',
            //     'shipping_name' => $this->fullName,
            //     'shipping_address_1' => $this->addressLine1,
            //     'shipping_address_2' => $this->addressLine2,
            //     'shipping_city' => $this->city,
            //     'shipping_state' => $this->state,
            //     'shipping_postal_code' => $this->postalCode,
            //     'shipping_country' => $this->country,
            //     'shipping_phone' => $this->phoneNumber,
            // ]);
            
            // $user->update([
            //     'points' => $user->points - $this->totalPoints
            // ]);
            
            // Reset form
            $this->showAddressForm = false;
            
            session()->flash('message', 'Product successfully redeemed! Your item will be shipped to the address provided.');
        } else {
            session()->flash('error', 'You don\'t have enough points to redeem this product.');
        }
    }
    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.check-out-page');
    }
}

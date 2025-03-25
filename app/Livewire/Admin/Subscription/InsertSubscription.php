<?php

namespace App\Livewire\Admin\Subscription;

use Illuminate\Support\Str;
use App\Models\SubscriptionPlan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Subscription Plans')]
class InsertSubscription extends Component
{
    use WithPagination;

    public $name, $description, $price, $duration_in_days, $is_active = true, $features;
    public $updateMode = false;
    public $planId;
    public $showModal = false;
    public $search = '';
    public $filter_active = '';

    protected $plans;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'duration_in_days' => 'required|integer|min:1',
        'is_active' => 'boolean',
        'features' => 'nullable'
    ];

    public function render()
    {
        $query = SubscriptionPlan::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if ($this->filter_active !== '') {
            $query->where('is_active', $this->filter_active);
        }

        $this->plans = $query->paginate(9);

        // Log all plans' features for debugging
        \Log::info('Rendering Plans', [
            'plans' => $this->plans->pluck('features')->toArray()
        ]);

        return view('livewire.admin.subscription.insert-subscription', [
            'plans' => $this->plans
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    public function clearFilter()
    {
        $this->search = '';
        $this->filter_active = '';
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->duration_in_days = '';
        $this->is_active = true;
        $this->features = '';
        $this->updateMode = false;
        $this->planId = null;
    }

    public function save()
    {
        $this->validate();

        $featuresArray = $this->features ? array_filter(explode(',', trim($this->features))) : [];

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'duration_in_days' => $this->duration_in_days,
            'is_active' => $this->is_active,
            'features' => json_encode($featuresArray)
        ];

        if ($this->updateMode && $this->planId) {
            SubscriptionPlan::find($this->planId)->update($data);
            session()->flash('message', 'Subscription Plan Updated Successfully.');
        } else {
            SubscriptionPlan::create($data);
            session()->flash('message', 'Subscription Plan Created Successfully.');
        }

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        
        $this->planId = $id;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->price = $plan->price;
        $this->duration_in_days = $plan->duration_in_days;
        $this->is_active = $plan->is_active;
        $this->features = is_array($plan->features) && !empty($plan->features) ? implode(', ', $plan->features) : '';

        $this->updateMode = true;
        $this->showModal = true;

        // Log to confirm features are loaded
        \Log::info('Edit Mode Features', [
            'id' => $id,
            'features' => $plan->features,
            'display_value' => $this->features
        ]);
    }

    public function toggleStatus($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->update(['is_active' => !$plan->is_active]);
        session()->flash('message', 'Status Updated Successfully.');
    }

    public function delete($id)
    {
        $plan = SubscriptionPlan::find($id);
        if ($plan->subscriptions()->count() > 0) {
            session()->flash('error', 'Cannot delete plan with active subscriptions.');
            return;
        }
        $plan->delete();
        session()->flash('message', 'Subscription Plan Deleted Successfully.');
    }
}
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

    public $name, $description, $price, $duration_in_days;
    public $is_active = true;
    public array $features = [];
    public $updateMode = false;
    public $planId;
    public $showModal = false;
    public $search = '';
    public $filter_active = '';
    public string $featuresInput = '';

    protected $plans;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'duration_in_days' => 'required|integer|min:1',
        'is_active' => 'boolean',
        'featuresInput' => 'nullable|string'
    ];

    public function mount()
    {
        $this->features = [];
    }

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
        $this->resetPage(); // Reset pagination when clearing filters
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->duration_in_days = '';
        $this->is_active = true;
        $this->features = [];
        $this->featuresInput = '';
        $this->updateMode = false;
        $this->planId = null;
    }

    public function save()
    {
        $this->validate();

        $featuresArray = $this->featuresInput
            ? array_filter(array_map('trim', explode(',', $this->featuresInput)), fn($value) => !empty($value))
            : [];

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
            SubscriptionPlan::findOrFail($this->planId)->update($data);
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
        $this->description = $plan->description ?? '';
        $this->price = $plan->price;
        $this->duration_in_days = $plan->duration_in_days;
        $this->is_active = $plan->is_active;

        $decodedFeatures = json_decode($plan->features, true);
        $this->features = is_array($decodedFeatures) && !empty($decodedFeatures) ? $decodedFeatures : [];
        $this->featuresInput = implode(', ', $this->features);

        $this->updateMode = true;
        $this->showModal = true;
    }

    public function toggleStatus($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->update(['is_active' => !$plan->is_active]);
        session()->flash('message', 'Status Updated Successfully.');
    }

    public function delete($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        if ($plan->subscriptions()->count() > 0) {
            session()->flash('error', 'Cannot delete plan with active subscriptions.');
            return;
        }
        $plan->delete();
        session()->flash('message', 'Subscription Plan Deleted Successfully.');
    }
}
<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Enquiry;

class ContactUs extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $message;
    public $recaptcha;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'nullable|email',
        'mobile' => 'required|digits:10',
        'message' => 'nullable|min:10',
        'recaptcha' => 'required|captcha'
    ];

    protected $messages = [
        'name.required' => 'Please enter your name',
        'mobile.required' => 'Please enter your mobile number',
        'mobile.digits' => 'Mobile number must be 10 digits',
        'recaptcha.required' => 'Please complete the reCAPTCHA verification',
    ];

    public function submit()
    {
        $this->validate();

        try {
            Enquiry::create([
                'name' => $this->name,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'message' => $this->message,
            ]);

            $this->reset(['name', 'email', 'mobile', 'message']);
            $this->dispatch('success', 'Thank you for contacting us! We will get back to you soon.');

        } catch (\Exception $e) {
            $this->dispatch('error', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.public.contact-us')
            ->layout('components.layouts.app', ['title' => 'Contact Us']);
    }
}
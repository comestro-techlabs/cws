<?php

namespace App\Livewire\Public;

use Livewire\Component;

class AboutUs extends Component
{

    public $milestones = [
        [
            'year' => '2014',
            'title' => 'The Beginning',
            'achievements' => [
                'Started "Code with Sadiq" with just 2 students in a personal room.',
                'Used a 14-inch monitor to teach coding basics and fundamentals.'
            ]
        ],
        [
            'year' => '2016',
            'title' => 'Growth and Expansion',
            'achievements' => [
                'Officially adopted the name "Code with Sadiq."',
                'Opened a new branch in Madhubani, Purnea, Bihar.',
                'Started training BCA, B.Tech, and M.Tech students.'
            ]
        ],
        // Add other milestones similarly
    ];

    public $faqs = [
        [
            'id' => 'faq1',
            'question' => 'What services does Learn Syntax provide?',
            'answer' => 'Learn Syntax provides comprehensive training in programming languages, frameworks, and coding best practices to help students and professionals excel in their careers.',
            'isOpen' => false
        ],
        [
            'id' => 'faq2',
            'question' => 'How can I enroll in a course?',
            'answer' => 'You can enroll in our courses by visiting the Learn Syntax website, selecting a course, and following the instructions for registration.',
            'isOpen' => false
        ],
        [
            'id' => 'faq3',
            'question' => 'Do you offer placement assistance?',
            'answer' => 'Yes, LearnSyntax offers dedicated placement assistance to ensure our students secure jobs in top companies.',
            'isOpen' => false
        ]
    ];

    public function toggleFaq($id)
    {
        foreach ($this->faqs as $key => $faq) {
            if ($faq['id'] === $id) {
                $this->faqs[$key]['isOpen'] = !$this->faqs[$key]['isOpen'];
            }
        }
    }

    public function render()
    {
        return view('livewire.public.about-us')
            ->layout('components.layouts.app');
    }
}
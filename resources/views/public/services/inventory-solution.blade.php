@extends('public.layout')


@section('title')
    Inventory Solutions
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
<livewire:page-heading title="Upgrade Your Business" description="Streamline your inventory management with our tailored solutions." image="about-header.png"/>
 <!-- Services Section -->
 <section class="py-12">
    <div class="container mx-auto">
        <h3 class="text-3xl font-bold text-center mb-10">Our Services</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Real-Time Tracking</h4>
                <p>Monitor your inventory in real-time to ensure you never run out of stock. Our solution provides live updates on stock levels across multiple locations.</p>
            </div>
            <!-- Service 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Automated Reordering</h4>
                <p>Set thresholds and automate reordering processes for efficiency. Our system will trigger purchase orders automatically when inventory drops below preset levels.</p>
            </div>
            <!-- Service 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Custom Reports</h4>
                <p>Generate custom reports to analyze your inventory trends and performance. Get insights into sales patterns, stock turnover, and more.</p>
            </div>
            <!-- Service 4 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Multi-Channel Management</h4>
                <p>Manage inventory across various sales channels like e-commerce, retail stores, and warehouses from a single platform.</p>
            </div>
            <!-- Service 5 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Warehouse Optimization</h4>
                <p>Optimize your warehouse operations with layout recommendations, picking strategies, and storage solutions tailored to your business needs.</p>
            </div>
            <!-- Service 6 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-2xl font-bold mb-4">Supplier Integration</h4>
                <p>Seamlessly integrate with your suppliers for better coordination, reducing lead times and ensuring timely restocking.</p>
            </div>
        </div>
    </div>
</section>

<!-- Work Process Section -->
<section class="bg-gray-200 py-12">
    <div class="container mx-auto">
        <h3 class="text-3xl font-bold text-center mb-10">Our Work Process</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4">1. Consultation & Analysis</h4>
                <p>We begin by understanding your business needs and current inventory challenges. Our team conducts a thorough analysis to identify areas for improvement.</p>
            </div>
            <!-- Step 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4">2. Custom Solution Design</h4>
                <p>Based on our analysis, we design a customized inventory solution tailored to your business. This includes software configuration, process mapping, and hardware integration if needed.</p>
            </div>
            <!-- Step 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4">3. Implementation</h4>
                <p>Our team will implement the solution, ensuring a seamless transition. We work closely with your team to minimize disruptions and provide training for smooth adoption.</p>
            </div>
            <!-- Step 4 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4">4. Testing & Optimization</h4>
                <p>After implementation, we rigorously test the system to ensure it meets your business requirements. We fine-tune the solution to optimize performance and efficiency.</p>
            </div>
            <!-- Step 5 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4">5. Ongoing Support</h4>
                <p>We provide ongoing support and maintenance to ensure your inventory system continues to operate smoothly. Our team is available for troubleshooting, updates, and further enhancements.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-blue-900 text-white py-12">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-4">Ready to optimize your inventory management?</h3>
        <p class="mb-6">Contact us today to learn more about our Inventory Solutions.</p>
        <a href="{{route('public.contact')}}" class="bg-white text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-gray-200">Get Started</a>
    </div>
</section>
@endsection
</div>
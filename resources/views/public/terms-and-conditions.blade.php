@extends('public.layout')

@section('title')
    Terms & Conditions
@endsection

@section('content')
    <br>
    <br>
    <div class="container mx-auto px-4 py-12">

        {{-- container fo rterms and conditions goes here --}}
        <div class="p-6">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Terms and Conditions</h1>

            <!-- Introduction -->
            <p class="text-gray-700 mb-6">
                Welcome to <span class="text-orange-500 font-bold">Com</span><span
                    class="text-sky-500 font-bold">estro</span>! These terms and conditions outline the rules and regulations
                for the use
                of our website.
            </p>

            <!-- Section 1: General Terms -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">1. General Terms</h2>
            <p class="text-gray-600 mb-4">
                By accessing this website, we assume you accept these terms and conditions. Do not continue to use <span
                    class="text-orange-500 font-bold">Com</span><span class="text-sky-500 font-bold">estro</span> if you do
                not agree to all of the terms and conditions stated on this page.
            </p>

            <!-- Section 2: Cookies -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Cookies</h2>
            <p class="text-gray-600 mb-4">
                We employ the use of cookies. By accessing <span class="text-orange-500 font-bold">Com</span><span
                    class="text-sky-500 font-bold">estro</span>, you agreed to use cookies in agreement
                with our Privacy Policy.
            </p>

            <!-- Section 3: License -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">3. License</h2>
            <p class="text-gray-600 mb-4">
                Unless otherwise stated, <span class="text-orange-500 font-bold">Com</span><span
                    class="text-sky-500 font-bold">estro</span> and/or its licensors own the intellectual property rights
                for all material on the website. All intellectual property rights are reserved.
            </p>

            <!-- Section 4: User Comments -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">4. User Comments</h2>
            <p class="text-gray-600 mb-4">
                You warrant and represent that:
            <ul class="list-disc list-inside pl-6 mb-4">
                <li>You are entitled to post the Comments on our website.</li>
                <li>The Comments do not invade any intellectual property right.</li>
                <li>The Comments will not be used to solicit or promote business or custom.</li>
            </ul>
            </p>

            <!-- Section 5: Hyperlinking -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Hyperlinking to our Content</h2>
            <p class="text-gray-600 mb-4">
                The following organizations may link to our website without prior written approval:
            <ul class="list-disc list-inside pl-6 mb-4">
                <li>Government agencies;</li>
                <li>Search engines;</li>
                <li>News organizations;</li>
            </ul>
            </p>

        </div>

        {{-- refund and policy goes here --}}
        <div class="p-6">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Refund Policy</h1>

            <!-- Introduction -->
            <p class="text-gray-700 mb-6">
                Thank you for shopping with <a href="https://www.comestro.com" class="text-blue-500"><span
                        class="text-orange-500 font-bold">Com</span><span class="text-sky-500 font-bold">estro</span></a>.
                We hope you are happy with your purchase. However, if you are not completely satisfied, we're here to help.
            </p>

            <!-- Section 1: Returns -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Returns</h2>
            <p class="text-gray-600 mb-4">
                You have 30 days to return an item from the date you received it. To be eligible for a return, your item
                must be unused and in the same condition that you received it. Your item must be in the original packaging
                and accompanied by the receipt or proof of purchase.
            </p>

            <!-- Section 2: Refunds -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Refunds</h2>
            <p class="text-gray-600 mb-4">
                Once we receive your item, we will inspect it and notify you that we have received your returned item. If
                your return is approved, we will initiate a refund to your original method of payment. You will receive the
                credit within a certain number of days, depending on your card issuer's policies.
            </p>

            <!-- Section 3: Shipping Costs -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Shipping Costs</h2>
            <p class="text-gray-600 mb-4">
                You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are
                non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.
            </p>

            <!-- Section 4: Non-refundable Items -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Non-refundable Items</h2>
            <p class="text-gray-600 mb-4">
                Some items are exempt from being returned or refunded, such as:
            <ul class="list-disc list-inside pl-6 mb-4">
                <li>Gift cards</li>
                <li>Downloadable software products</li>
                <li>Health and personal care items</li>
            </ul>
            </p>

            <!-- Section 5: Contact Us -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Contact Us</h2>
            <p class="text-gray-600 mb-4">
                If you have any questions on how to return your item, please contact us at <a
                    href="mailto:support@comestro.com" class="text-blue-500 underline">support@comestro.com</a> or <span class="text-gray-600 mb-6 ">
                        call us at<a href="tel:+919546805580"
                            class="text-blue-500 underline ml-2">9546805580</a>
                    </span> visit our
                website at <a href="https://www.comestro.com" class="text-blue-500 underline">www.comestro.com</a>.
            </p>
            

        </div>
    </div>
@endsection

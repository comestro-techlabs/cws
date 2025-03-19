<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Redeemed Successfully</title>
</head>
<body style="font-family: 'Roboto', Arial, sans-serif; margin: 0; padding: 0; color: #202124; line-height: 1.5; background-color: #f5f5f5;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 5px rgba(0,0,0,0.05);">
        <!-- Accent Bar -->
        <div style="height: 6px; background: linear-gradient(to right,rgb(111, 57, 160),rgb(242, 243, 246));"></div>
        
        <!-- Logo Area -->
        <div style="text-align: center; padding: 30px 20px 20px;">
            <img src="{{ asset('images/logo.png') }}" alt="Learn Syntax Logo" style="max-width: 150px; height: auto;" />
        </div>
        
        <!-- Main Content -->
        <div style="padding: 0 30px 30px;">
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e8f0fe; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                    <span style="color: rgb(111, 57, 160)">🎁</span>
                </div>
                <h2 style="font-size: 20px; font-weight: 500; margin: 0; color:rgb(165, 121, 207);">Product Redeemed Successfully!</h2>
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 20px;">
                Dear {{ $user }},
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Thank you for your redemption. We're excited to confirm that your product has been successfully redeemed and your order has been placed.
            </p>
            
            <!-- Product Details -->
            <div style="background-color: #f9f9fd; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
                <h3 style="font-size: 16px; font-weight: 500; margin-top: 0; margin-bottom: 15px; color: rgb(111, 57, 160);">Product Details:</h3>
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Product Name:</span> {{ $productDetail->name ?? 'Product' }}
                </p>
                @if(isset($productDetail->description))
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Description:</span> {{ $productDetail->description }}
                </p>
                @endif
            </div>
            
            <!-- Shipping Details -->
            <div style="background-color: #f9f9fd; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
                <h3 style="font-size: 16px; font-weight: 500; margin-top: 0; margin-bottom: 15px; color: rgb(111, 57, 160);">Shipping Details:</h3>
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Name:</span> {{ $shippingDetails->first_name }} {{ $shippingDetails->last_name }}
                </p>
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Address:</span><br>
                    {{ $shippingDetails->address_line }}<br>
                    @if(isset($shippingDetails->address_line))
                    {{ $shippingDetails->address_line }}<br>
                    @endif
                    {{ $shippingDetails->city }}, {{ $shippingDetails->state }} {{ $shippingDetails->postal_code }}<br>
                    {{ $shippingDetails->country }}
                </p>
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Phone:</span> {{ $shippingDetails->phone ?? 'Not provided' }}
                </p>
                <p style="font-size: 14px; color: #5f6368; margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #202124;">Email:</span> {{ $shippingDetails->email }}
                </p>
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                We're preparing your order for shipment and will notify you once it's on its way.
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 15px;">
                If you have any questions about your order, please contact our customer support team.
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Thank you for choosing Learn Syntax!
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 10px;">
                Best regards,<br>The Learn Syntax Team
            </p>
        </div>
        
        <!-- Footer -->
        <div style="padding: 20px 30px; background-color: #fafafa; border-top: 1px solid #f0f0f0; text-align: center;">
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                © {{ date('Y') }} Learn Syntax. All rights reserved.
            </p>
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                Gandhi Nagar, Madhubani, Purnia, Bihar 854301
            </p>
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                Need help? <a href="mailto:info@Learnsyntax.com" style="color: rgb(111, 57, 160); text-decoration: none;">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
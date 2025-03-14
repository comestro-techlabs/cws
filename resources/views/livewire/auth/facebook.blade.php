<div>
    @if($errorMessage)
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
    @endif

    <a href="{{ route('facebook.redirect') }}"
        class="w-full bg-white text-gray-700 font-semibold py-3 px-6 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center gap-2">
        <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="#1877F2" d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.068 4.388 22.91 10.125 24V15.563H7.078V12.073H10.125V9.413C10.125 6.387 11.916 4.716 14.657 4.716C15.97 4.716 17.344 4.951 17.344 4.951V7.875H15.83C14.339 7.875 13.875 8.801 13.875 9.749V12.073H17.203L16.671 15.563H13.875V24C19.612 22.91 24 18.068 24 12.073Z"/>
            <path fill="white" d="M16.671 15.563L17.203 12.073H13.875V9.749C13.875 8.801 14.339 7.875 15.83 7.875H17.344V4.951C17.344 4.951 15.97 4.716 14.657 4.716C11.916 4.716 10.125 6.387 10.125 9.413V12.073H7.078V15.563H10.125V24C12.488 24.398 14.512 24.398 16.875 24V15.563H16.671Z"/>
        </svg>
        <span>Sign in with Facebook</span>
</a>
</div>
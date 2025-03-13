<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white pt-8 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Gems Overview Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">My Gems</h2>
                        <p class="text-sm text-gray-600 mt-1">Track your rewards and transactions</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-indigo-600 p-4 rounded-2xl">
                        <div class="text-center">
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 8l10 6 10-6-10-6zM2 15l10 6 10-6M2 19l10 6 10-6"/>
                                </svg>
                                <span class="text-2xl font-bold text-white">{{ $totalGems }}</span>
                            </div>
                            <p class="text-xs text-purple-100 mt-1">Available Gems</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                    <div class="bg-purple-50 rounded-lg p-4">
                        <p class="text-sm text-purple-600 font-medium">Earned This Month</p>
                        <p class="text-2xl font-bold text-purple-700">+{{ $earnedThisMonth }}</p>
                    </div>
                    <div class="bg-orange-50 rounded-lg p-4">
                        <p class="text-sm text-orange-600 font-medium">Spent This Month</p>
                        <p class="text-2xl font-bold text-orange-700">-{{ $spentThisMonth }}</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <p class="text-sm text-green-600 font-medium">Lifetime Earned</p>
                        <p class="text-2xl font-bold text-green-700">{{ $lifetimeEarned }}</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-blue-600 font-medium">Expiring Soon</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $expiringSoon }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Transaction History</h3>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($transactions as $transaction)
                    <div class="p-4 sm:p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div @class([
                                    'w-10 h-10 rounded-full flex items-center justify-center',
                                    'bg-green-100' => $transaction->type === 'earned',
                                    'bg-red-100' => $transaction->type === 'spent'
                                ])>
                                    <svg class="w-5 h-5" @class([
                                        'text-green-600' => $transaction->type === 'earned',
                                        'text-red-600' => $transaction->type === 'spent'
                                    ]) viewBox="0 0 24 24" fill="currentColor">
                                        @if($transaction->type === 'earned')
                                            <path d="M12 2L2 8l10 6 10-6-10-6zM2 15l10 6 10-6M2 19l10 6 10-6"/>
                                        @else
                                            <path d="M12 2L2 8l10 6 10-6-10-6zM2 15l10 6 10-6"/>
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $transaction->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span @class([
                                    'text-sm font-semibold',
                                    'text-green-600' => $transaction->type === 'earned',
                                    'text-red-600' => $transaction->type === 'spent'
                                ])>
                                    {{ $transaction->type === 'earned' ? '+' : '-' }}{{ $transaction->amount }}
                                </span>
                                @if($transaction->expires_at)
                                    <p class="text-xs text-gray-500">Expires: {{ $transaction->expires_at->format('M d, Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-gray-900 font-medium">No transactions yet</h3>
                        <p class="text-gray-500 text-sm mt-1">Start earning gems by completing courses and assignments!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

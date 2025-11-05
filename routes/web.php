<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\PorterController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\AnnouncementController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\PaymentMethodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

// Broadcasting Routes
Broadcast::routes(['middleware' => ['web', 'auth']]);

// Fallback unread count endpoint for authenticated users (works even if not verified)
Route::middleware(['auth'])->get('/messages/unread-count', function () {
    $count = \App\Models\Message::where('user_id', Auth::id())
        ->whereNull('read_at')
        ->count();
    return response()->json(['count' => $count]);
});

// Frontend Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

require __DIR__.'/auth.php';

// Admin profile routes
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//user Routes
Route::middleware(['auth', 'verified', 'userMiddleware'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        
        // Booking Routes
        Route::get('bookings', [BookingController::class, 'index'])->name('user.bookings.index');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('user.bookings.create');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('user.bookings.create');
        Route::post('bookings', [BookingController::class, 'store'])->name('user.bookings.store');
        Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('user.bookings.show');
        Route::get('bookings/{booking}/payment', [BookingController::class, 'payment'])->name('user.bookings.payment');
        Route::post('bookings/{booking}/process-payment', [BookingController::class, 'processPayment'])->name('user.bookings.process-payment');
        Route::post('bookings/{booking}/verify-payment', [BookingController::class, 'verifyPayment'])->name('user.bookings.verify-payment');
        Route::patch('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('user.bookings.cancel');

        // User Profile Routes
        Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile.show');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

        // Review Routes
        Route::get('/reviews', [ReviewController::class, 'index'])->name('user.reviews.index');
        Route::get('/reviews/create/{booking}', [ReviewController::class, 'create'])->name('user.reviews.create');
        Route::post('/reviews/{booking}', [ReviewController::class, 'store'])->name('user.reviews.store');
        Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('user.reviews.show');
        Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('user.reviews.edit');
        Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('user.reviews.update');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('user.reviews.destroy');

        // Message Routes (require email verification)
        Route::get('/messages', [MessageController::class, 'index'])->name('user.messages.index');
        Route::get('/messages/create', [MessageController::class, 'create'])->name('user.messages.create');
        Route::post('/messages', [MessageController::class, 'store'])->name('user.messages.store');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('user.messages.show');
        Route::post('/messages/{message}/close', [MessageController::class, 'close'])->name('user.messages.close');
        Route::get('/messages/attachments/{attachment}/download', [MessageController::class, 'downloadAttachment'])->name('user.messages.attachments.download');

        // Announcement Routes
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('user.announcements.index');
        Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('user.announcements.show');
});

// Provide unread count to authenticated users without requiring email verification
Route::middleware(['auth','userMiddleware'])->get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('user.messages.unread-count');

//admin Routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/reports/index', [ReportController::class, 'index'])->name('reports.index');
        
        // System Settings Routes
        Route::get('/settings', [App\Http\Controllers\Admin\SystemSettingsController::class, 'index'])->name('settings.index');
        Route::get('/settings/{setting}', [App\Http\Controllers\Admin\SystemSettingsController::class, 'show'])->name('settings.show');
        Route::get('/settings/{setting}/edit', [App\Http\Controllers\Admin\SystemSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings/{setting}', [App\Http\Controllers\Admin\SystemSettingsController::class, 'update'])->name('settings.update');
        Route::delete('/settings/{setting}', [App\Http\Controllers\Admin\SystemSettingsController::class, 'destroy'])->name('settings.destroy');
        Route::post('/settings/bulk-update', [App\Http\Controllers\Admin\SystemSettingsController::class, 'bulkUpdate'])->name('settings.bulk-update');
        
        // Payment Management Routes
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/export', [PaymentController::class, 'export'])->name('payments.export');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
        Route::patch('/payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
        Route::patch('/payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
        Route::post('/payments/{payment}/flag', [PaymentController::class, 'flag'])->name('payments.flag');
        Route::get('/payments/{payment}/audit-trail', [PaymentController::class, 'auditTrail'])->name('payments.audit-trail');
        
        // User Management Routes
        Route::get('/manage-user/index', [ManageUserController::class, 'index'])->name('manage-user.index');
        Route::get('/manage-user/{user}', [ManageUserController::class, 'show'])->name('manage-user.show');
        Route::patch('/manage-user/{user}/approve', [ManageUserController::class, 'approve'])->name('manage-user.approve');
        Route::patch('/manage-user/{user}/reject', [ManageUserController::class, 'reject'])->name('manage-user.reject');
        Route::patch('/manage-user/{user}/pending', [ManageUserController::class, 'pending'])->name('manage-user.pending');
        Route::delete('/manage-user/{user}', [ManageUserController::class, 'destroy'])->name('manage-user.destroy');
        
        // Booking Management Routes
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::get('/bookings/{booking}/edit', [AdminBookingController::class, 'edit'])->name('bookings.edit');
        Route::patch('/bookings/{booking}/update', [AdminBookingController::class, 'update'])->name('bookings.update');
        Route::patch('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::patch('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
        Route::patch('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::patch('/bookings/{booking}/verify-payment', [AdminBookingController::class, 'verifyPayment'])->name('bookings.verify-payment');
        Route::patch('/bookings/{booking}/reject-payment', [AdminBookingController::class, 'rejectPayment'])->name('bookings.reject-payment');
        Route::patch('/bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');



        // Review Management Routes
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
        Route::patch('/reviews/{review}/verify', [AdminReviewController::class, 'verify'])->name('reviews.verify');
        Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
        Route::post('/reviews/{review}/hide', [AdminReviewController::class, 'hide'])->name('reviews.hide');
        Route::post('/reviews/{review}/publish', [AdminReviewController::class, 'publish'])->name('reviews.publish');
        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

        // Message Management Routes
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/compose', [AdminMessageController::class, 'compose'])->name('messages.compose');
        Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/unread-count', [AdminMessageController::class, 'unreadCount'])->name('messages.unread-count');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::get('/messages/{message}/preview', [AdminMessageController::class, 'preview'])->name('messages.preview');
        Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
        Route::post('/messages/{message}/close', [AdminMessageController::class, 'close'])->name('messages.close');
        Route::post('/messages/{message}/quick-reply', [AdminMessageController::class, 'quickReply'])->name('messages.quick-reply');
        Route::post('/messages/bulk-action', [AdminMessageController::class, 'bulkAction'])->name('messages.bulk-action');
        Route::get('/messages/attachments/{attachment}/download', [AdminMessageController::class, 'downloadAttachment'])->name('messages.attachments.download');
        
        // Quick Action Routes
        Route::post('/messages/{message}/toggle-importance', [AdminMessageController::class, 'toggleImportance'])->name('messages.toggle-importance');
        Route::post('/messages/{message}/archive', [AdminMessageController::class, 'archive'])->name('messages.archive');
        Route::post('/messages/{message}/unarchive', [AdminMessageController::class, 'unarchive'])->name('messages.unarchive');
        Route::post('/messages/{message}/forward', [AdminMessageController::class, 'forward'])->name('messages.forward');

        // Announcement Management Routes
        Route::get('/announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}', [AdminAnnouncementController::class, 'show'])->name('announcements.show');
        Route::get('/announcements/{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::patch('/announcements/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // Payment Method Management
        Route::resource('payment-methods', PaymentMethodController::class)->except(['show', 'destroy']);
        Route::patch('payment-methods/{paymentMethod}/toggle-status', [PaymentMethodController::class, 'toggleStatus'])
            ->name('payment-methods.toggle-status');
        Route::post('payment-methods/update-priority', [PaymentMethodController::class, 'updatePriority'])
            ->name('payment-methods.update-priority');

        // Guide Management Routes
        Route::resource('guides', GuideController::class);
        Route::patch('guides/{guide}/toggle-status', [GuideController::class, 'toggleStatus'])
            ->name('guides.toggle-status');

        // Porter Management Routes
        Route::resource('porters', PorterController::class);
        Route::patch('porters/{porter}/toggle-status', [PorterController::class, 'toggleStatus'])
            ->name('porters.toggle-status');
});

// API Routes for AJAX requests
Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::get('/admins', [App\Http\Controllers\Api\AdminController::class, 'index']);
    Route::get('/messages/since/{messageId}', function ($messageId) {
        $conversationId = request('conversation_id');
        $messages = \App\Models\Message::where('conversation_id', $conversationId)
                                      ->where('id', '>', $messageId)
                                      ->with(['sender', 'replyToMessage.sender'])
                                      ->orderBy('created_at', 'asc')
                                      ->get();
        
        return response()->json(['messages' => $messages]);
    });
});

// Chat Routes (accessible to both users and admins)
Route::middleware(['auth'])->prefix('chat')->name('chat.')->group(function () {
    Route::get('/', function () {
        return view('chat.index');
    })->name('index');
    Route::get('/conversations', [App\Http\Controllers\ChatController::class, 'getConversations'])->name('conversations');
    Route::get('/conversations/{conversation}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('messages');
    Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('send-message');
    Route::post('/conversations/start', [App\Http\Controllers\ChatController::class, 'startConversation'])->name('start-conversation');
    Route::post('/typing', [App\Http\Controllers\ChatController::class, 'typing'])->name('typing');
    Route::post('/messages/{message}/reactions', [App\Http\Controllers\ChatController::class, 'addReaction'])->name('add-reaction');
    Route::delete('/messages/{message}/reactions', [App\Http\Controllers\ChatController::class, 'removeReaction'])->name('remove-reaction');
});
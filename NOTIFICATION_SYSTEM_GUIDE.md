# Complete Notification System Guide

## Overview
A fully functional, production-ready notification system with real-time updates, clickable notifications, and read/unread tracking.

## Features Implemented

### 1. **Clickable Notifications**
- Notifications now store `action_url` field
- Clicking a notification redirects to the related resource
- Automatic mark-as-read on click
- Example: "New borrow request from John for Laptop" → clicks → redirects to `/borrowings`

### 2. **Mark As Read Functionality**
- Individual notifications can be marked as read
- `markAsRead()` method on Notification model
- Updates `is_read` and `read_at` fields
- Badge count decreases immediately

### 3. **Mark All As Read**
- Single button to mark all unread notifications as read
- Available in dropdown and notification detail page
- AJAX endpoint at `/api/notifications/unread-count`

### 4. **Real-Time Badge Counter**
- Polls unread count every 15 seconds
- Updates badge without page refresh
- Endpoint: `GET /api/notifications/unread-count`
- Falls back gracefully if network unavailable

### 5. **Notification Types with Icons & Colors**
```
borrow_request        → 📦 fa-box-open (primary)
borrow_approved       → ✅ fa-check-circle (success)
borrow_rejected       → ❌ fa-times-circle (danger)
reservation           → 📅 fa-calendar (info)
incident              → ⚠️  fa-exclamation-triangle (warning)
equipment_returned    → ↩️  fa-undo (success)
bug_report            → 🐞 fa-bug (danger)
message               → 💬 fa-comment (secondary)
```

### 6. **Improved Notification Dropdown**
- Shows notification icon, title, and message
- Displays "time ago" (2 minutes ago, 1 hour ago, etc.)
- Unread notifications highlighted
- Hover effects
- Quick "Mark All As Read" button
- Scrollable list
- View All link to detail page

### 7. **Notification Detail/History Page**
- Complete list of all notifications
- Filtering by read status (all, unread, read)
- Filtering by type (borrow_request, incident, etc.)
- Search functionality
- Pagination (20 per page)
- Statistics dashboard (unread count, total, read)

### 8. **Database Structure**
New columns added to `notifications` table:
```
- action_url: varchar (stores redirect URL)
- reference_id: integer (stores reference entity ID)
- reference_type: varchar (stores reference entity type)
- title: varchar (notification title)
- icon: varchar (icon class, default: fa-info-circle)
- read_at: timestamp (when notification was read)
```

### 9. **Security**
- Users only see their own notifications
- Proper authorization checks
- CSRF token validation on all forms
- Route model binding with authorization

### 10. **Notification Creation Examples**
When creating a notification, include action URL:
```php
Notification::create([
    'user_id' => $admin->id,
    'title' => 'New Borrow Request',
    'message' => 'John requested to borrow Laptop',
    'type' => 'borrow_request',
    'reference_id' => $borrowRequest->id,
    'reference_type' => 'BorrowRequest',
    'action_url' => route('borrowings.index', ['view' => 'pending']),
]);
```

## Routes

### Public Routes (All Authenticated Users)
- `GET  /notifications` - List all notifications (paginated)
- `GET  /notifications/{notification}` - View & redirect
- `POST /notifications/{notification}/read` - Mark as read
- `POST /notifications/read-all` - Mark all as read
- `DELETE /notifications/{notification}` - Delete notification
- `DELETE /notifications/read/all` - Delete all read notifications

### API Routes (AJAX)
- `GET /api/notifications/unread-count` - Get unread count (JSON)
- `GET /api/notifications/recent/{limit?}` - Get recent notifications (JSON, max 10)

## Files Modified

### Controllers
- `app/Http/Controllers/NotificationController.php` - Full rewrite with new methods
- `app/Http/Controllers/BorrowRequestController.php` - Updated notification calls with action_url

### Models
- `app/Models/Notification.php` - Added scopes, methods, attributes
- `app/Models/User.php` - Already had notifications relationship

### Views
- `resources/views/layouts/dashboard.blade.php` - Updated dropdown, added JavaScript
- `resources/views/notifications/list.blade.php` - Already exists, works with new system

### Routes
- `routes/web.php` - Added new notification routes

### Database
- `database/migrations/2026_06_04_add_action_url_to_notifications.php` - Migration to add new columns

## JavaScript Functions (Global)

### `markAsRead(notificationId, actionUrl)`
Mark a notification as read and optionally redirect
```javascript
markAsRead(15, '/borrowings');
```

### `markAllAsRead()`
Mark all unread notifications as read
```javascript
markAllAsRead();
```

### `updateNotificationBadge()`
Fetch and update the unread count badge
```javascript
updateNotificationBadge();
```

## How It Works

### 1. Creating a Notification
When a student submits a borrow request:
```php
$borrowRequest = BorrowRequest::create([...]);

$this->notifyStaff(
    'New borrow request from John for Laptop',
    'borrow_request',
    $borrowRequest->id,
    'BorrowRequest',
    route('borrowings.index', ['view' => 'pending']),
    'New Borrow Request'
);
```

### 2. Clicking a Notification
User sees in dropdown:
- "📦 New Borrow Request"
- "New borrow request from John for Laptop"
- "2 minutes ago"

User clicks → `markAsRead(15, '/borrowings')` → Redirects to `/borrowings`

### 3. Badge Updates
Every 15 seconds:
- Fetch `/api/notifications/unread-count`
- Update badge number
- If 0 unread, hide badge

## Usage Examples

### For Developers

**1. Send notification to staff when borrow request submitted:**
```php
$borrowRequest = BorrowRequest::create([...]);

$this->notifyStaff(
    'New borrow request from ' . Auth::user()->name . ' for ' . $equipment->name,
    'borrow_request',
    $borrowRequest->id,
    'BorrowRequest',
    route('borrowings.index', ['view' => 'pending']),
    'New Borrow Request'
);
```

**2. Send notification to student when request approved:**
```php
$this->notifyUser(
    $borrowRequest->student_id,
    'Your borrow request for ' . $borrowRequest->equipment->name . ' has been approved',
    'borrow_approved',
    $borrowRequest->id,
    'BorrowRequest',
    route('borrowings.index', ['view' => 'approved']),
    'Request Approved'
);
```

**3. Get all unread notifications:**
```php
$unread = Notification::where('user_id', auth()->id())->unread()->get();
```

**4. Mark all as read:**
```php
Notification::where('user_id', auth()->id())->unread()->markAsRead();
```

## Testing Checklist

- [ ] Create a borrow request as student
- [ ] Admin receives notification in dropdown
- [ ] Badge shows "1" unread
- [ ] Click notification → redirects to `/borrowings`
- [ ] Badge updates to "0"
- [ ] Notification marked as read (no "New" badge)
- [ ] "Mark All As Read" button works
- [ ] Go to `/notifications` → see all notifications
- [ ] Filter by "Unread" → only unread shown
- [ ] Search for keyword → results filter
- [ ] Wait 15 seconds → badge updates automatically
- [ ] Check real-time polling by refreshing page

## Performance Considerations

- Polls every 15 seconds (configurable in dashboard.blade.php)
- Only fetches unread count, not full notifications
- Uses efficient queries with proper indexing
- Pagination on detail page (20 per page)
- Lazy loading of recent notifications

## Future Enhancements

- WebSocket integration with Laravel Echo for true real-time
- Pushable notifications to mobile devices
- Email notifications for critical events
- Notification preferences/settings per user
- Notification grouping/threading
- Notification sounds/alerts
- Scheduled notification delivery

## Troubleshooting

### Badge not updating
- Check browser console for JavaScript errors
- Verify `/api/notifications/unread-count` endpoint works
- Clear browser cache and hard refresh

### Notification not marked as read
- Verify notification user_id matches Auth::id()
- Check database for `is_read` and `read_at` fields
- Run migration: `php artisan migrate`

### Redirect not working
- Verify `action_url` is stored in database
- Check that route exists
- Test URL directly in browser

### Notifications not showing
- Verify notifications are in database for Auth::id()
- Check dashboard.blade.php for `$globalNotifications` variable
- Clear view cache: `php artisan view:clear`

## Support

For issues or enhancements, check:
1. Database schema (run migration)
2. Browser console for JS errors
3. Laravel logs in `storage/logs/`
4. Verify routes: `php artisan route:list | grep notification`

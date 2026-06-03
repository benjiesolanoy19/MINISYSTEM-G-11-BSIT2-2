# NOTIFICATION SYSTEM - COMPLETE SETUP GUIDE

## ✅ WHAT'S BEEN DONE

All the following have been implemented and verified:

1. ✅ **Database Migration** - New columns added to `notifications` table:
   - `action_url` - Where to redirect when clicked
   - `reference_id` - Related entity ID
   - `reference_type` - Related entity type
   - `title` - Notification title
   - `icon` - Icon class
   - `read_at` - When marked as read

2. ✅ **Notification Model** (`app/Models/Notification.php`)
   - Updated with new attributes
   - Added `icon_class` and `color_class` accessors
   - Added `markAsRead()` method
   - Added scopes: `unread()`, `read()`, `recent()`

3. ✅ **Notification Controller** (`app/Http/Controllers/NotificationController.php`)
   - 8 new methods: `index`, `show`, `markAsRead`, `markAllAsRead`, `destroy`, `destroyRead`, `getUnreadCount`, `getRecent`

4. ✅ **Routes** (`routes/web.php`)
   - 8 new notification routes added
   - API endpoints for real-time updates

5. ✅ **Dashboard View** (`resources/views/layouts/dashboard.blade.php`)
   - Updated notification dropdown with action URLs
   - Added JavaScript for real-time polling
   - Dropdown now shows icons based on notification type

6. ✅ **BorrowRequestController** (`app/Http/Controllers/BorrowRequestController.php`)
   - Updated to pass `action_url` when creating notifications

---

## 🔧 HOW TO TEST

### Step 1: Refresh Your Browser
Clear browser cache completely:
- **Chrome**: Press `Ctrl + Shift + Delete` → Clear all data
- **Firefox**: Press `Ctrl + Shift + Delete` → Clear all
- **Edge**: Press `Ctrl + Shift + Delete` → Clear all data

### Step 2: Hard Refresh the Page
- Press `Ctrl + F5` (or `Cmd + Shift + R` on Mac)
- This clears Laravel view cache and reloads all JavaScript

### Step 3: Test the Notification System

#### Test A: Create a Borrow Request (as student)
1. Log in as a student
2. Go to "Borrow Equipment"
3. Select any equipment
4. Click "Request borrow"
5. Fill in the form and submit

#### Expected Result:
- An admin/staff user should see a new notification in the bell icon (top right)
- Badge count should increase
- Notification should show: "📦 New Borrow Request"

#### Test B: Click the Notification
1. Log in as admin
2. Look for red badge on bell icon
3. Click the bell icon to open dropdown
4. **Click on the notification**

#### Expected Results:
- ✅ Page redirects to `/borrowings`
- ✅ Notification marked as read (no "New" badge)
- ✅ Badge count decreases
- ✅ Unread notifications count updated

#### Test C: Mark All As Read
1. Log in as admin
2. Open notification dropdown (click bell)
3. Click "Mark all read" button
4. All notifications should have no "New" badge

#### Expected Results:
- ✅ All notifications marked as read
- ✅ Badge disappears
- ✅ Page may refresh

#### Test D: Real-Time Badge Update
1. Log in as admin
2. Keep notification dropdown open
3. Open second browser window
4. Log in as student and create a new borrow request
5. Go back to admin browser
6. Wait 15 seconds

#### Expected Results:
- ✅ Badge count increases automatically (no page refresh)
- ✅ New notification appears in dropdown

---

## ❌ IF SOMETHING DOESN'T WORK

### Issue 1: Badge not updating
**Solution:**
1. Open browser DevTools (`F12`)
2. Go to Console tab
3. Type: `updateNotificationBadge()`
4. Press Enter
5. Badge should update immediately

**If still not working:**
- Check Console for JavaScript errors
- Verify `/api/notifications/unread-count` endpoint exists:
  - Run: `php artisan route:list | grep unread-count`
  - Should see: `GET|HEAD api/notifications/unread-count`

### Issue 2: Clicking notification doesn't redirect
**Solution:**
1. Check browser Console
2. Look for any errors
3. Verify notification has `action_url` stored:
   - Open DevTools
   - Network tab
   - Click notification
   - Look for XHR/Fetch request
   - Should see `action_url` field

**If action_url is missing:**
- Delete old notifications: `php artisan tinker`
- Then: `Notification::truncate()`
- Create a new borrow request
- Check if new notification has `action_url`

### Issue 3: JavaScript functions not working
**Solution:**
1. Open Console (`F12`)
2. Type: `typeof markAsRead`
3. Should show: `"function"`
4. If shows `"undefined"`, reload page with `Ctrl + F5`

### Issue 4: Notification dropdown empty
**Solution:**
1. Verify you're logged in as admin
2. Check database has notifications:
   - `php artisan tinker`
   - `Notification::count()`
   - Should be > 0
3. Check auth user has notifications:
   - `Auth::user()->id`
   - `Notification::where('user_id', Auth::id())->count()`

---

## 📋 VERIFICATION CHECKLIST

Run these commands to verify everything is in place:

```bash
# Check database columns exist
php artisan tinker
DB::select('SHOW COLUMNS FROM notifications');

# Should show: action_url, reference_id, reference_type, title, icon, read_at

# Check routes registered
php artisan route:list | grep notifications

# Should show 8 notification routes

# Check controller methods
php artisan tinker
$ref = new ReflectionClass(\App\Http\Controllers\NotificationController::class);
foreach ($ref->getMethods() as $m) echo $m->getName() . "\n";

# Should show: index, show, markAsRead, markAllAsRead, destroy, destroyRead, getUnreadCount, getRecent

# Check model attributes
php artisan tinker
$n = new \App\Models\Notification();
echo "Fillable: " . json_encode($n->getFillable());
echo "Appends: " . json_encode($n->getAppends());
```

---

## 🚀 HOW IT WORKS (Step-by-Step)

### When a Student Creates a Borrow Request:

1. **Request submitted** → BorrowRequestController.php (line ~95)
2. **Notification created** with:
   - `user_id` = admin ID
   - `message` = "New borrow request from John for Laptop"
   - `type` = "borrow_request"
   - `action_url` = "/borrowings"
   - `is_read` = false

3. **Admin sees in dashboard:**
   - Bell icon with badge "1"
   - Dropdown shows: "📦 New Borrow Request" + message + "a few seconds ago"

4. **Admin clicks notification:**
   - JavaScript calls: `markAsRead(notification_id, '/borrowings')`
   - Notification marked as read in database
   - Page redirects to `/borrowings`
   - Badge count updates

5. **Every 15 seconds:**
   - JavaScript polls: `/api/notifications/unread-count`
   - Badge updates with new count
   - No page refresh needed

---

## 📂 FILES THAT WERE CHANGED

### Created:
- `database/migrations/2026_06_04_add_action_url_to_notifications.php`
- `NOTIFICATION_SYSTEM_GUIDE.md`

### Modified:
- `app/Models/Notification.php`
- `app/Http/Controllers/NotificationController.php`
- `app/Http/Controllers/BorrowRequestController.php`
- `routes/web.php`
- `resources/views/layouts/dashboard.blade.php`

---

## 🎯 QUICK FIXES

If something still doesn't work, try these:

### Cache is stale:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Database needs refresh:
```bash
php artisan migrate:refresh --step=1  # Rerun just notifications migration
```

### JavaScript not loading:
- Hard refresh: `Ctrl + F5`
- Check DevTools Console for errors
- Verify script section in dashboard.blade.php has `window.markAsRead = markAsRead;`

### Can't see notifications:
- Log in as admin
- Go to `/notifications` directly in URL
- Should see list of all notifications
- If empty, no one has created notifications yet

---

## ✅ SUCCESS INDICATORS

When working correctly, you should see:

1. ✅ Badge appears on bell icon when you have unread notifications
2. ✅ Badge count matches number of unread notifications
3. ✅ Clicking notification redirects to related page
4. ✅ Notification marked as read (no "New" badge)
5. ✅ Badge updates every 15 seconds without page refresh
6. ✅ "Mark all read" button works
7. ✅ Going to `/notifications` shows all notifications
8. ✅ Can filter by read/unread
9. ✅ Can search notifications
10. ✅ Timestamps show "2 minutes ago", "1 hour ago", etc.

---

## 💡 EXAMPLE: MANUAL TEST

Create a notification manually:

```bash
php artisan tinker

// Create notification
$admin = \App\Models\User::where('role', 'admin')->first();
\App\Models\Notification::create([
    'user_id' => $admin->id,
    'title' => 'Test Notification',
    'message' => 'This is a test',
    'type' => 'borrow_request',
    'action_url' => '/borrowings',
    'is_read' => false,
]);

exit
```

Now:
1. Log in as admin
2. Refresh page
3. Should see badge with count 1
4. Bell dropdown shows notification
5. Click it → redirects to `/borrowings`

---

## 📞 NEED HELP?

1. **Check the browser Console** (`F12`) for JavaScript errors
2. **Check Laravel logs** at `storage/logs/laravel.log`
3. **Verify database columns:**
   - `php artisan tinker`
   - `DB::select('SHOW COLUMNS FROM notifications');`
4. **Verify routes:**
   - `php artisan route:list | grep notification`
5. **Test controller directly:**
   - Visit `/api/notifications/unread-count` in browser
   - Should return JSON with unread count

---

## 🎉 SYSTEM IS NOW COMPLETE

All code has been:
- ✅ Written
- ✅ Syntax checked  
- ✅ Database migrated
- ✅ Routes registered
- ✅ Views updated
- ✅ JavaScript added
- ✅ Caches cleared

**Just refresh your browser and test!**

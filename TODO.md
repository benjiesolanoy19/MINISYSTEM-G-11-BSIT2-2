# TODO - Borrowing Approval System Redesign

## Step 0: Baseline verification
- [ ] Review current migrations for `borrow_requests` enum/status columns and new claim/return fields.
- [ ] Review `Equipment` model for `available_quantity` behavior.
- [ ] Review existing notification system (if already present) for reuse.

## Step 1: Database/model updates
- [x] Update `BorrowRequest` model `$fillable` and `$casts` for:
  - [x] `claimed_at`
  - [x] `returned_at`
  - [x] `remarks`
- [ ] Ensure enum values and required fields match spec.






## Step 2: Backend workflow correctness (core)
- [x] Update `BorrowRequestController`:
  - [x] Fix authorization (allow admin + staff to approve/reject).
  - [x] Add handlers for:
    - [x] `ready_to_claim` (approved -> ready_to_claim)
    - [x] `claimed` (ready_to_claim -> claimed) with physical-claim inventory deduction
    - [x] `returned` (claimed -> returned) with inventory restore
  - [x] Ensure inventory deduction happens ONLY on `claimed`.
  - [x] Prevent over-borrowing at claim time (quantity <= available_quantity).
  - [x] Set timestamps: `claimed_at`, `returned_at`.
  - [x] Store `remarks` when provided.




## Step 3: Routes
- [x] Update `routes/borrowings.php`:
  - [x] Add routes for ready-to-claim, mark-claimed, mark-returned.
  - [ ] Add student route for “My Borrow Requests”.



## Step 4: UI badges + responsive workflow
- [x] Update staff views (`pending-requests`, `all-borrows`) to:
  - [x] Replace tables with modern cards/rows.
  - [x] Add animated pill badges with hover effects:
    - [x] Pending (yellow)
    - [x] Approved (blue)
    - [x] Ready to Claim (purple)
    - [x] Claimed (green)
    - [x] Rejected (red)
    - [x] Returned (gray)
  - [x] Add action buttons for each status.
- [x] Add search/filter and empty/loading states.



## Step 5: Modals/confirmation + remarks
- [ ] Implement confirmation modal UX for approve/reject/ready-to-claim/claimed/returned.
- [ ] Ensure staff can add remarks/notes saved to `remarks`.

## Step 6: Student “My Borrow Requests” page
- [x] Create `resources/views/borrowings/my-borrow-requests.blade.php`:
  - [x] Status badges
  - [x] Equipment image/name
  - [x] Quantity
  - [x] Claim instructions when `ready_to_claim`
  - [x] Return schedule
  - [ ] Return/overdue indicators if available.


## Step 7: Notifications
- [ ] Trigger notifications on each state change.
- [ ] Ensure student can see approval/claim updates.

## Step 8: QA / manual test checklist
- [ ] End-to-end test:
  - [ ] Student submits request -> pending
  - [ ] Staff approve -> approved (no inventory deduction yet)
  - [ ] Staff ready-to-claim -> ready_to_claim
  - [ ] Staff mark claimed -> claimed (inventory deducted)
  - [ ] Staff mark returned -> returned (inventory restored)
- [ ] Attempt claim with insufficient quantity -> prevented.
- [ ] Verify pending duplicate restriction still works.


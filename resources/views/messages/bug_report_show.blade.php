@extends('layouts.dashboard')

@section('title', 'Bug Report #'.$bug_report->id)

@section('styles')
<style>
.messenger-shell {
  display: grid;
  grid-template-columns: minmax(320px, 360px) 1fr;
  gap: 24px;
}

.messenger-sidebar {
  border-radius: 28px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(226, 232, 240, 0.95);
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
}

.messenger-sidebar .sidebar-header {
  padding: 24px;
  background: linear-gradient(180deg, rgba(59, 130, 246, 0.95), rgba(96, 165, 250, 0.96));
  color: white;
}

.messenger-sidebar .sidebar-header h2 {
  font-size: 1.4rem;
  margin-bottom: 6px;
}

.messenger-sidebar .sidebar-header p {
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: 0;
}

.sidebar-section {
  padding: 20px 20px 16px;
}

.sidebar-section h6 {
  margin-bottom: 14px;
  color: #475569;
  font-size: 0.82rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.conversation-list {
  display: grid;
  gap: 12px;
}

.conversation-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 14px 16px;
  border-radius: 18px;
  border: 1px solid rgba(226,232,240,0.95);
  text-decoration: none;
  color: inherit;
  transition: all 0.2s ease;
}

.conversation-item:hover {
  transform: translateY(-2px);
  border-color: rgba(59,130,246,0.2);
  background: rgba(59,130,246,0.04);
}

.conversation-meta {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
}

.conversation-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(59, 130, 246, 0.12);
  color: #1e3a8a;
  font-weight: 700;
}

.conversation-details {
  min-width: 0;
}

.conversation-name {
  font-weight: 700;
  font-size: 0.95rem;
  margin-bottom: 3px;
}

.conversation-preview {
  color: #64748b;
  font-size: 0.85rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.conversation-side-meta {
  display: grid;
  gap: 6px;
  align-items: center;
  text-align: right;
}

.badge-role,
.badge-priority,
.badge-status {
  font-size: 0.68rem;
  padding: 0.32rem 0.6rem;
  border-radius: 999px;
  text-transform: uppercase;
  font-weight: 700;
}

.badge-role.admin { background: #eff6ff; color: #1d4ed8; }
.badge-role.staff { background: #ecfdf5; color: #166534; }
.badge-role.student { background: #f8fafc; color: #334155; }
.badge-priority.low { background: #e0f2fe; color: #0369a1; }
.badge-priority.medium { background: #fef3c7; color: #b45309; }
.badge-priority.high { background: #fee2e2; color: #b91c1c; }
.badge-priority.critical { background: #f8fafc; color: #0f172a; }
.badge-status.pending { background: #f8fafc; color: #475569; }
.badge-status.resolved { background: #ecfdf5; color: #15803d; }
.badge-status.closed { background: #f1f5f9; color: #334155; }

.messenger-main {
  border-radius: 28px;
  background: rgba(255,255,255,0.95);
  border: 1px solid rgba(226,232,240,0.95);
  box-shadow: 0 24px 70px rgba(15,23,42,0.08);
  min-height: 720px;
  display: grid;
  grid-template-rows: auto 1fr auto;
}

.bug-report-details {
  padding: 28px 34px 20px;
  border-bottom: 1px solid rgba(226,232,240,0.95);
}

.bug-report-details h3 {
  margin-bottom: 10px;
}

.bug-report-details p {
  margin-bottom: 0.75rem;
  color: #475569;
}

.bug-report-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 18px;
}

.bug-report-meta span {
  font-size: 0.82rem;
  padding: 0.5rem 0.85rem;
  border-radius: 999px;
  background: #f8fafc;
  color: #475569;
  border: 1px solid rgba(226,232,240,0.95);
}

.bug-report-thread {
  padding: 24px 34px;
  overflow-y: auto;
}

.message-block {
  display: grid;
  gap: 10px;
  max-width: 78%;
}

.message-block.sent {
  justify-self: end;
  text-align: right;
}

.message-block .bubble {
  padding: 18px 20px;
  border-radius: 26px;
  font-size: 0.95rem;
  line-height: 1.7;
}

.message-block.sent .bubble {
  background: #e0f2fe;
  color: #0f172a;
  border-bottom-right-radius: 6px;
}

.message-block.received .bubble {
  background: #f8fafc;
  color: #334155;
  border-bottom-left-radius: 6px;
}

.message-meta {
  font-size: 0.8rem;
  color: #64748b;
}

.message-attachment a {
  color: #2563eb;
}

.bug-report-actions {
  display: grid;
  gap: 20px;
  padding: 24px 34px 28px;
  border-top: 1px solid rgba(226,232,240,0.95);
}

.bug-report-actions form {
  display: grid;
  gap: 16px;
}

.bug-report-actions textarea,
.bug-report-actions .form-select,
.bug-report-actions .form-control {
  border-radius: 16px;
  border: 1px solid rgba(226,232,240,0.95);
  padding: 14px 16px;
}

.btn-submit,
.btn-status {
  border: none;
  color: white;
  padding: 14px 22px;
  border-radius: 16px;
  font-weight: 700;
}

.btn-submit { background: #2563eb; }
.btn-status { background: #10b981; }

.btn-submit:hover { background: #1d4ed8; }
.btn-status:hover { background: #0f766e; }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-4" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="h3 mb-1"><i class="fas fa-bug"></i> Bug Report</h1>
      <p class="text-muted mb-0">Track the ticket conversation for this issue.</p>
    </div>
    <a href="{{ route('messages.index') }}" class="btn btn-light btn-lg border rounded-pill"><i class="fas fa-arrow-left me-2"></i>Back to Inbox</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="messenger-shell" data-aos="fade-up" data-aos-duration="700">
    <aside class="messenger-sidebar">
      <div class="sidebar-header">
        <h2>Support Tickets</h2>
        <p>Manage active bug reports and message the reporter from here.</p>
      </div>

      <div class="sidebar-section">
        <h6>Bug Reports</h6>
        <div class="conversation-list">
          @forelse($bugReports as $item)
            <a href="{{ route('messages.bug-reports.show', $item['report']->id) }}" class="conversation-item {{ $bug_report->id === $item['report']->id ? 'border-primary' : '' }}">
              <div class="conversation-meta">
                <div class="conversation-avatar">B</div>
                <div class="conversation-details">
                  <div class="conversation-name">{{ $item['report']->title ?? 'Bug report' }}</div>
                  <div class="conversation-preview">{{ Str::limit($item['latest']->message ?? $item['report']->description, 45) }}</div>
                </div>
              </div>
              <div class="conversation-side-meta">
                <span class="badge-status {{ $item['report']->status }}">{{ ucfirst(str_replace('_', ' ', $item['report']->status)) }}</span>
                @if($item['unread'] > 0)
                  <span class="badge-unread">{{ $item['unread'] }}</span>
                @endif
              </div>
            </a>
          @empty
            <div class="text-muted">No active bug report tickets.</div>
          @endforelse
        </div>
      </div>
    </aside>

    <section class="messenger-main">
      <div class="bug-report-details">
        <div class="d-flex align-items-start justify-content-between gap-4 flex-wrap">
          <div>
            <h3>{{ $bug_report->title }}</h3>
            <p>{{ $bug_report->description }}</p>
            <div class="bug-report-meta">
              <span>Reporter: {{ $bug_report->reporter->name ?? 'Unknown' }}</span>
              <span>Affected page: {{ $bug_report->affected_page }}</span>
              <span>Priority: {{ ucfirst($bug_report->priority) }}</span>
              <span class="badge-status {{ $bug_report->status }}">{{ ucfirst(str_replace('_', ' ', $bug_report->status)) }}</span>
            </div>
          </div>
          @if($bug_report->screenshot)
            <div class="text-end">
              <a href="{{ asset('storage/' . $bug_report->screenshot) }}" target="_blank" class="btn btn-outline-primary">View screenshot</a>
            </div>
          @endif
        </div>
      </div>

      <div class="bug-report-thread">
        <div class="message-thread">
          @forelse($messages as $message)
            <div class="message-block {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
              <div class="bubble">{!! nl2br(e($message->message)) !!}</div>
              @if($message->attachment)
                <div class="message-attachment"><a href="{{ asset('storage/' . $message->attachment) }}" target="_blank"><i class="fas fa-paperclip me-1"></i>View attachment</a></div>
              @endif
              <div class="message-meta">{{ $message->created_at->format('M d, Y h:i A') }}</div>
            </div>
          @empty
            <div class="text-center py-5 text-muted">
              <i class="fas fa-bug fa-3x mb-3"></i>
              <p class="mb-0">No comments have been added to this report.</p>
            </div>
          @endforelse
        </div>
      </div>

      <div class="bug-report-actions">
        <form method="POST" action="{{ route('messages.bug-reports.comment', $bug_report) }}" enctype="multipart/form-data">
          @csrf
          <div>
            <label for="message" class="form-label">Add a comment</label>
            <textarea id="message" name="message" class="form-control" rows="4" placeholder="Reply in this ticket thread" required></textarea>
          </div>
          <div>
            <label for="attachment" class="form-label">Optional attachment</label>
            <input type="file" id="attachment" name="attachment" class="form-control" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
          </div>
          <button type="submit" class="btn-submit">Post comment</button>
        </form>

        @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
          <form method="POST" action="{{ route('messages.bug-reports.status', $bug_report) }}">
            @csrf
            @method('PUT')
            <div>
              <label for="status" class="form-label">Update ticket status</label>
              <select id="status" name="status" class="form-select" required>
                <option value="pending" {{ $bug_report->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="under_review" {{ $bug_report->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                <option value="in_progress" {{ $bug_report->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="testing" {{ $bug_report->status === 'testing' ? 'selected' : '' }}>Testing</option>
                <option value="resolved" {{ $bug_report->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ $bug_report->status === 'closed' ? 'selected' : '' }}>Closed</option>
              </select>
            </div>
            <div>
              <label for="reply" class="form-label">Optional update note</label>
              <textarea id="reply" name="reply" class="form-control" rows="3" placeholder="Add an optional status update note."></textarea>
            </div>
            <button type="submit" class="btn-status">Update status</button>
          </form>
        @endif
      </div>
    </section>
  </div>
</div>
@endsection
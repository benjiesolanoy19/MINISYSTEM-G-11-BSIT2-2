@extends('layouts.dashboard')

@section('title', 'Equipment Inventory')

@section('styles')
<style>
    /* Premium Inventory Dashboard UI (sidebar/layout safe) */

    .inventory-page {
        padding-bottom: 24px;
    }

    .inventory-hero {
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(14,165,233,0.92), rgba(16,185,129,0.92));
        color: #fff;
        box-shadow: 0 30px 80px rgba(14,165,233,0.18);
        overflow: hidden;
        position: relative;
    }

    .inventory-hero:before {
        content: '';
        position: absolute;
        inset: -2px;
        background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.25), transparent 40%),
                    radial-gradient(circle at 80% 30%, rgba(255,255,255,0.2), transparent 35%);
        pointer-events: none;
    }

    .inventory-hero .hero-inner {
        position: relative;
        padding: 20px 22px;
    }

    .inventory-title {
        font-size: 1.9rem;
        font-weight: 900;
        letter-spacing: -0.02em;
        margin: 0;
    }

    .inventory-subtitle {
        margin: 6px 0 0;
        opacity: 0.95;
    }

    .glass-panel {
        background: rgba(255,255,255,0.85);
        border: 1px solid rgba(226,232,240,0.9);
        border-radius: 20px;
        box-shadow: 0 24px 70px rgba(15,23,42,0.06);
        backdrop-filter: blur(10px);
    }

    .stat-card {
        border-radius: 18px;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.9);
        box-shadow: 0 14px 35px rgba(15,23,42,0.05);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 22px 55px rgba(15,23,42,0.10);
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 900;
        line-height: 1;
        color: #0f172a;
    }

    .stat-label {
        text-transform: uppercase;
        letter-spacing: 0.14em;
        font-size: 0.72rem;
        color: #64748b;
        margin-top: 8px;
    }

    .inventory-controls {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr 0.8fr 0.8fr auto;
        gap: 12px;
        align-items: end;
    }

    @media (max-width: 992px) {
        .inventory-controls {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .inventory-controls {
            grid-template-columns: 1fr;
        }
    }

    .control-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .inventory-table-wrap {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.75);
        box-shadow: 0 24px 70px rgba(15,23,42,0.05);
    }

    .inventory-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 16px;
        padding: 18px;
    }

    .equip-card {
        grid-column: span 3;
        border-radius: 20px;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.9);
        overflow: hidden;
        box-shadow: 0 14px 40px rgba(15,23,42,0.05);
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        position: relative;
    }

    .equip-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 70px rgba(15,23,42,0.12);
        border-color: rgba(14,165,233,0.35);
    }

    @media (max-width: 1200px) {
        .equip-card { grid-column: span 4; }
    }
    @media (max-width: 992px) {
        .equip-card { grid-column: span 6; }
    }
    @media (max-width: 576px) {
        .equip-card { grid-column: span 12; }
    }

    .equip-media {
        height: 190px;
        background: linear-gradient(180deg, rgba(2,132,199,0.08), rgba(16,185,129,0.06));
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .equip-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-bottom: 1px solid rgba(226,232,240,0.8);
        border-radius: 0;
    }

    .equip-body {
        padding: 14px 14px 12px;
    }

    .equip-title {
        font-weight: 900;
        color: #0f172a;
        font-size: 1.05rem;
        letter-spacing: -0.01em;
        margin: 0 0 8px;
        line-height: 1.25;
    }

    .equip-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(2,132,199,0.08);
        color: #0369a1;
        font-weight: 800;
        font-size: 0.78rem;
        margin-bottom: 10px;
    }

    .equip-desc {
        color: #475569;
        font-size: 0.92rem;
        line-height: 1.35;
        min-height: 2.5em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .equip-meta {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid rgba(226,232,240,0.9);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .qty {
        font-weight: 900;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .status-pill {
        padding: 7px 11px;
        border-radius: 999px;
        font-weight: 900;
        font-size: 0.78rem;
        letter-spacing: 0.02em;
        user-select: none;
        border: 1px solid transparent;
        transition: transform .15s ease;
        white-space: nowrap;
    }

    .status-pill:hover { transform: translateY(-1px); }

    .status-available {
        background: rgba(16,185,129,0.12);
        border-color: rgba(16,185,129,0.25);
        color: #065f46;
    }
    .status-borrowed {
        background: rgba(239,68,68,0.10);
        border-color: rgba(239,68,68,0.20);
        color: #991b1b;
    }
    .status-maintenance {
        background: rgba(245,158,11,0.12);
        border-color: rgba(245,158,11,0.25);
        color: #92400e;
    }
    .status-lost {
        background: rgba(100,116,139,0.14);
        border-color: rgba(100,116,139,0.25);
        color: #334155;
    }

    .equip-actions {
        display: flex;
        gap: 10px;
        padding: 12px 14px 14px;
        border-top: 1px solid rgba(226,232,240,0.9);
        background: rgba(248,250,252,0.75);
    }

    .equip-actions .btn {
        border-radius: 14px;
        font-weight: 900;
    }

    .equip-actions .btn-outline-primary {
        border-color: rgba(14,165,233,0.35);
    }

    .equip-actions .btn-outline-danger {
        border-radius: 14px;
    }

    .search-input, .select-input {
        border-radius: 16px;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.95);
        padding: 10px 12px;
        outline: none;
        transition: box-shadow .2s ease, border-color .2s ease;
    }

    .search-input:focus, .select-input:focus {
        border-color: rgba(14,165,233,0.65);
        box-shadow: 0 0 0 4px rgba(14,165,233,0.12);
    }

    .toast-slot {
        position: fixed;
        top: 90px;
        right: 18px;
        z-index: 2000;
        pointer-events: none;
    }

    .skeleton-card {
        grid-column: span 3;
        border-radius: 20px;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.9);
        padding: 14px;
        box-shadow: 0 14px 40px rgba(15,23,42,0.05);
    }

    @media (max-width: 1200px) { .skeleton-card { grid-column: span 4; } }
    @media (max-width: 992px) { .skeleton-card { grid-column: span 6; } }
    @media (max-width: 576px) { .skeleton-card { grid-column: span 12; } }

    .skeleton {
        background: linear-gradient(90deg, rgba(226,232,240,0.3), rgba(226,232,240,0.7), rgba(226,232,240,0.3));
        background-size: 200% 100%;
        animation: shimmer 1.2s infinite;
        border-radius: 12px;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .skeleton-line { height: 14px; }
    .skeleton-media { height: 150px; border-radius: 14px; }

    .empty-state {
        padding: 46px 20px;
        text-align: center;
        color: #475569;
    }

    .empty-state .empty-icon {
        font-size: 3rem;
        color: #0ea5e9;
        margin-bottom: 14px;
    }

    .badge-soft {
        border-radius: 999px;
        padding: 8px 12px;
        font-weight: 900;
        font-size: 0.8rem;
        border: 1px solid rgba(226,232,240,0.95);
        background: rgba(255,255,255,0.9);
    }

    .reset-btn {
        border-radius: 16px;
        font-weight: 900;
    }

</style>
@endsection

@section('content')
<div class="inventory-page">

    <section class="inventory-hero mb-4">
        <div class="hero-inner d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between gap-3">
            <div>
                <h1 class="inventory-title">
                    <i class="fas fa-boxes me-2"></i>Equipment Inventory
                </h1>
                <p class="inventory-subtitle mb-0">Modern inventory management with clean search, filters, and premium card UI.</p>
            </div>

            <div class="d-flex gap-2 align-items-center">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('equipment.create') }}" class="btn btn-info btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Add Equipment
                    </a>
                @endif
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 20px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 20px;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $equipmentCount = $equipment->count();
        $availableCount = $equipment->where('status', 'available')->count();
        $borrowedCount = $equipment->where('status', 'borrowed')->count();
        $maintenanceCount = $equipment->where('status', 'maintenance')->count();
    @endphp

    <section class="mb-4">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-value">{{ $equipmentCount }}</div>
                        <div class="stat-label">Total Equipment</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-value">{{ $availableCount }}</div>
                        <div class="stat-label">Available Items</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-value">{{ $borrowedCount }}</div>
                        <div class="stat-label">Borrowed Items</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-value">{{ $maintenanceCount }}</div>
                        <div class="stat-label">Maintenance Items</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inventory-table-wrap mb-4">
        <div class="p-3 p-md-4">
            <div class="inventory-controls">

                <div>
                    <div class="control-label">Search</div>
                    <input id="equipSearch" type="text" class="search-input w-100" placeholder="Search equipment by name or description..." />
                </div>

                <div>
                    <div class="control-label">Category</div>
                    <select id="equipCategory" class="select-input w-100">
                        <option value="">All Categories</option>
                        @foreach($equipment->pluck('category')->filter()->unique()->sort()->values() as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="control-label">Status</div>
                    <select id="equipStatus" class="select-input w-100">
                        <option value="">All Status</option>
                        <option value="available">Available</option>
                        <option value="borrowed">Borrowed</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="lost">Out of Stock</option>
                    </select>
                </div>

                <div>
                    <div class="control-label">Quantity Availability</div>
                    <select id="equipAvailability" class="select-input w-100">
                        <option value="">Any</option>
                        <option value="in">In Stock (qty > 0)</option>
                        <option value="out">Out of Stock (qty <= 0)</option>
                    </select>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <button id="resetFilters" class="btn btn-secondary reset-btn px-4">
                        <i class="fas fa-rotate-right me-2"></i>Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="inventory-table-wrap">
        <div id="inventoryGrid" class="inventory-grid">
            @forelse($equipment as $item)
                @php
                    $status = $item->status;
                    $statusClass = 'status-' . $status;
                    $isOut = (int)($item->available_quantity ?? 0) <= 0;
                    $effectiveStatus = $isOut && $status !== 'maintenance' ? 'lost' : $status;
                    $effectiveStatusClass = 'status-' . $effectiveStatus;
                @endphp

                <article class="equip-card" 
                    data-search="{{ strtolower($item->name . ' ' . ($item->description ?? '') . ' ' . ($item->category ?? '')) }}"
                    data-category="{{ $item->category ?? '' }}"
                    data-status="{{ $effectiveStatus }}"
                    data-availability="{{ $isOut ? 'out' : 'in' }}">

                    <div class="equip-media">
                        <img 
                            src="{{ $item->getImageUrl() }}" 
                            alt="{{ $item->name }}" 
                            loading="lazy" 
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80';" />
                    </div>

                    <div class="equip-body">
                        <h3 class="equip-title">{{ $item->name }}</h3>
                        @if($item->category)
                            <div class="equip-category">
                                <i class="fas fa-tag"></i>
                                <span>{{ $item->category }}</span>
                            </div>
                        @endif
                        <p class="equip-desc">{{ $item->description ?? 'No description provided.' }}</p>

                        <div class="equip-meta">
                            <div>
                                <div class="qty"><strong>{{ $item->available_quantity }}</strong> available</div>
                                <div class="text-muted small">
                                    Added: {{ optional($item->created_at)->format('M d, Y') ?? '-' }}
                                </div>
                            </div>
                            <div class="status-pill {{ $effectiveStatusClass }}">{{ ucfirst($effectiveStatus) }}</div>
                        </div>
                    </div>

                    <div class="equip-actions">
                        <div class="w-100 d-flex gap-2 justify-content-end">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="d-flex gap-2" style="min-width: 160px;">
                                    <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form method="POST" action="{{ route('equipment.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                </article>
            @empty
                <div class="empty-state col-12">
                    <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                    <h4 class="fw-bold mb-2">No equipment found</h4>
                    <div class="text-muted">Add equipment to get started.</div>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    (function () {
        const searchEl = document.getElementById('equipSearch');
        const categoryEl = document.getElementById('equipCategory');
        const statusEl = document.getElementById('equipStatus');
        const availabilityEl = document.getElementById('equipAvailability');
        const resetBtn = document.getElementById('resetFilters');
        const grid = document.getElementById('inventoryGrid');

        function normalize(s) {
            return (s || '').toString().toLowerCase().trim();
        }

        function applyFilters() {
            if (!grid) return;

            const q = normalize(searchEl?.value);
            const c = (categoryEl?.value || '').toString();
            const st = (statusEl?.value || '').toString();
            const av = (availabilityEl?.value || '').toString();

            const cards = grid.querySelectorAll('.equip-card');
            cards.forEach(card => {
                const hay = normalize(card.getAttribute('data-search'));
                const cardCat = card.getAttribute('data-category') || '';
                const cardSt = card.getAttribute('data-status') || '';
                const cardAv = card.getAttribute('data-availability') || '';

                const matchQ = !q || hay.includes(q);
                const matchC = !c || cardCat === c;
                const matchSt = !st || cardSt === st;
                const matchAv = !av || cardAv === av;

                card.style.display = (matchQ && matchC && matchSt && matchAv) ? '' : 'none';
            });
        }

        [searchEl, categoryEl, statusEl, availabilityEl].forEach(el => {
            if (!el) return;
            el.addEventListener('input', applyFilters);
            el.addEventListener('change', applyFilters);
        });

        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (searchEl) searchEl.value = '';
                if (categoryEl) categoryEl.value = '';
                if (statusEl) statusEl.value = '';
                if (availabilityEl) availabilityEl.value = '';
                applyFilters();
            });
        }

        // Initial
        applyFilters();
    })();
</script>
@endsection


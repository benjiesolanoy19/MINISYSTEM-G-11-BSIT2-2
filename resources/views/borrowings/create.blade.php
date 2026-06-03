@extends('layouts.dashboard')

@section('title', 'Borrow Equipment')

@section('content')
<style>
    /* CRITICAL: Modal Footer Visibility Fix */
    #borrowModal .modal-content {
        display: flex;
        flex-direction: column;
        max-height: 90vh;
    }

    #borrowModal .modal-body {
        flex: 1;
        overflow-y: auto;
        max-height: calc(90vh - 250px);
    }

    #borrowModal .modal-footer {
        display: flex !important;
        justify-content: flex-end;
        gap: 12px;
        padding: 16px 20px !important;
        border-top: 1px solid #dee2e6 !important;
        background: #fff !important;
        flex-shrink: 0;
    }

    #borrowModal .modal-footer button {
        display: inline-flex !important;
        padding: 0.6rem 2rem !important;
        font-weight: 600 !important;
        border-radius: 999px !important;
        min-width: 140px;
        white-space: nowrap;
    }

    .borrow-page {
        min-height: calc(100vh - 4.5rem);
        padding: 2rem 0;
    }

    .borrow-panel {
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 28px 75px rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(18px);
    }

    .page-heading {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.03em;
    }

    .page-note {
        color: #64748b;
    }

    .borrow-toolbar .form-control,
    .borrow-toolbar .form-select {
        min-height: 50px;
        border-radius: 18px;
        border: 1px solid rgba(226, 232, 240, 0.95);
    }

    .borrow-stat-card {
        border-radius: 24px;
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(248,250,252,0.95));
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
    }

    .borrow-stat-card small {
        color: #64748b;
    }

    .borrow-card {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.86);
        border: 1px solid rgba(255, 255, 255, 0.95);
        overflow: hidden;
        transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
        min-height: 100%;
    }

    .borrow-card:hover {
        transform: translateY(-6px);
        border-color: rgba(14, 165, 233, 0.3);
        box-shadow: 0 32px 70px rgba(14, 165, 233, 0.12);
    }

    .borrow-card::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.12), transparent 42%);
    }

    .borrow-card-body {
        position: relative;
        z-index: 1;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        flex: 1;
    }

    .borrow-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.45rem;
    }

    .borrow-card-meta {
        color: #475569;
        font-size: 0.95rem;
    }

    .borrow-card-status {
        padding: 0.5rem 0.9rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-available { background: #dcfce7; color: #166534; }
    .status-borrowed { background: #fee2e2; color: #991b1b; }
    .status-maintenance { background: #fef3c7; color: #92400e; }
    .status-lost { background: #e2e8f0; color: #334155; }

    .borrow-card .btn {
        border-radius: 16px;
        font-weight: 700;
    }

    .borrow-card-footer {
        margin-top: auto;
    }

    .borrow-skeleton {
        animation: shimmer 1.6s ease-in-out infinite;
        background: linear-gradient(90deg, #f8fafc 25%, #e2e8f0 50%, #f8fafc 75%);
        background-size: 200% 100%;
        min-height: 320px;
        border-radius: 24px;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .modal-content {
        border-radius: 28px;
        overflow: hidden;
    }

    .modal-header,
    .modal-footer {
        border: none;
    }

    @media (max-width: 768px) {
        .borrow-toolbar { flex-direction: column; }
        .borrow-toolbar .btn { width: 100%; }
    }
</style>

<div class="container-fluid borrow-page" x-data="borrowForm()" x-init="init()">
    <div class="row gy-4">
        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="page-heading mb-2">Borrow Equipment</h1>
                        <p class="page-note mb-0">A premium borrowing dashboard with fast search, live filters, and a smart request flow for your lab equipment.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                            @if(Auth::user() && Auth::user()->role === 'admin')
                                <a href="{{ route('equipment.create') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-plus-lg me-2"></i> Add Equipment
                                </a>
                            @endif
                            <button type="button" class="btn btn-primary btn-lg" @click.prevent="resetFilters()">
                                <i class="bi bi-arrow-clockwise me-2"></i> Reset Filters
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 borrow-toolbar gx-3 gy-3">
                    <div class="col-lg-5">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="search" class="form-control border-start-0" placeholder="Search equipment, category, or lab" x-model.debounce.250ms="searchQuery" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <select class="form-select shadow-sm" x-model="categoryFilter">
                            <option value="all">All Categories</option>
                            <template x-for="category in categories" :key="category">
                                <option x-text="category" :value="category"></option>
                            </template>
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <select class="form-select shadow-sm" x-model="statusFilter">
                            <option value="all">All Statuses</option>
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="lost">Lost</option>
                        </select>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 mt-4 g-3">
                    <div class="col">
                        <div class="borrow-stat-card p-4 h-100">
                            <small class="d-block text-uppercase fw-semibold mb-2">Total Items</small>
                            <h2 class="mb-1" x-text="totalCount"></h2>
                            <p class="mb-0 text-muted">Complete catalog count of all equipment.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="borrow-stat-card p-4 h-100">
                            <small class="d-block text-uppercase fw-semibold mb-2">Available</small>
                            <h2 class="mb-1" x-text="availableCount"></h2>
                            <p class="mb-0 text-muted">Equipment ready for immediate borrowing.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="borrow-stat-card p-4 h-100">
                            <small class="d-block text-uppercase fw-semibold mb-2">Borrowed</small>
                            <h2 class="mb-1" x-text="borrowedCount"></h2>
                            <p class="mb-0 text-muted">Items currently on loan or reserved.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="borrow-stat-card p-4 h-100">
                            <small class="d-block text-uppercase fw-semibold mb-2">Maintenance</small>
                            <h2 class="mb-1" x-text="maintenanceCount"></h2>
                            <p class="mb-0 text-muted">Equipment unavailable due to maintenance or issues.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
                    <div>
                        <h4 class="fw-semibold mb-1">Equipment Catalog</h4>
                        <p class="text-muted mb-0">Tap a card to see details and request a borrow instantly.</p>
                    </div>
                    <div class="text-muted small">
                        Showing <strong x-text="filteredItems.length"></strong> results
                    </div>
                </div>

                <div class="row g-4">
                    <template x-if="isLoading">
                        <template>
                            <template x-for="n in 6" :key="n">
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="borrow-skeleton"></div>
                                </div>
                            </template>
                        </template>
                    </template>

                    <template x-if="!isLoading">
                        <template>
                            <template x-for="item in filteredItems" :key="item.id">
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="borrow-card">
                                        <div class="borrow-card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                                <div>
                                                    <div class="text-uppercase fw-bold text-secondary small mb-2" x-text="item.category"></div>
                                                    <h5 class="borrow-card-title" x-text="item.name"></h5>
                                                </div>
                                                <span class="borrow-card-status" :class="statusClass(item)" x-text="item.status"></span>
                                            </div>

                                            <p class="borrow-card-meta mb-3" x-text="item.description || 'No description provided for this item.'"></p>

                                            <div class="d-flex flex-wrap gap-2 mb-4 text-muted small">
                                                <span><strong x-text="item.available_quantity"></strong> available</span>
                                                <span>•</span>
                                                <span x-text="item.laboratory_name || 'General Lab'"></span>
                                            </div>

                                            <div class="mt-auto borrow-card-footer">
                                                <button type="button" class="btn btn-outline-primary w-100" :disabled="item.status !== 'available' || item.available_quantity <= 0" @click.stop.prevent="openModal(item)">
                                                    <span x-show="item.status === 'available' && item.available_quantity > 0">Request Borrow</span>
                                                    <span x-show="item.status !== 'available' || item.available_quantity <= 0">Not Available</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </template>

                    <template x-if="!isLoading && filteredItems.length === 0">
                        <div class="col-12">
                            <div class="alert alert-info mb-0 rounded-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="fs-2 text-primary"><i class="bi bi-box-seam"></i></div>
                                    <div>
                                        <h5 class="mb-1">No matching equipment found</h5>
                                        <p class="mb-0">Try updating your search or status filter to find other equipment options.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true" x-cloak>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title" id="borrowModalLabel">Request Equipment Borrowing</h5>
                        <p class="text-muted mb-0">Complete your borrow request with the equipment details already loaded.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('borrow.create') }}" method="POST" class="row g-4">
                        @csrf
                        <input type="hidden" name="equipment_id" :value="selectedItem.id">
                        <input type="hidden" name="status" value="pending">

                        <div class="col-12 col-xl-5">
                            <div class="p-4 rounded-4 border border-1 border-primary border-opacity-15 bg-primary bg-opacity-10 h-100">
                                <h5 class="fw-semibold mb-3" x-text="selectedItem.name"></h5>
                                <p class="text-muted mb-3" x-text="selectedItem.description || 'No description available for this equipment.'"></p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-secondary">Category</span>
                                    <strong x-text="selectedItem.category"></strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-secondary">Lab</span>
                                    <strong x-text="selectedItem.laboratory_name || 'General Lab'"></strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-secondary">Available</span>
                                    <strong x-text="selectedItem.available_quantity"></strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-secondary">Status</span>
                                    <span class="borrow-card-status" :class="statusClass(selectedItem)" x-text="selectedItem.status"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-7">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Purpose</label>
                                    <textarea class="form-control form-control-lg" name="purpose" rows="4" placeholder="Describe the purpose of your borrow request" required></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Borrow Date</label>
                                    <input type="date" class="form-control form-control-lg" name="borrow_date" x-model="borrowDate" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Return Date</label>
                                    <input type="date" class="form-control form-control-lg" name="return_date" x-model="returnDate" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control form-control-lg" name="quantity" min="1" :max="selectedItem.available_quantity" x-model.number="borrowQuantity" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Requested By</label>
                                    <input type="text" class="form-control form-control-lg" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill" :disabled="borrowQuantity < 1 || borrowQuantity > selectedItem.available_quantity">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function borrowForm() {
        return {
            isLoading: true,
            searchQuery: '',
            categoryFilter: 'all',
            statusFilter: 'all',
            selectedItem: {},
            borrowDate: new Date().toISOString().split('T')[0],
            returnDate: new Date(new Date().setDate(new Date().getDate() + 7)).toISOString().split('T')[0],
            borrowQuantity: 1,
            categories: {!! json_encode($equipment->pluck('category')->unique()->sort()->values()->all()) !!},
            equipmentData: {!! $equipment->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'code' => $item->code,
                    'category' => $item->category,
                    'laboratory_name' => $item->laboratory_name,
                    'available_quantity' => $item->available_quantity,
                    'status' => $item->status,
                    'description' => $item->description,
                    'price' => $item->price ?? null,
                    'updated_at' => optional($item->updated_at)->format('M d, Y'),
                ];
            })->toJson() !!},

            init() {
                if (this.equipmentData.length) {
                    this.selectedItem = this.equipmentData[0];
                }
                setTimeout(() => {
                    this.isLoading = false;
                }, 220);
            },

            resetFilters() {
                this.searchQuery = '';
                this.categoryFilter = 'all';
                this.statusFilter = 'all';
            },

            get filteredItems() {
                return this.equipmentData.filter(item => {
                    const term = this.searchQuery.trim().toLowerCase();
                    const matchesSearch = !term || [item.name, item.code, item.category, item.laboratory_name, item.description].some(field => field && field.toLowerCase().includes(term));
                    const matchesCategory = this.categoryFilter === 'all' || item.category === this.categoryFilter;
                    const matchesStatus = this.statusFilter === 'all' || item.status === this.statusFilter;
                    return matchesSearch && matchesCategory && matchesStatus;
                });
            },

            get totalCount() {
                return this.equipmentData.length;
            },

            get availableCount() {
                return this.equipmentData.filter(item => item.status === 'available' && item.available_quantity > 0).length;
            },

            get borrowedCount() {
                return this.equipmentData.filter(item => item.status === 'borrowed').length;
            },

            get maintenanceCount() {
                return this.equipmentData.filter(item => item.status === 'maintenance' || item.status === 'lost').length;
            },

            statusClass(item) {
                if (!item || !item.status) return 'status-available';
                const status = item.status.toLowerCase();
                if (status === 'available') return 'status-available';
                if (status === 'borrowed') return 'status-borrowed';
                if (status === 'maintenance') return 'status-maintenance';
                if (status === 'lost') return 'status-lost';
                return 'status-available';
            },

            openModal(item) {
                if (!item) return;
                this.selectedItem = item;
                this.borrowQuantity = item.available_quantity > 0 ? 1 : 0;
                this.borrowDate = new Date().toISOString().split('T')[0];
                this.returnDate = new Date(new Date().setDate(new Date().getDate() + 7)).toISOString().split('T')[0];
                const modalElement = document.getElementById('borrowModal');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.show();
            }
        };
    }
</script>
@endsection

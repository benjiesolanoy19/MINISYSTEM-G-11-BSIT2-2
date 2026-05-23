

<?php $__env->startSection('title', 'Borrow Equipment'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .borrow-page {
        min-height: calc(100vh - 4.5rem);
        padding: 2.5rem 0;
    }

    .borrow-panel {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 30px;
        box-shadow: 0 35px 80px rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(18px);
    }

    .borrow-heading {
        font-size: clamp(2rem, 2.35vw, 2.4rem);
        font-weight: 800;
        letter-spacing: -0.04em;
    }

    .borrow-description {
        color: #64748b;
        font-size: 1rem;
    }

    .borrow-toolbar .form-control,
    .borrow-toolbar .form-select,
    .borrow-toolbar .btn {
        min-height: 52px;
        border-radius: 18px;
        border: 1px solid rgba(226, 232, 240, 0.95);
    }

    .borrow-stat-card {
        border-radius: 24px;
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(248,250,252,0.95));
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.05);
    }

    .borrow-stat-card small {
        color: #64748b;
    }

    .equipment-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        border-radius: 28px;
        border: 1px solid rgba(226, 232, 240, 0.95);
        background: rgba(255, 255, 255, 0.92);
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        cursor: pointer;
    }

    .equipment-card:hover {
        transform: translateY(-4px);
        border-color: rgba(59, 130, 246, 0.32);
        box-shadow: 0 34px 80px rgba(59, 130, 246, 0.14);
    }

    .equipment-card::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.12), transparent 40%);
    }

    .equipment-card img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .equipment-card-body {
        position: relative;
        z-index: 1;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        flex: 1;
    }

    .equipment-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.3;
    }

    .equipment-card-text {
        color: #475569;
        min-height: 3rem;
    }

    .equipment-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        color: #475569;
        font-size: 0.95rem;
    }

    .status-chip {
        padding: 0.45rem 0.85rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-available { background: #dcfce7; color: #166534; }
    .status-borrowed { background: #fee2e2; color: #991b1b; }
    .status-maintenance { background: #fef3c7; color: #92400e; }
    .status-lost { background: #e2e8f0; color: #334155; }

    .modal-content {
        border-radius: 28px;
        overflow: hidden;
    }

    .modal-backdrop.show {
        opacity: 0.7;
        backdrop-filter: blur(3px);
    }

    .card-empty-state {
        border-radius: 28px;
        border: 1px dashed rgba(148, 163, 184, 0.45);
        background: rgba(248, 250, 252, 0.9);
        padding: 3rem;
        text-align: center;
        color: #475569;
    }

    .card-empty-state h4 {
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .card-empty-state p {
        color: #64748b;
    }

    [x-cloak] { display: none !important; }

    @media (max-width: 768px) {
        .borrow-toolbar { flex-direction: column; }
        .borrow-toolbar .btn,
        .borrow-toolbar .form-select,
        .borrow-toolbar .form-control { width: 100%; }
    }
</style>

<div class="container-fluid borrow-page" x-data="borrowPage()" x-init="init()">
    <div class="row gy-4">
        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="borrow-heading mb-2">Borrow Equipment</h1>
                        <p class="borrow-description mb-0">A premium dashboard for lab equipment requests with beautiful cards, hover motion, and a smart modal flow.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                            <?php if(Auth::user() && Auth::user()->role === 'admin'): ?>
                                <a href="<?php echo e(route('equipment.create')); ?>" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-plus-lg me-2"></i> Add Equipment
                                </a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary btn-lg" @click="resetFilters()">
                                <i class="bi bi-arrow-clockwise me-2"></i> Reset Filters
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 borrow-toolbar gx-3 gy-3">
                    <div class="col-lg-5">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="search" class="form-control border-start-0" placeholder="Search equipment, category, or status" x-model.debounce.250ms="searchQuery" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <select class="form-select shadow-sm" x-model="statusFilter">
                            <option value="all">All Statuses</option>
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="lost">Lost</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
                            <div class="borrow-stat-card p-4 w-100">
                                <small>Total items</small>
                                <h2 class="mb-1" x-text="totalCount"></h2>
                                <p class="mb-0">Complete catalog count of all equipment.</p>
                            </div>
                            <div class="borrow-stat-card p-4 w-100">
                                <small>Available</small>
                                <h2 class="mb-1" x-text="availableCount"></h2>
                                <p class="mb-0">Equipment ready for immediate borrowing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
                    <div>
                        <h4 class="fw-semibold mb-1">Equipment Catalog</h4>
                        <p class="mb-0 text-muted">Click any card to view full details and create a borrow request.</p>
                    </div>
                    <div class="text-muted small">
                        Showing <strong x-text="filteredCount"></strong> results
                    </div>
                </div>

                <div class="row g-4">
                    <template x-if="!equipmentData.length">
                        <div class="col-12">
                            <div class="card-empty-state">
                                <i class="bi bi-box-seam fs-1 mb-3"></i>
                                <h4>No equipment found</h4>
                                <p>There is no equipment available in the catalog yet. Add an item or check back later.</p>
                            </div>
                        </div>
                    </template>

                    <template x-for="item in filteredItems" :key="item.id">
                        <div class="col-12 col-md-6 col-xl-4" x-cloak>
                            <div class="equipment-card" @click="openModal(item)">
                                <img :src="item.image || defaultImage" alt="Equipment preview" />
                                <div class="equipment-card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <div class="text-uppercase fw-semibold text-secondary small" x-text="item.category || 'General'"></div>
                                            <h3 class="equipment-card-title" x-text="item.name"></h3>
                                        </div>
                                        <span class="status-chip" :class="statusClass(item.status)" x-text="item.status"></span>
                                    </div>

                                    <p class="equipment-card-text" x-text="item.description"></p>
                                    <div class="equipment-meta">
                                        <span><strong x-text="item.available_quantity"></strong> available</span>
                                        <span>•</span>
                                        <span><strong x-text="item.quantity"></strong> total</span>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary mt-3 align-self-start" @click.stop.prevent="openModal(item)">Request borrow</button>
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
                        <h5 class="modal-title" id="borrowModalLabel">Borrow Equipment</h5>
                        <p class="text-muted mb-0">Confirm the details below and submit your request.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
<div class="modal-body pt-0">
<form method="POST" action="<?php echo e(url('/borrow')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="equipment_id" :value="selectedItem.id">
                        <input type="hidden" name="status" value="pending">

                        <div class="col-12 col-xl-5">
                            <div class="p-4 rounded-4 border border-1 border-primary border-opacity-15 bg-primary bg-opacity-10 h-100">
                                <img :src="selectedItem.image || defaultImage" class="img-fluid rounded-4 mb-4" alt="Selected equipment preview">
                                <h5 class="fw-semibold mb-2" x-text="selectedItem.name"></h5>
                                <p class="text-muted mb-3" x-text="selectedItem.description"></p>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-secondary">Category</span>
                                    <strong x-text="selectedItem.category || 'General'"></strong>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-secondary">Available</span>
                                    <strong x-text="selectedItem.available_quantity"></strong>
                                </div>
                                <div class="d-flex justify-content-between mb-0">
                                    <span class="text-secondary">Status</span>
                                    <span class="status-chip" :class="statusClass(selectedItem.status)" x-text="selectedItem.status"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-7">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Purpose</label>
                                    <textarea class="form-control form-control-lg" name="purpose" rows="4" placeholder="Describe why you need this equipment" required></textarea>
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
                                    <input type="text" class="form-control form-control-lg" value="<?php echo e(Auth::user()->name); ?>" disabled>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control form-control-lg" name="notes" rows="3" placeholder="Optional notes for the administrator"></textarea>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Modal two-column layout */
    .borrow-modal-card{
        border-radius: 24px;
        border: 1px solid rgba(226,232,240,.9);
        background: rgba(255,255,255,.96);
        box-shadow: 0 25px 70px rgba(15,23,42,.10);
        overflow: hidden;
    }
    .borrow-modal-shadow{ box-shadow: 0 18px 45px rgba(15,23,42,.08); }
    .borrow-modal-img-wrap{
        height: 360px;
        background: #f8fafc;
        border-radius: 18px;
        border: 1px solid rgba(226,232,240,.9);
        overflow: hidden;
    }
    .borrow-modal-img-wrap img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display:block;
        transform: scale(1.01);
    }

    .borrow-modal-body{ padding: 1.25rem; }
    .borrow-modal-field{
        border: 1px solid rgba(226,232,240,.95);
        border-radius: 16px;
    }

    .borrow-modal-actions{
        display:flex;
        justify-content: flex-end;
        gap: .75rem;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .borrow-modal-actions .btn{ border-radius: 999px; padding-left: 1.2rem; padding-right: 1.2rem; }

    .borrow-modal-form .form-label{ color:#475569; font-weight:600; font-size:.95rem; margin-bottom:.35rem; }
    .borrow-modal-form .form-control{ border-radius:16px; }

    @media (max-width: 991.98px){
        .borrow-modal-img-wrap{ height: 260px; }
    }
</style>

<?php $__env->startSection('scripts'); ?>
<script>
    function borrowPage() {
        return {
            equipmentData: <?php echo $equipment->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category ?? 'General',
                    'description' => $item->description ?? 'No description available.',
                    'status' => $item->status,
                    'quantity' => $item->quantity,
                    'available_quantity' => $item->available_quantity,
                    'image' => $item->getImageUrl(),
                ];
            })->toJson(); ?>,
            searchQuery: '',
            statusFilter: 'all',
            selectedItem: {},
            borrowDate: new Date().toISOString().split('T')[0],
            returnDate: new Date(new Date().setDate(new Date().getDate() + 7)).toISOString().split('T')[0],
            borrowQuantity: 1,
            defaultImage: 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80',

            init() {
                if (this.equipmentData.length) {
                    this.selectedItem = this.equipmentData[0];
                }
            },

            get filteredItems() {
                const term = this.searchQuery.trim().toLowerCase();
                return this.equipmentData.filter(item => {
                    const matchesSearch = !term || item.name.toLowerCase().includes(term) || item.category.toLowerCase().includes(term) || item.description.toLowerCase().includes(term) || item.status.toLowerCase().includes(term);
                    const matchesStatus = this.statusFilter === 'all' || item.status === this.statusFilter;
                    return matchesSearch && matchesStatus;
                });
            },

            get filteredCount() {
                return this.filteredItems.length;
            },

            get totalCount() {
                return this.equipmentData.length;
            },

            get availableCount() {
                return this.equipmentData.filter(item => item.status === 'available' && item.available_quantity > 0).length;
            },

            openModal(item) {
                if (!item) return;
                this.selectedItem = item;
                this.borrowQuantity = item.available_quantity > 0 ? 1 : 0;
                this.borrowDate = new Date().toISOString().split('T')[0];
                this.returnDate = new Date(new Date().setDate(new Date().getDate() + 7)).toISOString().split('T')[0];
                const modalEl = document.getElementById('borrowModal');
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            },

            resetFilters() {
                this.searchQuery = '';
                this.statusFilter = 'all';
            },

            statusClass(status) {
                if (!status) return 'status-available';
                return {
                    available: 'status-available',
                    borrowed: 'status-borrowed',
                    maintenance: 'status-maintenance',
                    lost: 'status-lost'
                }[status] || 'status-available';
            }
        };
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/borrowings/cards.blade.php ENDPATH**/ ?>
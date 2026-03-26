@extends('layouts.dashboard-enhanced')

@section('page-title', 'Dashboard Overview')

@section('content')
<div x-data="dashboardOverview()" @load="loadData()" x-cloak>
    <!-- Welcome Section -->
    <div class="mb-40" data-scroll>
        <div class="widget" style="background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%); color: white; border: none;">
            <div class="widget-header">
                <div>
                    <h2 style="margin: 0 0 10px 0; font-size: 2rem;">Welcome back, <span x-text="userName"></span>!</h2>
                    <p style="margin: 0; opacity: 0.9;">Here's what's happening with your laboratory today</p>
                </div>
                <div style="text-align: right;">
                    <i class="fas fa-chart-line" style="font-size: 2rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Key Metrics Grid -->
    <div class="dashboard-grid" data-scroll>
        <!-- Active Equipment -->
        <div class="widget" x-data="{ count: 0 }" @load="animateCounter">
            <div class="widget-header">
                <div>
                    <span class="widget-title">Active Equipment</span>
                </div>
                <div class="widget-icon">
                    <i class="fas fa-server"></i>
                </div>
            </div>
            <div class="widget-value" x-text="count"></div>
            <div class="widget-footer">
                <i class="fas fa-arrow-up" style="color: var(--mdc-success);"></i> 12% from last week
            </div>
        </div>
        
        <!-- Reservations -->
        <div class="widget" x-data="{ count: 0 }" @load="animateCounter">
            <div class="widget-header">
                <div>
                    <span class="widget-title">Today's Reservations</span>
                </div>
                <div class="widget-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div class="widget-value" x-text="count"></div>
            <div class="widget-footer">
                <span class="md-chip" style="background: rgba(14, 165, 233, 0.15); color: var(--mdc-primary); border: none;">
                    8 Pending
                </span>
            </div>
        </div>
        
        <!-- Pending Borrowings -->
        <div class="widget" x-data="{ count: 0 }" @load="animateCounter">
            <div class="widget-header">
                <div>
                    <span class="widget-title">Pending Returns</span>
                </div>
                <div class="widget-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
            </div>
            <div class="widget-value" x-text="count"></div>
            <div class="widget-footer">
                <span class="md-chip" style="background: rgba(245, 158, 11, 0.15); color: var(--mdc-warning); border: none;">
                    3 Overdue
                </span>
            </div>
        </div>
        
        <!-- System Uptime -->
        <div class="widget" x-data="{ percentage: 0 }" @load="animatePercentage">
            <div class="widget-header">
                <div>
                    <span class="widget-title">System Uptime</span>
                </div>
                <div class="widget-icon">
                    <i class="fas fa-server"></i>
                </div>
            </div>
            <div class="widget-value"><span x-text="percentage"></span>%</div>
            <div class="widget-footer">
                <div class="progress" style="margin-bottom: 0;">
                    <div class="progress-bar" :style="`width: ${percentage}%`" style="background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity Section -->
    <div class="mt-40" data-scroll>
        <h3 style="margin-bottom: 25px; color: var(--text-dark); font-weight: 700;">
            <i class="fas fa-history me-2" style="color: var(--mdc-primary);"></i>Recent Activity
        </h3>
        
        <div class="data-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Equipment</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="md-badge md-badge-primary" style="padding: 4px 10px;">
                                <i class="fas fa-exchange-alt me-1"></i>Borrowing
                            </span>
                        </td>
                        <td>Oscilloscope XYZ-1000</td>
                        <td>John Doe</td>
                        <td><span class="status-badge active">Active</span></td>
                        <td>2 hours ago</td>
                        <td><button class="btn btn-sm btn-text">View</button></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="md-badge md-badge-success" style="padding: 4px 10px; background: rgba(16, 185, 129, 0.2); color: var(--mdc-success);">
                                <i class="fas fa-calendar-check me-1"></i>Reservation
                            </span>
                        </td>
                        <td>Microscope Pro Max</td>
                        <td>Jane Smith</td>
                        <td><span class="status-badge active">Confirmed</span></td>
                        <td>1 day ago</td>
                        <td><button class="btn btn-sm btn-text">View</button></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="md-badge" style="padding: 4px 10px; background: rgba(245, 158, 11, 0.2); color: var(--mdc-warning);">
                                <i class="fas fa-exclamation-triangle me-1"></i>Incident
                            </span>
                        </td>
                        <td>Centrifuge CX-500</td>
                        <td>Bob Wilson</td>
                        <td><span class="status-badge pending">Investigating</span></td>
                        <td>3 days ago</td>
                        <td><button class="btn btn-sm btn-text">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="mt-40" data-scroll>
        <h3 style="margin-bottom: 25px; color: var(--text-dark); font-weight: 700;">
            <i class="fas fa-flash me-2" style="color: var(--mdc-primary);"></i>Quick Actions
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <button class="btn btn-filled" x-on:click="toggleModal('newReservation')" style="width: 100%;">
                <i class="fas fa-plus me-2"></i>New Reservation
            </button>
            <button class="btn btn-filled" x-on:click="toggleModal('borrowEquipment')" style="width: 100%;">
                <i class="fas fa-checkout me-2"></i>Borrow Equipment
            </button>
            <button class="btn btn-outlined" x-on:click="toggleModal('reportIncident')" style="width: 100%;">
                <i class="fas fa-flag me-2"></i>Report Incident
            </button>
            <button class="btn btn-outlined" x-on:click="toggleModal('viewLogs')" style="width: 100%;">
                <i class="fas fa-file-alt me-2"></i>View Logs
            </button>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    [data-scroll] {
        opacity: 0;
        transform: translateY(20px);
    }
    
    .mt-40 {
        margin-top: 2.5rem;
    }
    
    .mb-40 {
        margin-bottom: 2.5rem;
    }
    
    .dropdown-menu.show {
        display: block;
    }
    
    .dropdown-menu {
        display: none;
        background: var(--card-bg);
        border-radius: 8px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
    }
    
    .dropdown-item {
        display: block;
        width: 100%;
        padding: 12px 16px;
        color: var(--text-dark);
        text-decoration: none;
        text-align: left;
        border: none;
        background: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .dropdown-item:hover {
        background-color: var(--light-bg);
        color: var(--mdc-primary);
    }
    
    .dropdown-item.text-danger {
        color: var(--mdc-error);
    }
    
    .dropdown-item.text-danger:hover {
        background-color: rgba(239, 68, 68, 0.1);
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboardOverview', () => ({
            userName: '{{ Auth::user()->first_name ?? Auth::user()->name }}',
            showModal: false,
            modalType: null,
            
            toggleModal(type) {
                this.modalType = type;
                this.showModal = !this.showModal;
            },
            
            loadData() {
                // Simulate data loading with GSAP animations
                setTimeout(() => {
                    gsap.utils.toArray('[data-scroll]').forEach((element, index) => {
                        gsap.fromTo(element, {
                            opacity: 0,
                            y: 30,
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            delay: index * 0.15,
                            ease: 'power2.out'
                        });
                    });
                }, 300);
            },
            
            animateCounter(event) {
                const target = Math.floor(Math.random() * 100) + 50;
                gsap.to(event.currentTarget, {
                    innerText: target,
                    duration: 2,
                    ease: 'power2.out',
                    snap: { innerText: 1 }
                });
            },
            
            animatePercentage(event) {
                const target = 99.8;
                const element = event.currentTarget.querySelector('[x-text="percentage"]');
                gsap.to(event.currentTarget.parentElement, {
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: function() {
                        const value = Math.round(this.targets()[0].percentage * 10) / 10;
                        element.textContent = value;
                    }
                }, function() {
                    this.percentage = target;
                });
            }
        }));
    });
</script>
@endsection

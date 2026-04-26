@extends('layouts.dashboard')

@section('title', 'Reserve Laboratory')

@section('content')
<div class="container-fluid py-5">
    <!-- Page Header with Hero Banner -->
    <div class="hero-banner p-5 mb-5 rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 24px 70px rgba(0, 0, 0, 0.15);">
        <div class="position-absolute top-0 end-0 opacity-10" style="width: 400px; height: 400px; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 400%22><circle cx=%22100%22 cy=%22100%22 r=%2280%22 fill=%22white%22/></svg>'); background-repeat: no-repeat;"></div>
        <div class="row align-items-center position-relative">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold text-white mb-3"><i class="fas fa-calendar-check me-3"></i>Reserve a Laboratory</h1>
                <p class="fs-5 text-white-75 mb-0">Select your preferred laboratory, choose your available time slot, and submit your reservation request. Our staff will review and confirm your booking shortly.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('reservations.index') }}" class="btn btn-light btn-lg fw-600 px-4 py-3 rounded-3">
                    <i class="fas fa-list-check me-2"></i>My Reservations
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 16px; border: none; background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%); border-left: 4px solid #22c55e;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3" style="font-size: 1.3rem; color: #22c55e;"></i>
                <div>
                    <strong class="text-success">Success!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 16px; border: none; background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%); border-left: 4px solid #ef4444;">
            <strong class="d-block text-danger mb-2"><i class="fas fa-exclamation-circle me-2"></i>Validation Errors</strong>
            <ul class="mb-0 ms-4">
                @foreach($errors->all() as $error)
                    <li class="text-danger"><small>{{ $error }}</small></li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($laboratories->isEmpty())
        <div class="empty-state-container text-center py-8" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
            <div>
                <i class="fas fa-door-closed" style="font-size: 5rem; color: #ccc; margin-bottom: 20px; display: block;"></i>
                <h4 class="fw-bold mb-2">No Laboratories Available</h4>
                <p class="text-muted">There are currently no available laboratories for reservation. Please check back later or contact the administration.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mt-3 px-4 py-2 rounded-3">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    @else
        <!-- Laboratories Grid -->
        <div class="row g-4 mb-5">
            @foreach($laboratories as $lab)
                <div class="col-lg-6 col-xl-6">
                    <div class="lab-card-modern h-100 transition-all" style="border-radius: 20px; overflow: hidden; background: white; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08); border: 1px solid rgba(0, 0, 0, 0.05); hover: box-shadow: 0 24px 70px rgba(0, 0, 0, 0.15); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        <!-- Lab Image with Overlay -->
                        <div class="position-relative" style="height: 280px; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?w=1200&h=600&fit=crop" class="w-100 h-100" style="object-fit: cover; transition: transform 0.4s ease;" alt="{{ $lab->name }}">
                            <div class="position-absolute top-3 end-3">
                                <span class="badge" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    <i class="fas fa-check-circle me-1"></i>Available
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Lab Name and Description -->
                            <div class="mb-4">
                                <h4 class="fw-700 mb-2" style="font-size: 1.35rem; color: #1f2937;">{{ $lab->name }}</h4>
                                <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">{{ $lab->description ?? 'Professional laboratory facility for academic research and practical training.' }}</p>
                            </div>

                            <!-- Lab Details Badges -->
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge rounded-pill" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; padding: 8px 14px; font-weight: 500; font-size: 0.85rem;">
                                    <i class="fas fa-building me-1"></i>{{ $lab->building }}
                                </span>
                                <span class="badge rounded-pill" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); color: #be185d; padding: 8px 14px; font-weight: 500; font-size: 0.85rem;">
                                    <i class="fas fa-layer-group me-1"></i>Floor {{ $lab->floor }}
                                </span>
                                <span class="badge rounded-pill" style="background: linear-gradient(135deg, #ddd6fe 0%, #d8b4fe 100%); color: #6d28d9; padding: 8px 14px; font-weight: 500; font-size: 0.85rem;">
                                    <i class="fas fa-users me-1"></i>{{ $lab->capacity }} seats
                                </span>
                            </div>

                            <!-- Divider -->
                            <div style="height: 1px; background: linear-gradient(90deg, transparent 0%, #e5e7eb 50%, transparent 100%); margin: 1.5rem 0;"></div>

                            <!-- Footer with Fee and Reserve Button -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Reservation Fee</p>
                                    <h5 class="fw-700 mb-0" style="color: #22c55e;">Free</h5>
                                </div>
                                <button type="button" 
                                    class="btn fw-600 px-4 py-3 rounded-3" 
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; transition: all 0.3s ease; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#reservationModal{{ $lab->id }}"
                                    onmouseover="this.style.boxShadow='0 12px 40px rgba(102, 126, 234, 0.5)'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.3)'; this.style.transform='translateY(0)';">
                                    <i class="fas fa-calendar-plus me-2"></i>Reserve Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Modal -->
                <div class="modal fade" id="reservationModal{{ $lab->id }}" tabindex="-1" aria-labelledby="reservationModalLabel{{ $lab->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border: none; border-radius: 20px; box-shadow: 0 24px 70px rgba(0, 0, 0, 0.15);">
                            <!-- Modal Header -->
                            <div class="modal-header" style="border: none; border-bottom: 1px solid #f0f0f0; padding: 2rem;">
                                <div>
                                    <h5 class="modal-title fw-700" id="reservationModalLabel{{ $lab->id }}" style="font-size: 1.35rem; color: #1f2937;">
                                        <i class="fas fa-calendar-plus me-2" style="color: #667eea;"></i>Reserve {{ $lab->name }}
                                    </h5>
                                    <p class="text-muted mb-0 mt-2 small">Fill in the details below to book your laboratory slot</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Modal Body -->
                            <form method="POST" action="{{ route('reservations.store') }}" id="reservationForm{{ $lab->id }}">
                                @csrf
                                <div class="modal-body" style="padding: 2rem;">
                                    <input type="hidden" name="laboratory_id" value="{{ $lab->id }}">

                                    <!-- Lab Information Card -->
                                    <div class="mb-4 p-3 rounded-3" style="background: linear-gradient(135deg, #f0f9ff 0%, #f8fafc 100%); border: 1px solid #e0f2fe;">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <p class="mb-1 small fw-600" style="color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em;">Selected Laboratory</p>
                                                <h6 class="mb-0 fw-700">{{ $lab->name }}</h6>
                                            </div>
                                            <span class="badge rounded-pill" style="background: #e0f2fe; color: #0284c7; padding: 8px 12px;">
                                                <i class="fas fa-check me-1"></i>Selected
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Date Selection -->
                                    <div class="mb-4">
                                        <label class="form-label fw-600 mb-2" style="color: #374151;">
                                            <i class="fas fa-calendar me-2" style="color: #667eea;"></i>Reservation Date
                                        </label>
                                        <input type="date" name="date" class="form-control" style="padding: 12px 16px; border-radius: 12px; border: 2px solid #e5e7eb; font-size: 1rem; transition: all 0.3s ease;" required min="{{ date('Y-m-d') }}">
                                        <small class="text-muted d-block mt-2">Select a future date for your reservation</small>
                                    </div>

                                    <!-- Time Selection Row -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-600 mb-2" style="color: #374151;">
                                                <i class="fas fa-clock me-2" style="color: #667eea;"></i>Time In
                                            </label>
                                            <input type="time" name="time_in" class="form-control" style="padding: 12px 16px; border-radius: 12px; border: 2px solid #e5e7eb; font-size: 1rem; transition: all 0.3s ease;" required>
                                            <small class="text-muted d-block mt-2">When you'll start using the lab</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-600 mb-2" style="color: #374151;">
                                                <i class="fas fa-hourglass-end me-2" style="color: #667eea;"></i>Time Out
                                            </label>
                                            <input type="time" name="time_out" class="form-control" style="padding: 12px 16px; border-radius: 12px; border: 2px solid #e5e7eb; font-size: 1rem; transition: all 0.3s ease;" required>
                                            <small class="text-muted d-block mt-2">When you'll finish using the lab</small>
                                        </div>
                                    </div>

                                    <!-- Purpose Field -->
                                    <div class="mb-4">
                                        <label class="form-label fw-600 mb-2" style="color: #374151;">
                                            <i class="fas fa-comment-dots me-2" style="color: #667eea;"></i>Purpose of Reservation <span class="text-muted">(Optional)</span>
                                        </label>
                                        <textarea name="purpose" class="form-control" placeholder="Describe what you'll be working on (e.g., Group Project, Research..." rows="3" style="padding: 12px 16px; border-radius: 12px; border: 2px solid #e5e7eb; font-size: 0.95rem; transition: all 0.3s ease; resize: none;"></textarea>
                                        <small class="text-muted d-block mt-2">This helps us better understand how the lab is being used</small>
                                    </div>

                                    <!-- Info Box -->
                                    <div class="alert alert-info mb-0" style="border-radius: 12px; border: none; background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%); border-left: 4px solid #3b82f6;">
                                        <i class="fas fa-info-circle me-2" style="color: #3b82f6;"></i>
                                        <small>Your reservation request will be reviewed by staff. You'll receive a confirmation notification shortly.</small>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer" style="border: none; border-top: 1px solid #f0f0f0; padding: 1.5rem 2rem;">
                                    <button type="button" class="btn btn-outline-secondary rounded-3 px-4 py-2 fw-600" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </button>
                                    <button type="submit" class="btn fw-600 px-4 py-2 rounded-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Reservation
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeInputs = document.querySelectorAll('input[name="time_in"]');
        const timeOutInputs = document.querySelectorAll('input[name="time_out"]');

        timeInputs.forEach((timeInInput, index) => {
            const timeOutInput = timeOutInputs[index];
            if (!timeInInput || !timeOutInput) return;

            timeInInput.addEventListener('change', function() {
                timeOutInput.min = this.value;
                if (timeOutInput.value && timeOutInput.value <= this.value) {
                    timeOutInput.value = '';
                }
            });

            timeOutInput.addEventListener('change', function() {
                if (timeInInput.value && this.value <= timeInInput.value) {
                    this.setCustomValidity('Time out must be after time in');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    });
</script>
@endsection


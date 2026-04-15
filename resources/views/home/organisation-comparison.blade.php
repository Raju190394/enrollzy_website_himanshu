<section class="comparison-section overflow-hidden py-5">
    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">
            <span class="badge bg-light text-dark mb-2 p-2 px-3 shadow-sm">🎓 Compare Organisations & Courses</span>
            <h2 class="fw-bold main-heading"><span class="theme">Find the Best</span> Course for Your Career</h2>
            <p class="text-muted">
                Select a course to compare top organisations on key parameters like fees, mode, and approvals.
            </p>
        </div>

        @if($unique_courses->count() > 0)
            <!-- Course Selector Dropdown -->
            <div class="course-selector mb-4 d-flex justify-content-center">
                <div class="course-dropdown-wrapper">
                    <span class="csd-icon"><i class="fas fa-graduation-cap"></i></span>
                    <select id="courseDropdown" class="course-select-dropdown">
                        <option value="all">All Courses</option>
                        @foreach($unique_courses as $courseMaster)
                            <option value="{{ $courseMaster->name }}">{{ $courseMaster->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Comparison Table -->
            <div class="table-responsive shadow-sm rounded-4 border overflow-hidden">
                <table class="table comparison-table mb-0 align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="ps-4 py-3">Organisation</th>
                            <th class="py-3">Course</th>
                            <th class="py-3">Mode</th>
                            <th class="py-3">Fees</th>
                            <th class="py-3">Duration</th>
                            <th class="py-3">Placement</th>
                            <th class="py-3 pe-4">Rating</th>
                        </tr>
                    </thead>
                    <tbody id="comparisonTableBody">
                        @foreach($organisations as $org)
                            @foreach($org->courses as $course)
                                <tr class="course-row" data-course-name="{{ $course->course->name ?? '' }}">
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-dark">{{ $org->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted small fw-semibold">{{ $course->course->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3">{{ $course->mode ?? 'N/A' }}</td>
                                    <td class="py-3 fw-bold text-primary">{{ $course->fees ?? 'N/A' }}</td>
                                    <td class="py-3">{{ $course->duration ?? 'N/A' }}</td>
                                    <td class="py-3">
                                        @php
                                            $cleanPlacement = strtolower(strip_tags($course->placement_details));
                                        @endphp
                                        @if($cleanPlacement == 'yes')
                                            <span class="badge bg-success">Yes</span>
                                        @elseif($cleanPlacement == 'limited')
                                            <span class="badge bg-warning text-dark">Limited</span>
                                        @else
                                            <div class="placement-info small text-secondary">
                                                @php
                                                    $plainText = preg_replace('/[\s\x{00a0}]+/u', ' ', html_entity_decode(strip_tags($course->placement_details)));
                                                    $plainText = trim($plainText);
                                                    $showModal = strlen($plainText) > 100;
                                                @endphp

                                                @if($showModal)
                                                    {{ Str::limit($plainText, 100) }}
                                                    <a href="javascript:void(0)" class="text-primary fw-bold view-placement-btn"
                                                        data-details="{{ $course->placement_details }}" data-org="{{ $org->name }}"
                                                        data-course="{{ $course->course->name ?? 'Course' }}">
                                                        View
                                                    </a>
                                                @else
                                                    {!! $course->placement_details !!}
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 pe-4">
                                        @if($course->rating > 0)
                                            <span class="text-warning"><i class="fas fa-star me-1"></i>{{ $course->rating }}</span>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="noCourseMessage" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x text-light mb-3"></i>
                <p class="text-muted">No organisations found for this course selection.</p>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">Organisation and course data is being updated. Please check back soon.</p>
            </div>
        @endif

    </div>
</section>

<!-- Placement Details Modal -->
<div class="modal fade" id="placementModal" tabindex="-1" aria-labelledby="placementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header p-4 border-0" style="border-radius: 20px 20px 0 0;">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="placementModalLabel">Placement Details</h5>
                    <p class="mb-0 small text-muted" id="modalSubHeading"></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="placementModalBody">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .comparison-table tr:hover {
        background-color: #f8f9ff !important;
    }

    .placement-info {
        max-width: 280px;
        line-height: 1.4;
    }

    .placement-info p,
    .placement-info ul {
        margin-bottom: 0px;
    }

    .placement-info ul {
        padding-left: 15px;
    }

    /* Course Dropdown */
    .course-dropdown-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 480px;
        background: #fff;
        border: 2px solid var(--primary-color, #0d6efd);
        border-radius: 50px;
        padding: 0 20px 0 16px;
        box-shadow: 0 4px 20px rgba(13, 110, 253, 0.13);
        transition: box-shadow 0.3s ease;
        overflow: hidden;
    }

    .course-dropdown-wrapper:hover,
    .course-dropdown-wrapper:focus-within {
        box-shadow: 0 6px 28px rgba(13, 110, 253, 0.24);
    }

    /* Arrow icon drawn via pseudo-element so it stays inside */
    .course-dropdown-wrapper::after {
        content: '';
        display: block;
        flex-shrink: 0;
        width: 18px;
        height: 18px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230d6efd' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
        transition: transform 0.3s ease;
    }

    .course-dropdown-wrapper:focus-within::after {
        transform: rotate(180deg);
    }

    .csd-icon {
        color: var(--primary-color, #0d6efd);
        font-size: 1rem;
        margin-right: 10px;
        flex-shrink: 0;
        line-height: 1;
    }

    .course-select-dropdown {
        flex: 1;
        min-width: 0;
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.96rem;
        font-weight: 500;
        color: #333;
        padding: 12px 8px 12px 0;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        width: 100%;
    }

    .course-select-dropdown option {
        padding: 10px 16px;
        line-height: 1.8;
        font-size: 0.94rem;
        font-weight: 400;
        color: #333;
        background: #fff;
    }

    .course-select-dropdown option:hover,
    .course-select-dropdown option:checked {
        background: #e8f0fe;
        color: var(--primary-color, #0d6efd);
    }
</style>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('courseDropdown');
            const rows = document.querySelectorAll('.course-row');
            const noMessage = document.getElementById('noCourseMessage');
            const tableBody = document.getElementById('comparisonTableBody');

            if (!dropdown) return;

            dropdown.addEventListener('change', function () {
                const selectedCourse = this.value;
                let visibleCount = 0;

                rows.forEach(row => {
                    if (selectedCourse === 'all' || row.getAttribute('data-course-name') === selectedCourse) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    noMessage.classList.remove('d-none');
                    tableBody.classList.add('d-none');
                } else {
                    noMessage.classList.add('d-none');
                    tableBody.classList.remove('d-none');
                }
            });
        });

        // Toggle Placement Modal
        const placementModal = new bootstrap.Modal(document.getElementById('placementModal'));
        const modalBody = document.getElementById('placementModalBody');
        const modalSubHeading = document.getElementById('modalSubHeading');

        document.querySelectorAll('.view-placement-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const details = this.getAttribute('data-details');
                const org = this.getAttribute('data-org');
                const course = this.getAttribute('data-course');

                modalSubHeading.textContent = `${org} - ${course}`;
                modalBody.innerHTML = details;
                placementModal.show();
            });
        });
    </script>
@endpush
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
            <!-- Course Selector -->
            <div class="course-selector mb-4 pb-2">
                <div class="d-flex flex-wrap gap-2 justify-content-center" id="courseFilterContainer">
                    <button class="btn btn-outline-primary course-filter-btn active" data-course="all">All Courses</button>
                    @foreach($unique_courses as $courseMaster)
                        <button class="btn btn-outline-primary course-filter-btn" data-course="{{ $courseMaster->name }}">
                            {{ $courseMaster->name }}
                        </button>
                    @endforeach
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
                            <th class="py-3">Approvals</th>
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
                                        <div class="fw-bold text-dark">{{ $org->name }}</div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted small fw-semibold">{{ $course->course->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3">{{ $course->mode }}</td>
                                    <td class="py-3">
                                        <span class="badge bg-light text-dark border">{{ $org->approvals }}</span>
                                    </td>
                                    <td class="py-3 fw-bold text-primary">{{ $course->fees }}</td>
                                    <td class="py-3">{{ $course->duration }}</td>
                                    <td class="py-3">
                                        @if(strtolower($org->placement) == 'yes')
                                            <span class="badge bg-success">Yes</span>
                                        @elseif(strtolower($org->placement) == 'limited')
                                            <span class="badge bg-warning text-dark">Limited</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $org->placement }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 pe-4">
                                        <span class="text-warning"><i class="fas fa-star me-1"></i>{{ $org->rating }}</span>
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

<style>
    .comparison-table tr:hover {
        background-color: #f8f9ff !important;
    }
    .course-filter-btn {
        border-radius: 30px;
        padding: 8px 20px;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #dee2e6;
        color: #6c757d;
        background: white;
    }
    .course-filter-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: #f0f7ff;
    }
    .course-filter-btn.active {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .course-selector::-webkit-scrollbar {
        height: 6px;
    }
    .course-selector::-webkit-scrollbar-thumb {
        background: #eee;
        border-radius: 10px;
    }
</style>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.course-filter-btn');
        const rows = document.querySelectorAll('.course-row');
        const noMessage = document.getElementById('noCourseMessage');
        const tableBody = document.getElementById('comparisonTableBody');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const selectedCourse = this.getAttribute('data-course');
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
    });
</script>
@endpush

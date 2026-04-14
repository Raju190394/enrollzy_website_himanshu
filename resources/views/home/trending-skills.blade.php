<div class="trending-section">
    <div class="container">
        <!-- Trending Skills -->
        <h2 class="main-heading">
            <sppan class="theme">Trending</sppan> Skills
        </h2>
        <div class="d-flex flex-wrap gap-2 mb-4">
            @foreach (['Leadership and Management', 'Machine Learning', 'Responsible AI', 'Python Programming', 'Computer Programming', 'Microsoft Excel', 'Problem Solving', 'AI Enablement'] as $skill)
                <span class="skill-pill">{{ $skill }}</span>
            @endforeach

            <a href="#" class="text-primary fw-semibold ms-2">Show more</a>
        </div>

       
    </div>
</div>

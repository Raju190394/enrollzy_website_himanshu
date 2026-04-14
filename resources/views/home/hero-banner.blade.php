<section class="hero-section">
  <div class="container">
    <div class="row align-items-center gy-4">

      <!-- LEFT CONTENT -->
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="main-heading">{!! $site_settings->hero_title ?? 'Welcome to <span class="theme">ABC College</span>' !!}</h1>
          <p>
            {{ $site_settings->hero_description ?? 'ABC College is committed to academic excellence, innovation, and shaping future leaders with world-class education.' }}
          </p>

          <ul class="list-unstyled mb-4">
            @if(!empty($site_settings->hero_features))
              @foreach(explode("\n", str_replace("\r", "", $site_settings->hero_features)) as $feature)
                @if(trim($feature))
                  <li>✔ {{ trim($feature) }}</li>
                @endif
              @endforeach
            @else
              <li>✔ NAAC Accredited Institution</li>
              <li>✔ 50+ Undergraduate & Postgraduate Programs</li>
              <li>✔ Industry-Ready Curriculum</li>
            @endif
          </ul>

          <a href="{{ $site_settings->hero_cta_1_link ?? '#' }}" class="btn btn-theme-one me-2" target="{{ ($site_settings->hero_cta_1_new_tab ?? false) ? '_blank' : '_self' }}">{{ $site_settings->hero_cta_1_text ?? 'Apply Now' }}</a>
          <a href="{{ $site_settings->hero_cta_2_link ?? '#' }}" class="btn btn-theme-two" target="{{ ($site_settings->hero_cta_2_new_tab ?? false) ? '_blank' : '_self' }}">{{ $site_settings->hero_cta_2_text ?? 'Explore Courses' }}</a>
        </div>
      </div>

      <!-- RIGHT SLIDER -->
      <div class="col-lg-6">
        <div class="hero-slider">
          @forelse($hero_sliders as $slider)
            <div>
              <img src="{{ asset($slider->image_path) }}" alt="Hero Image">
            </div>
          @empty
            <div>
              <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f" alt="Campus">
            </div>
            <div>
              <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Library">
            </div>
            <div>
              <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Students">
            </div>
          @endforelse
        </div>
      </div>

    </div>
  </div>
</section>

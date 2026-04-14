<section class="company-marquee">
    <div class="container">

        <div class="marquee-wrapper">
            <div class="marquee-track">

                @php
                    $logos = $logos = [
                        [
                            'name' => 'Times Network',
                            'img' =>
                                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnsu_gl86vsi84VAkdczWZJIZpq3gbW_JA4w&s',
                        ],
                        [
                            'name' => 'Amazon',
                            'img' =>
                                'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/300px-Amazon_logo.svg.png',
                        ],
                        [
                            'name' => 'Deloitte',
                            'img' =>
                                'data:image/png;base64,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',
                        ],
                        [
                            'name' => 'Coca-Cola',
                            'img' =>
                                'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Coca-Cola_logo.svg/300px-Coca-Cola_logo.svg.png',
                        ],
                        [
                            'name' => 'Samsung',
                            'img' => 'https://www.freepnglogos.com/uploads/original-samsung-logo-10.png',
                        ],
                        [
                            'name' => 'EY',
                            'img' =>
                                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnA94djNyPByY8I_iAHcxJQJkSnLOKDRMebw&s',
                        ],
                        [
                            'name' => 'TCS',
                            'img' =>
                                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6Hk-cCmmtCp1D7LPyaZeJPruelynAA9KP3A&s',
                        ],
                    ];

                @endphp

                {{-- Duplicate list for infinite scroll --}}
                @foreach (range(1, 2) as $loop)
                    <div class="marquee-group">
                        @foreach ($logos as $logo)
                            <div class="logo-card">
                                <img src="{{ $logo['img'] }}" alt="{{ $logo['name'] }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</section>

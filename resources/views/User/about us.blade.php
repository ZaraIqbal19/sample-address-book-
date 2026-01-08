@extends('user.layout')
@section('content')

<!-- About Us / Meet the Team -->
<div class="container py-5 text-center">

    <!-- Heading -->
    <h3 class="lux-heading mb-2 wow fadeInDown" data-wow-delay="0.1s">
        💎 MEET THE ARTISTS & CREATORS BEHIND ADDRESS BOOK ✨
    </h3>
    <h6 class="lux-sub mb-3 wow fadeInDown" data-wow-delay="0.2s">
        Crafting Elegance in Jewellery & Cosmetics Online Experience 💄💍
    </h6>
    <p class="lux-text mb-5 wow fadeInUp" data-wow-delay="0.3s">
        Our team blends creativity with technology to deliver seamless, luxurious digital experiences for jewellery and cosmetic lovers. From intuitive interfaces to smooth mobile browsing, every design reflects the elegance and sophistication of our brand. Explore the tech artisans shaping the future of digital luxury. 🚀
    </p>

    @php
        $team = [
            ['name'=>'ZARA IQBAL','img'=>'Zara.jpg','phone'=>'+92 311 3861056','whatsapp'=>'+92 311 3861056','desc'=>'I bring creative digital experiences to life for jewellery and cosmetics, designing responsive, elegant websites that engage users and highlight the beauty of every product. Every interface is crafted to feel effortless, luxurious, and intuitive.'],
            ['name'=>'MAAZ ALAM','img'=>'Maaz.jpg','phone'=>'+92 337 6267599','whatsapp'=>'+92 337 6267599','desc'=>'I specialize in creating smooth, interactive experiences for jewellery and cosmetics e-commerce platforms. My work ensures that every user journey feels luxurious, intuitive, and visually appealing, blending creativity with modern web technologies.'],
            ['name'=>'MAHAM AHSAN','img'=>'Maham.jpg','phone'=>'+923499786708','whatsapp'=>'+923499786708','desc'=>'Focused on intuitive web design and smooth interactions, I bring creativity and attention to detail in every project. I ensure every interface feels modern, accessible, and visually appealing to all users.'],
            ['name'=>'CHAUDARY WAQAS ALI','img'=>'Waqas.jpg','phone'=>'+923332464774','whatsapp'=>'+923332464774','desc'=>'Dedicated to building clean, functional, and visually appealing front-end solutions. I combine creativity with practical coding skills to enhance user experience on every device.'],
            ['name'=>'WALEED KHAN','img'=>'Waleed.jpg','phone'=>'+92 300 1234567','whatsapp'=>'+92 300 1234567','desc'=>'Fueled by a passion for clean code and sharp design, I specialize in creating responsive front-end solutions that adapt beautifully across all devices. My work combines UI/UX principles with interactive elements to elevate every user journey.'],
        ];
    @endphp

    <div class="row g-4 justify-content-center">
        @foreach($team as $member)
        <div class="col-md-4 col-sm-6 col-12 d-flex" data-wow-delay="{{ $loop->index * 150 }}ms">
            <div class="team-card p-4 rounded-4 shadow-sm w-100 wow fadeInUp">

                <img src="{{ asset('User/img/'.$member['img']) }}" class="profile-img rounded-circle mb-3 mx-auto d-block" alt="{{ $member['name'] }}">
                <h4 class="text-white mb-2">{{ $member['name'] }}</h4>
                <p class="text-light mb-3 description">{{ $member['desc'] }}</p>

                <!-- Skills Icons -->
                <p class="skills mb-3 text-start">
                    <i class="fab fa-html5 text-danger"></i> HTML &nbsp;
                    <i class="fab fa-css3-alt text-primary"></i> CSS &nbsp;
                    <i class="fab fa-js-square text-warning"></i> JS &nbsp;
                    <i class="bi bi-bootstrap-fill text-purple"></i> Bootstrap &nbsp;
                    <i class="fab fa-js-square text-info"></i> jQuery &nbsp;
                    <i class="fas fa-palette text-success"></i> UI/UX &nbsp;
                    <i class="fas fa-magic text-teal"></i> GSAP &nbsp;
                    <i class="fas fa-database text-danger"></i> MySQL &nbsp;
                    <i class="fab fa-php text-indigo"></i> PHP &nbsp;
                    <i class="fab fa-laravel text-danger"></i> Laravel &nbsp;
                    <i class="fab fa-wordpress text-primary"></i> WP
                </p>

                <!-- Social & Contact -->
               <!-- Social & Contact -->
<div class="social-icons mt-2 text-center">
    @if($member['name'] == 'ZARA IQBAL')
           <span onclick="alert('{{ $member['name'] }} Phone: {{ $member['phone'] }}')"><i class="fas fa-phone interactive-icon"></i></span>
        <span onclick="alert('{{ $member['name'] }} WhatsApp: {{ $member['whatsapp'] }}')"><i class="fab fa-whatsapp interactive-icon"></i></span>
        <a href="https://www.facebook.com/profile.php?id=61557016803993" target="_blank"><i class="fab fa-facebook-f interactive-icon"></i></a>
        <a href="https://www.linkedin.com/in/zara-iqbal-1a148a35b/" target="_blank"><i class="fab fa-linkedin-in interactive-icon"></i></a>
        <a href="https://github.com/ZaraIqbal19" target="_blank"><i class="fab fa-github interactive-icon"></i></a>
    @elseif($member['name'] == 'MAAZ ALAM')
           <span onclick="alert('{{ $member['name'] }} Phone: {{ $member['phone'] }}')"><i class="fas fa-phone interactive-icon"></i></span>
        <span onclick="alert('{{ $member['name'] }} WhatsApp: {{ $member['whatsapp'] }}')"><i class="fab fa-whatsapp interactive-icon"></i></span>
        <a href="https://www.facebook.com/share/16k45WU8Kb/" target="_blank"><i class="fab fa-facebook-f interactive-icon"></i></a>
        <a href="https://www.linkedin.com/in/maaz-alam-9a232834b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="fab fa-linkedin-in interactive-icon"></i></a>
        <a href="https://github.com/Maaz-alam2508" target="_blank"><i class="fab fa-github interactive-icon"></i></a>
        <a href="https://www.instagram.com/maaz.alam_._25?igsh=a2xhcGFtMjNwNnI3" target="_blank"><i class="fab fa-instagram interactive-icon"></i></a>
    @elseif($member['name'] == 'WALEED KHAN')
         <span onclick="alert('{{ $member['name'] }} Phone: {{ $member['phone'] }}')"><i class="fas fa-phone interactive-icon"></i></span>
        <span onclick="alert('{{ $member['name'] }} WhatsApp: {{ $member['whatsapp'] }}')"><i class="fab fa-whatsapp interactive-icon"></i></span>
        <a href="https://www.facebook.com/share/191q3KC93r/?mibextid=wwXIfr" target="_blank"><i class="fab fa-facebook-f interactive-icon"></i></a>
        <a href="https://www.linkedin.com/in/waleed-khan-01630b2b5?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><i class="fab fa-linkedin-in interactive-icon"></i></a>
        <a href="https://github.com/waleed-255" target="_blank"><i class="fab fa-github interactive-icon"></i></a>
        <a href="https://www.instagram.com/waleedkhan123287?igsh=MWd1N3B3ejg0aDBudg%3D%3D&utm_source=qr" target="_blank"><i class="fab fa-instagram interactive-icon"></i></a>
    @else
        <!-- Maham & Waqas keep default alerts -->
        <span onclick="alert('{{ $member['name'] }} Phone: {{ $member['phone'] }}')"><i class="fas fa-phone interactive-icon"></i></span>
        <span onclick="alert('{{ $member['name'] }} WhatsApp: {{ $member['whatsapp'] }}')"><i class="fab fa-whatsapp interactive-icon"></i></span>
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f interactive-icon"></i></a>
        <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in interactive-icon"></i></a>
        <a href="https://github.com" target="_blank"><i class="fab fa-github interactive-icon"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram interactive-icon"></i></a>
    @endif
</div>


            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Styles -->
<style>
body, h1, h2, h3, h4, h5, h6, p, a, span {
    font-family: 'Poppins', sans-serif;
}
h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }

.team-card {
    background-color: #1b1b1b;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}
.profile-img {
    width: 140px;
    height: 140px;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.profile-img:hover { transform: scale(1.1); }
.interactive-icon {
    font-size: 1.4rem;
    margin: 0 5px;
    transition: transform 0.2s ease, color 0.2s ease;
    cursor: pointer;
    color: #ff2a95;
}
.interactive-icon:hover { transform: scale(1.2); color: #d31876; }
.skills i { margin-right: 5px; }
.skills { font-size: 0.85rem; }
.description {
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
}
</style>

<!-- WOW.js for Scroll Animations -->
<script>
$(document).ready(function() {
    new WOW().init();
});
</script>

@endsection

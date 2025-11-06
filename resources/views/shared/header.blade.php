<header id="header" class="app-header">
    <nav class="app-nav">
        <div class="nav-main-container">
            <a href="{{ route('start') }}" class="logo-a">
                <div class="nav-item-container">
                    <img src="{{ url('images/logo.png') }}" class="logo-img">
                    <span class="logo-txt">{{ $logo_text }}</span>
                </div>
            </a>
            <div class="nav-item-container">
                <a href="{{ url("/en/" . get_cleaned_uri()) }}" class="a-lng" title="english">
                    <img src="{{ url('images/united_kingdom.png') }}" class="a-img" alt="english">
                </a>
                <a href="{{ url("/uk/" . get_cleaned_uri()) }}" class="a-lng" title="українська">
                    <img src="{{ url('images/ukrainian.png') }}" class="a-img" alt="українська">
                </a>
            </div>
        </div>
        <div>
            <div id="hamburger_menu">
                <span class=""></span>
                <span class=""></span>
                <span class=""></span>
            </div>
        </div>
    </nav>
    <div id="nav-menu-list" class="nav-menu-list">
        <ul class="side-menu">
            <li>
                <a href="{{ route('start') }}"
                   class="side-menu-li  <?php echo $page->slug === 'index' ? 'active' : null ?>">
                    <div class="i-container">
                        <i class="fas fa-home fa-lg"></i>
                    </div>
                    <span>{{ __('views.index.thumbnail_picker') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('posts') }}"
                   class="side-menu-li <?php echo $page->slug === 'posts' ? 'active' : null ?>">
                    <div class="i-container">
                        <i class="fas fa-fire-alt fa-lg"></i>
                    </div>
                    <span>{{ __('views.index.blog') }}</span>
                </a>
            </li>
        </ul>
    </div>
</header>

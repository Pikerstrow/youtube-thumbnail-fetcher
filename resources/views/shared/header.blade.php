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
                <a href="{{ url("/ru/" . get_cleaned_uri()) }}" class="a-lng" title="русский">
                    <img src="{{ url('images/russian.png') }}" class="a-img" alt="русский">
                </a>
            </div>
        </div>
        <div>
            <div @click="toggleActive" id="hamburger_menu">
                <span :class="{'active': isActive}"></span>
                <span :class="{'active': isActive}"></span>
                <span :class="{'active': isActive}"></span>
            </div>
        </div>
    </nav>
    <div class="nav-menu-list" :class="{'active': isActive}">
        <ul class="side-menu">
            <li>
                <a href="{{ route('start') }}"
                   class="side-menu-li  <?php echo $page->slug === 'index' ? 'active' : null ?>">
                    <div class="i-container">
                        <i class="fas fa-home fa-lg"></i>
                    </div>
                    <span>Thumbnail Picker</span>
                </a>
            </li>
            <li>
                <a href="{{ route('posts') }}"
                   class="side-menu-li <?php echo $page->slug === 'posts' ? 'active' : null ?>">
                    <div class="i-container">
                        <i class="fas fa-fire-alt fa-lg"></i>
                    </div>
                    <span>Blog</span>
                </a>
            </li>
        </ul>
    </div>
</header>

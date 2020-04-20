<header id="header" class="app-header">
    <nav class="app-nav">
        <div class="nav-main-container">
            <div class="nav-item-container">
                <img src="{{ url('images/logo.png') }}" class="logo-img">
                <span class="logo-txt">{{ $logo_text }}</span>
            </div>
            <div class="nav-item-container">
                <a href="{{ url('/en') }}" class="a-lng" title="english">
                    <img src="{{ url('images/united_kingdom.png') }}" class="a-img" alt="english">
                </a>
                <a href="{{ url('/ru') }}" class="a-lng" title="русский">
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

    </div>
</header>

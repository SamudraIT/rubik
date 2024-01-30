<aside id="sidebar">
  <div class="logo">
    <img src="{{ asset('img/logo.png') }}" alt="logo" />
    <h4>Rubik</h4>
  </div>
  <ul class="sidebar-nav">
    <span class="sidebar-group">Overview</span>
    <li>
      <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="lni lni-grid-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <span class="sidebar-group">Laporan</span>
    <li>
      <a href="/dashboard/kasus" class="sidebar-link {{ request()->is('dashboard/kasus') ? 'active' : '' }}">
        <i class="lni lni-postcard"></i>
        <span>Kasus DBD</span>
      </a>
    </li>
    <li>
      <a href="/dashboard/jentik" class="sidebar-link {{ request()->is('dashboard/jentik') ? 'active' : '' }}">
        <i class="lni lni-postcard"></i>
        <span>Jentik</span>
      </a>
    </li>
    <span class="sidebar-group">Inventory</span>
    <li>
      <a href="/dashboard/kecamatan" class="sidebar-link {{ request()->is('dashboard/kecamatan') ? 'active' : '' }}">
        <i class="lni lni-map-marker"></i>
        <span>Kecamatan</span>
      </a>
    </li>
    <li>
      <a href="/dashboard/kelurahan" class="sidebar-link {{ request()->is('dashboard/kelurahan') ? 'active' : '' }}">
        <i class="lni lni-map-marker"></i>
        <span>Kelurahan</span>
      </a>
    </li>
    <li>
      <a href="/dashboard/rumah-sakit" class="sidebar-link {{ request()->is('dashboard/rumah-sakit') ? 'active' : '' }}">
        <i class="lni lni-hospital"></i>
        <span>Rumah Sakit</span>
      </a>
    </li>
    <span class="sidebar-group">Akun & Roles</span>
    <li>
      <a href="/dashboard/akun" class="sidebar-link {{ request()->is('dashboard/akun') ? 'active' : '' }}">
        <i class="lni lni-user"></i>
        <span>Akun</span>
      </a>
    </li>
    <li>
      <a href="/dashboard/roles" class="sidebar-link {{ request()->is('dashboard/roles') ? 'active' : '' }}">
        <i class="lni lni-lock"></i>
        <span>Roles</span>
      </a>
    </li>
  </ul>
</aside>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Risto Menu</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">RM</a>
      </div>
      <ul class="sidebar-menu">
        {{-- <li class="menu-header">Ordini</li> --}}
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown "><i class="fas fa-fire"></i><span>Ordini</span></a>
          <ul class="dropdown-menu">
            <li ><a class="nav-link" href="index-0.html">Lista Ordini</a></li>
            <li><a class="nav-link" href="index.html">Dashboard ordini</a></li>
          </ul>
        </li>
        {{-- <div class="dropdown-divider"></div> --}}
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown "><i class="fas fa-fire"></i><span>Menu</span></a>
          <ul class="dropdown-menu">
            <li ><a class="nav-link" href="{{route('admin.category.index')}}">Categorie</a></li>
            <li><a class="nav-link" href="index.html">Piatti</a></li>
            <li><a class="nav-link" href="{{route('admin.allergeni.index')}}">Allergeni</a></li>
          </ul>
        </li>
      </ul>
    </aside>
</div>
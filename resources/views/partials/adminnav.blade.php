<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ '/admin' }}"><img src="{{ asset('img/logo.png'); }}" alt="logo" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item me-3">
          <a class="nav-link active" aria-current="page" href="{{ '/admin' }}">Home</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="{{ '/admin/view' }}">View Furniture</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="{{ '/admin/addItem' }}">Add Furniture</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="{{ '/admin/profile' }}">Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
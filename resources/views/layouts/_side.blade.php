<section class="card">
	<nav class="nav flex-column">
	  	<a href="{{ route('admin') }}" class="nav-link">Dashboard</a>
	  	<a href="{{ route('article.admin') }}" class="nav-link">Articles</a>
	  	@if( auth()->user()->is_admin )
	  		<a href="{{ route('category.admin') }}" class="nav-link">Categories</a>
	  		<a href="{{ route('admin') }}" class="nav-link">Users</a>
	  	@endif
	</nav>
</section>
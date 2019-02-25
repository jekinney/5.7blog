@if( count($articles) > 0 )
	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				@if ( $show )
					<th>Category</th>
				@endif
				<th width="15%" class="text-center">Author</th>
				<th width="15%" class="text-center">Publish</th>
				<th width="15%" class="text-center">Options</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $articles as $art )
				<tr>
					<td>{{ $art->title }}</td>
					@if ( $show )
						<td>{{ $art->category->title }}</td>
					@endif
					<td class="text-center">{{ $art->author->name }}</td>
					<td class="text-center">{{ $art->display_publish }}</td>
					<td class="text-center">
						<a href="{{ route('article.edit', $art) }}" class="btn btn-sm btn-info">Edit</a>
						<a href="{{ route('article.details', $art) }}" class="btn btn-sm btn-success">Details</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<article class="card-body">
		<div class="alert alert-info">
			<p class="text-center"><strong>No articles to display.</strong></p>
		</div>
	</article>
@endif
@extends('templates.aboutme.master_blog')
@section('content')
<section class="not-found">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="code">
					404
				</div>
				<h1>Page could not be found</h1>
				<p class="lead">The page you are looking for is not available please check the url you are going to.</p>
				<div class="search-form">							
					<form action="{{route('aboutme.abmnews.search')}}" method="GET">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="Type something ..." value="{{isset($text) ? $text : ''}}">
								<div class="input-group-btn">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</form>								
					<div class="link">
						or <a href="{{route('aboutme.abmnews.index')}}">back to home</a>.
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
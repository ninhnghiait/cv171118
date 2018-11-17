    <footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="block">
						<h1 class="block-title">Info</h1>
						<div class="block-body">
							<figure class="foot-logo">
								<a href=""><img src="/templates/blog/images/logo-white.png" class="img-responsive" alt="NinhNghiaIt"></a>
							</figure>
							<p class="brand-description" style="font-family: 'Kaushan Script', cursive;">
								Dù người ta có nói với bạn điều gì đi nữa, hãy tin rằng cuộc sống là điều kỳ diệu và đẹp đẽ.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="block">
						<h1 class="block-title">Tags</h1>
						<div class="block-body">
							<ul class="tags">
								@foreach ($objItemsCat as $vc)
								<li><a href="{{route('aboutme.abmnews.tag',str_slug($vc['name']))}}">{{$vc['name']}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-4">
					<div class="block">
						<h1 class="block-title">Follow Me</h1>
						<div class="block-body">
							<ul class="social trp">
								<li>
									<a href="{{$objItemIntro->fb}}" class="facebook">
										<svg><rect width="0" height="0"/></svg>
										<i class="ion-social-facebook"></i>
									</a>
								</li>
								<li>
									<a href="{{$objItemIntro->tt}}" class="twitter">
										<svg><rect width="0" height="0"/></svg>
										<i class="ion-social-twitter-outline"></i>
									</a>
								</li>
								<li>
									<a href="{{$objItemIntro->gg}}" class="googleplus">
										<svg><rect width="0" height="0"/></svg>
										<i class="ion-social-googleplus"></i>
									</a>
								</li>
								<li>
									<a href="{{$objItemIntro->ig}}" class="instagram">
										<svg><rect width="0" height="0"/></svg>
										<i class="ion-social-instagram-outline"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="line"></div>
					<div class="block">
						<div class="block-body no-margin">
							<ul class="footer-nav-horizontal">
								<li><a href="{{route('aboutme.abmnews.index')}}">Home</a></li>
								<li><a href="{{route('aboutme.abmindex.index')}}">My CV</a></li>
								<li><a href="{{route('aboutme.abmindex.index')}}">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->
	<!-- JS -->
	<script src="/templates/blog/js/jquery.js"></script>
	<script src="/templates/blog/js/jquery.migrate.js"></script>
	<script src="/templates/blog/scripts/bootstrap/bootstrap.min.js"></script>
	<script>var $target_end=$(".best-of-the-week");</script>
	<script src="/templates/blog/scripts/jquery-number/jquery.number.min.js"></script>
	<script src="/templates/blog/scripts/owlcarousel/dist/owl.carousel.min.js"></script>
	<script src="/templates/blog/scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
	<script src="/templates/blog/scripts/easescroll/jquery.easeScroll.js"></script>
	<script src="/templates/blog/scripts/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/templates/blog/scripts/toast/jquery.toast.min.js"></script>
	<script src="/templates/blog/js/demo.js"></script>
	<script src="/templates/blog/js/e-magz.js"></script>
	@yield ('js')
</body>
</html>
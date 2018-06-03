<!-- Listings Section -->
<section class="listings-home pt-0 bg-black-3" id="listings">
    <div class="container">
        <header class="text-center">
            <h2>
                Browse Listings in
                <span class="text-primary">these areas</span>
            </h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p class="template-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</p>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-7">
                <div class="listing-home"><img src="img/yangon.jpg" alt="...">
                    @foreach ($yangonRegionId as $id)
                        <a href="/houses/regions/{{$id}}" class="text no-anchor-style">
                    @endforeach
                    <h3>Yangon</h3>
                    <p>On the other hand, we denounce</p></a>
                    <div class="ribbon text-center"><strong class="d-block">{{$countOfYangon}}</strong><small>Listings</small></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="listing-home"><img src="img/mandalay.jpg" alt="...">
                    @foreach ($mandalayRegionId as $id)
                        <a href="/houses/regions/{{$id}}" class="text no-anchor-style">
                    @endforeach
                    <h3>Mandalay</h3>
                    <p>On the other hand, we denounce</p></a>
                    <div class="ribbon text-center"><strong class="d-block">{{$countOfMandalay}}</strong><small>Listings</small></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="listing-home"><img src="img/naypyitaw.jpg" alt="...">
                    @foreach ($naypyitawRegionId as $id)
                        <a href="/houses/regions/{{$id}}" class="text no-anchor-style">
                    @endforeach
                    <h3>Nay Pyi Taw</h3>
                    <p>On the other hand, we denounce</p></a>
                    <div class="ribbon text-center"><strong class="d-block">{{$countOfNayPyiTaw}}</strong><small>Listings</small></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="listing-home mb-0"><img src="img/pyioolwin.jpg" alt="...">
                    @foreach ($pyioolwinRegionId as $id)
                        <a href="/houses/regions/{{$id}}" class="text no-anchor-style">
                    @endforeach
                    <h3>Pyi Oo Lwin</h3>
                    <p>On the other hand, we denounce</p></a>
                    <div class="ribbon text-center"><strong class="d-block">{{$countOfPyiOoLwin}}</strong><small>Listings</small></div>
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section>

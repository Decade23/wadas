<section id="section-news" class="page-section">
        <div class="container clearfix">
            <div class="heading-block center">
                <h2>News</h2>
            </div>
            @if(count($data))
                <h3 class="center">Covid Updated At: <strong>{{ date('d M Y', strtotime($data['Date'])) }}</strong></h3>
                    <div class="col_one_fourth" data-animate="bounceIn">
                        <div class="counter counter-large counter-lined"><span data-from="0" data-to="{{ $data['TotalConfirmed'] }}" data-refresh-interval="20" data-speed="2000"></span></div>
                        <h5><span class="badge badge-pill badge-light">Terkonfirmasi</span></h5>
                    </div>
                    <div class="col_one_fourth">
                        <div class="counter counter-large counter-lined"><span data-from="0" data-to="{{ ($data['TotalConfirmed'] - ($data['TotalRecovered']  + $data['TotalDeaths'])) }}" data-refresh-interval="20" data-speed="2050"></span></div>
                        <h5><span class="badge badge-pill badge-warning">Dalam Perawatan</span></h5>
                    </div>
                    <div class="col_one_fourth">
                        <div class="counter counter-large counter-lined"><span data-from="0" data-to="{{ $data['TotalRecovered'] }}" data-refresh-interval="20" data-speed="2100"></span></div>
                        <h5><span class="badge badge-pill badge-success">Sembuh</span></h5>
                    </div>
                    <div class="col_one_fourth col_last">
                        <div class="counter counter-large counter-lined"><span data-from="0" data-to="{{ $data['TotalDeaths'] }}" data-refresh-interval="20" data-speed="2150"></span></div>
                        <h5><span class="badge badge-pill badge-danger">Meninggal</span></h5>
                    </div>
            @else
                <h3 class="center">No News <strong>Updated</strong>.</h3>
            @endif
        </div>
</section>

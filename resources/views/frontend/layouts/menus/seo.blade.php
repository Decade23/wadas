<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="{{ $seo_author ?? 'DediF' }}" />
<meta name="keywords" content="{{ $seo_keywords ?? 'eci, eci bisnis manajemen, expert club indonesia, expert, club, indoensia, consulting, bisnis' }}" />
<meta name="description" content="{{ $seo_description ?? 'Expert Club  Indonesia' }}" />

<meta property="og:site_name" content="{{ $seo_og_site_name ?? 'ECI Bisnis Manajemen' }}">
<meta property="og:url" content="{{ $seo_og_url ?? request()->fullUrl() }}"/>
<meta property="og:title" content="{{ $seo_og_title ?? 'Expert Club Indonesia' }}"/>
<meta property="og:description" content="{{ $seo_og_description ?? 'Training & Consultant Center' }}"/>
<meta property="og:image" itemprop="image"  content="{{ $seo_og_image ?? asset('eci/logo/eci_logo_no_bg.png') }}"/>
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<meta name=”robots” content="{{ $seo_robots ?? 'index, follow' }}">

<meta name="viewport" content="width=device-width, initial-scale=1" />

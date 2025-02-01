<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

		<meta name="theme-color" content="#6777ef"/>
		<link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
		<link rel="manifest" href="{{ asset('/manifest.json') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
		<script src="{{ asset('/sw.js') }}"></script>
		<script>
			if (!navigator.serviceWorker.controller) {
				navigator.serviceWorker.register("/sw.js").then(function (reg) {
					console.log("Service worker has been registered for scope: " + reg.scope);
				});
			}
		</script>
    </body>
</html>

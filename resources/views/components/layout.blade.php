<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($eventLogo) }}">
    <title>{{ $eventTitle }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-black antialiased">
    {{ $slot }}

    <script>
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href && !link.hash && link.origin === window.location.origin && link.target !== '_blank') {
                // Ignore download links or explicitly ignored links
                if (link.hasAttribute('download') || link.classList.contains('no-transition')) return;
                
                e.preventDefault();
                document.body.classList.add('page-exit');
                setTimeout(() => {
                    window.location = link.href;
                }, 300); // Matches the 0.35s exit animation duration slightly earlier to prevent hang
            }
        });
    </script>
</body>
</html>
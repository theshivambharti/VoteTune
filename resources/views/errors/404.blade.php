<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not Found</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f8f9fa; color: #212529; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .text-center { text-align: center; padding: 2rem; }
        .text-primary { color: #0d6efd; }
        h1 { margin-bottom: 1rem; }
        p { color: #6c757d; margin-bottom: 2rem; }
        a { background: #0d6efd; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="text-primary" style="font-size: 3rem; font-weight: bold; margin-bottom: 1rem;">404</div>
        <h1>Page Not Found</h1>
        <p>The page you are looking for does not exist.</p>
        <a href="{{ url('/') }}">Return home</a>
    </div>
</body>
</html>
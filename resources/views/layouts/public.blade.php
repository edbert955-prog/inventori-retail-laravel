<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('app_name', 'Inventori Pro') }} — {{ setting('app_description', 'Sistem inventori yang tenang') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'glass': '0 4px 30px rgba(0, 0, 0, 0.1)',
                        'subtle': '0 1px 2px rgba(0,0,0,0.02), 0 4px 16px rgba(0,0,0,0.04)',
                        'bento': '0 2px 4px rgba(0,0,0,0.02), 0 8px 24px rgba(0,0,0,0.04)',
                    },
                    colors: {
                        brand: {
                            50: '#f8f9ff',  // MD3 surface
                            100: '#dae2ff', // MD3 primary-fixed
                            800: '#0047ab', // MD3 primary-container
                            900: '#00327d', // MD3 primary (Dashboard consistency)
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            background-color: #ffffff; 
            color: #0a0a0a; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .material-symbols-outlined { 
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; 
        }
    </style>
</head>
<body class="font-sans min-h-screen flex flex-col selection:bg-gray-200">
    <x-public.navbar />
    
    <main class="flex-1">
        @yield('content')
    </main>
</body>
</html>

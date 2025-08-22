<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css'])
    <style>
         :root {
            --primary: #0EA5E9;
            --dark: #0B132B;
            --text: #111827;
            --light: #F8FAFC;
            --warning: #F59E0B;
            --danger: #EF4444;
        }

        html[lang="en"] body {
            font-family: 'Poppins', sans-serif;
                        color: var(--text);

        }

        html[lang="ar"] body {
            font-family: 'Tajawal', sans-serif;
                        color: var(--text);

        }
        .sidebar {
            transition: all 0.3s ease;
            z-index: 40;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            height: 8px;
            border-radius: 4px;
        }
        .active-link {
            background-color: #EFF6FF;
            color: #3B82F6;
            border-left: 4px solid #3B82F6;
        }
         .nav-link:hover {
            color: var(--primary);
        }
        .btn-primary {
            background-color: var(--primary);
        }
        .btn-primary:hover {
            background-color: #0284C7;
        }
         .login-card {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }
         .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .active-link {
            background-color: #3B82F6;
            color: white;
        }
        .active-link:hover {
            background-color: #2563EB;
        }
       
        .main-content {
            transition: all 0.3s ease;
        }

        #admin-modal, #edit-admin-modal {
            transition: opacity 0.3s ease;
        }
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
        @media (max-width: 1276px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        .main-content {
            margin-left: 0 !important; /* prevent extra gap */
        }
        #admin-mobile-menu-button {
            display: block !important;
        }
        #close-sidebar {
            display: block !important;
        }
     
        }
    </style>
    <title>@yield("title")</title>
</head>
<body class="bg-gray-50">



    @yield("content")



       @yield('scripts')
@stack('scripts')
</body>
</html>
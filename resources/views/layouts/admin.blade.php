<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Auvri Plus</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('auri-images/logo.png') }}">
    
    <style>
        * {
            box-sizing: border-box;
        }
        
        :root {
            --primary: #004200; /* Luxury Green */
            --primary-light: #e8f5e9;
            --primary-dark: #004200;
            --secondary: #d4af37; /* Luxury Gold */
            --dark: #121212;
            --theme-bg-light: #f9f7f2;
            --theme-yellow-light: rgba(212, 175, 55, 0.05);
            --theme-gradient: linear-gradient(180deg, #f9f7f2 0%, #f1ede2 100%);
            --icon-gradient: linear-gradient(135deg, #004200 0%, #006400 50%, #004200 100%);
            --icon-gradient-hover: linear-gradient(135deg, #006400 0%, #004200 100%);
            --text-dark: #333;
            --text-muted: #6b6f7a;
            --card-bg: #fff;
            --card-border: #e0e0e0;
            --card-shadow: 0 10px 25px rgba(0, 66, 0, 0.05);
            --card-shadow-soft: 0 5px 15px rgba(0, 0, 0, 0.03);
            --text-gold: #d4af37;
            --gold-gradient: linear-gradient(135deg, #d4af37, #f9d976);
            --luxury-green-soft: rgba(0, 66, 0, 0.05);
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            background: #f8faf8; /* Subtle green-tinted neutral */
            min-height: 100vh;
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .admin-wrapper::before {
            display: none;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #fff;
            border-right: 1px solid var(--card-border);
            box-shadow: 10px 0 25px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: all 0.3s ease;
            border-radius: 0 26px 26px 0;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background: #fff;
        }

        .sidebar-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow-soft);
        }

        .sidebar-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: #fff;
            border-radius: 50%;
            padding: 6px;
            border: 1px solid rgba(0,0,0,0.05);
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.05));
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 30px;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .menu-link i {
            width: 25px;
            margin-right: 15px;
            font-size: 18px;
            color: var(--primary);
            pointer-events: none;
        }

        .menu-link:hover, .menu-link.active {
            color: var(--primary);
            background: var(--luxury-green-soft);
            border-left-color: var(--primary);
        }

        .menu-link::after {
            content: '';
            position: absolute;
            left: -6px;
            top: 50.0%;
            transform: translateY(-50.0%);
            width: 8px;
            height: 60.0%;
            background: var(--icon-gradient);
            border-radius: 999px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .menu-link:hover::after, .menu-link.active::after {
            opacity: 1;
        }

        /* Sub-menu Styles */
        .has-submenu {
            cursor: pointer;
        }

        .submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            background: var(--luxury-green-soft);
            display: none;
        }

        .has-submenu.open .submenu {
            display: block;
        }

        .submenu-link {
            display: flex;
            align-items: center;
            padding: 10px 30px 10px 60px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
            position: relative;
        }

        .submenu-link:hover, .submenu-link.active {
            color: var(--primary);
            background: var(--luxury-green-soft);
        }

        .submenu-link i {
            font-size: 10px;
            margin-right: 10px;
            color: var(--primary);
            pointer-events: none;
        }

        .menu-link .arrow {
            margin-left: auto;
            font-size: 12px;
            transition: transform 0.3s ease;
            pointer-events: none;
        }

        .has-submenu.open .menu-link .arrow {
            transform: rotate(90deg);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
            position: relative;
            isolation: isolate;
            min-width: 0; /* Prevents flex blowout on table overflow */
        }

        .main-content::before {
            display: none;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px 30px;
            background: #fff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            box-shadow: var(--card-shadow-soft);
            position: relative;
        }

        .top-bar::after {
            content: '';
            position: absolute;
            left: 24px;
            right: 24px;
            bottom: 10px;
            height: 2px;
            background: var(--primary);
            opacity: 0.1;
            border-radius: 999px;
        }

        .page-title h1 {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            text-shadow: none;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #fff;
            padding: 8px 20px;
            border-radius: 50px;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow-soft);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: var(--icon-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
        }

        /* Stats Card */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 4px;
            background: var(--icon-gradient);
            opacity: 0.5;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 152, 0, 0.1);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 20px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Tables & Lists */
        .content-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            position: relative;
        }

        .card-header::after {
            display: none;
        }

        .card-header h3 {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }

        @media (max-width: 576px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 20px;
            }
            .card-header .admin-btn {
                width: 100%;
                justify-content: center;
            }
            .user-info {
                display: none;
            }
        }

        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: auto;
            min-width: 900px;
            margin: 0;
            padding: 0;
            border: none;
        }

        .admin-table th, .admin-table td {
            text-align: left;
            padding: 18px 24px;
            vertical-align: middle;
            border: none;
            line-height: 1.5;
            white-space: nowrap;
        }

        .admin-table thead tr {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            border-radius: 8px; /* Tries to round row if browser supports */
        }

        .admin-table th {
            background: transparent;
            font-size: 12px;
            font-weight: 700;
            color: inherit;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        /* Rounded corners for the container row effect */
        .admin-table th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .admin-table th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .admin-table td {
            background: #fff;
            font-size: 14px;
            color: var(--text-dark);
            border-bottom: 1px solid rgba(0,0,0,0.02);
            transition: all 0.2s ease;
        }

        /* AJAX Filtering State */
        .content-card {
            position: relative;
            transition: all 0.3s ease;
        }

        .content-card.filtering {
            opacity: 0.6;
            pointer-events: none;
            filter: grayscale(0.5);
        }

        .content-card.filtering::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border: 3px solid rgba(194, 24, 91, 0.1);
            border-top-color: #c2185b;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            z-index: 10;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .admin-table tbody tr {
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }/* Remove default even child background to match the clean white look */
        .admin-table tbody tr:nth-child(even) td {
            background: #fff;
        }

        .admin-table tbody tr:hover td {
            background: #fff9fa;
        }

        /* Form Elements */
        .admin-form-group {
            margin-bottom: 20px;
        }

        .admin-form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .admin-input, .admin-select, .admin-textarea {
            width: 100.0%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: #fff;
            color: var(--text-dark);
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0.0, 0.0, 0.0, 0.02);
        }

        .admin-input:focus, .admin-select:focus, .admin-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 152, 0, 0.1);
        }

        .admin-input:read-only {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.05);
            color: #777;
            cursor: not-allowed;
        }

        .admin-input::placeholder {
            color: #bbb;
        }

        .admin-textarea {
            resize: vertical;
            min-height: 100.0px;
        }

        .admin-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25.0px;
        }

        @media (max-width: 768px) {
            .admin-form-grid {
                grid-template-columns: 1fr;
                gap: 15.0px;
            }
            .admin-form-grid > * {
                grid-column: span 1 !important;
            }
        } 
        
        .p-responsive {
            padding: 40px;
        }
        
        @media (max-width: 768px) {
            .p-responsive {
                padding: 20px;
            }
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
            text-transform: uppercase;
            min-width: 90px;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .status-success { 
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(76, 175, 80, 0.2) 100%); 
            color: #2e7d32; 
            border-color: rgba(76, 175, 80, 0.2);
        }
        .status-warning { 
            background: linear-gradient(135deg, rgba(255, 152, 0, 0.1) 0%, rgba(255, 152, 0, 0.2) 100%); 
            color: #ef6c00; 
            border-color: rgba(255, 152, 0, 0.2);
        }
        .status-danger { 
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.1) 0%, rgba(244, 67, 54, 0.2) 100%); 
            color: #c62828; 
            border-color: rgba(244, 67, 54, 0.2);
        }

        .cell-wrap {
            white-space: normal !important;
            word-break: break-word;
            overflow: visible !important;
            text-overflow: clip !important;
        }

        .text-nowrap {
            white-space: nowrap !important;
        }
        .action-btn {
            background: #fff;
            border: 1px solid var(--card-border);
            padding: 6px 10px;
            border-radius: 10px;
            color: var(--primary);
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08); /* Neutral shadow */
        }
        
        /* Action Button Specific Colors */
        /* View - Blue */
        .action-btn:has(.fa-eye), .action-btn:has(.fa-file-alt) {
            color: #2196F3;
            border-color: rgba(33, 150, 243, 0.3);
            background: rgba(33, 150, 243, 0.05);
        }
        .action-btn:has(.fa-eye):hover, .action-btn:has(.fa-file-alt):hover {
            background: #2196F3;
            color: #fff;
            border-color: #2196F3;
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.25);
        }

        /* Edit - Green */
        .action-btn:has(.fa-edit) {
            color: #4CAF50;
            border-color: rgba(76, 175, 80, 0.3);
            background: rgba(76, 175, 80, 0.05);
        }
        .action-btn:has(.fa-edit):hover {
            background: #4CAF50;
            color: #fff;
            border-color: #4CAF50;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.25);
        }

        /* Password - Orange */
        .action-btn:has(.fa-key) {
            color: #FF9800;
            border-color: rgba(255, 152, 0, 0.3);
            background: rgba(255, 152, 0, 0.05);
        }
        .action-btn:has(.fa-key):hover {
            background: #FF9800;
            color: #fff;
            border-color: #FF9800;
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.25);
        }

        /* Delete - Red */
        .action-btn:has(.fa-trash-alt), .action-btn:has(.fa-trash) {
            color: #F44336;
            border-color: rgba(244, 67, 54, 0.3);
            background: rgba(244, 67, 54, 0.05);
        }
        .action-btn:has(.fa-trash-alt):hover, .action-btn:has(.fa-trash):hover {
            background: #F44336;
            color: #fff;
            border-color: #F44336;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.25);
        }

        .action-flex {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: nowrap;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 999px;
            border: 1px solid var(--card-border);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 0 8px 16px rgba(194, 24, 91, 0.08);
        }

        .admin-btn-primary {
            color: #fff;
            background: var(--icon-gradient);
            box-shadow: 0 10px 20px rgba(194, 24, 91, 0.2);
        }

        .admin-btn-primary:hover {
            background: var(--icon-gradient-hover);
        }

        .admin-btn-ghost {
            background: #fff;
            color: var(--primary-dark);
        }

        /* Anim */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20.0px); }
            to { opacity: 1; transform: translateY(0.0); }
        }

        .animate-fade {
            animation: fadeIn 0.6s ease forwards;
        }

        /* Mobile Responsive Sidebar */
        .mobile-toggle {
            display: none;
            font-size: 22px;
            color: var(--primary);
            cursor: pointer;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow-soft);
            margin-right: 15px;
            transition: all 0.2s ease;
        }
        
        .mobile-toggle:active {
            transform: scale(0.95);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
            /* Mobile Styling Refinements */
            .sidebar-menu {
                overflow-y: auto;
                height: 100%;
                /* Custom Scrollbar for Sidebar */
                scrollbar-width: thin;
                scrollbar-color: rgba(0,0,0,0.1) transparent;
            }
            .sidebar-menu::-webkit-scrollbar {
                width: 4px;
            }
            .sidebar-menu::-webkit-scrollbar-thumb {
                background: rgba(0,0,0,0.1);
                border-radius: 4px;
            }

            .main-content {
                transition: margin-left 0.3s ease;
            }

            @media (max-width: 992px) {
                .sidebar { 
                    position: fixed;
                    left: -290px;
                    top: 0;
                    bottom: 0;
                    width: 280px;
                    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 5px 0 25px rgba(0,0,0,0.15);
                }
                
                .sidebar.active {
                    transform: translateX(290px);
                }
                
                .main-content { 
                    margin-left: 0; 
                    padding: 15px; /* Reduced padding */
                    width: 100%;
                }
                
                .mobile-toggle { 
                    display: flex; 
                }
                
                .top-bar {
                    padding: 12px 20px;
                    margin-bottom: 25px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    flex-wrap: nowrap; /* Prevent wrapping */
                    gap: 10px;
                }
                
                .page-title h1 {
                    font-size: 18px; /* Slightly smaller for mobile */
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: 200px; /* Limit width */
                }
                
                .action-label, .menu-link span, .sidebar-title { 
                    display: inline-block; 
                }
                
                /* Restore full sidebar look on mobile when active */
                .sidebar-logo { width: 80px; height: 80px; }
                .menu-link { justify-content: flex-start; padding: 12px 30px; }
                .menu-link i { margin-right: 15px; }

                /* Prevent Zoom on inputs for iOS */
                .admin-input, .admin-select, .select2-selection {
                    font-size: 16px !important; 
                }
            }

            @media (max-width: 576px) {
                .page-title h1 {
                    max-width: 150px; /* Smaller limit for very small screens */
                    font-size: 16px;
                }
                
                /* Adjust filters stacking */
                .card-header {
                    flex-direction: column;
                    align-items: stretch; /* Full width children */
                    gap: 15px;
                    padding: 20px;
                }
                
                .card-header h3 {
                    margin-bottom: 5px;
                }
                
                .card-header form {
                    flex-direction: column;
                    align-items: stretch !important;
                    width: 100%;
                }
                
                .card-header input, 
                .card-header .select2-container, 
                .card-header select {
                    width: 100% !important;
                    min-width: 0 !important;
                    flex: none !important;
                }
                
                .card-header .admin-btn {
                    width: 100%;
                    justify-content: center;
                }
                
                .user-info {
                    display: none;
                }
                
                .top-bar {
                    gap: 10px;
                }
                
                .stats-grid {
                    grid-template-columns: 1fr;
                }
                
                .admin-form-grid {
                    gap: 15px;
                }
                
                /* Fix Search Input Containers in Card Headers */
                .card-header div[style*="position: relative"] {
                    width: 100%;
                }
            }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 5px;
            border-radius: 12px;
            background: #fff;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid var(--card-border);
            transition: all 0.2s ease;
            box-shadow: var(--card-shadow-soft);
        }

        .page-item.active .page-link {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 12px var(--luxury-green-soft);
        }

        .page-item.disabled .page-link {
            background: rgba(0,0,0,0.02);
            color: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }

        .page-item .page-link:hover:not(.disabled .page-link) {
            transform: translateY(-2px);
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-item.active .page-link:hover {
            color: #fff;
            background: var(--primary-dark);
        }

        /* Custom Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--beige-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary-light), var(--primary));
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
            border: 1px solid transparent;
            background-clip: content-box;
        }

        /* Ensure horizontal scroll is easy to use */
        /* Ensure horizontal scroll is easy to use */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 5px;
            margin-bottom: 0;
        }
        .text-danger {
            color: #ff4444 !important;
            font-weight: bold;
            margin-left: 2px;
        }
    </style>
    @yield('styles')
    <style>
        #toast-container > .toast {
            opacity: 1 !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
            border-radius: 12px !important;
            border: none !important;
            padding: 18px 18px 18px 50px !important;
            background-image: none !important;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500 !important;
            font-size: 14px !important;
        }
        
        #toast-container > .toast-success { 
            background: linear-gradient(135deg, var(--primary) 0%, #006400 50%, var(--primary-dark) 100%) !important;
        }
        #toast-container > .toast-error { 
            background: linear-gradient(135deg, #FF5252 0%, #D32F2F 100%) !important;
        }
        #toast-container > .toast-info { 
            background: linear-gradient(135deg, #448AFF 0%, #1976D2 100%) !important;
        }
        #toast-container > .toast-warning { 
            background: linear-gradient(135deg, var(--secondary) 0%, #B8860B 100%) !important;
        }
        
        #toast-container > .toast i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px !important;
            background: #fff;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        #toast-container > .toast-success i { color: #F44336; }
        #toast-container > .toast-error i { color: #D32F2F; }
        #toast-container > .toast-info i { color: #1976D2; }
        #toast-container > .toast-warning i { color: #FFA000; }

        .toast-progress {
            background-color: rgba(255, 255, 255, 0.4) !important;
            height: 3px !important;
            opacity: 1 !important;
        }

        .toast-close-button {
            top: -2px !important;
            right: 0px !important;
            font-size: 20px !important;
            font-weight: 300 !important;
            opacity: 0.8 !important;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <div class="sidebar-overlay"></div>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                    <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus" class="sidebar-logo">
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ Route::is('admin.categories*') || Route::is('admin.products*') || Route::is('admin.shipping_info*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link {{ Route::is('admin.categories*') || Route::is('admin.products*') || Route::is('admin.shipping_info*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Catalogs</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.categories') }}" class="submenu-link {{ Route::is('admin.categories*') ? 'active' : '' }}">
                                <i class="fas fa-list-ul"></i>
                               <span>Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products') }}" class="submenu-link {{ Route::is('admin.products*') ? 'active' : '' }}">
                                <i class="fas fa-box"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.shipping_info') }}" class="submenu-link {{ Route::is('admin.shipping_info*') ? 'active' : '' }}">
                                <i class="fas fa-truck"></i>
                                <span>Shipping Info</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item has-submenu {{ Route::is('admin.coupons*') || Route::is('admin.coupon_usages*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link {{ Route::is('admin.coupons*') || Route::is('admin.coupon_usages*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span>Coupons</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.coupons') }}" class="submenu-link {{ Route::is('admin.coupons*') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i>
                               <span>Manage Coupons</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.coupon_usages') }}" class="submenu-link {{ Route::is('admin.coupon_usages*') ? 'active' : '' }}">
                                <i class="fas fa-history"></i>
                                <span>Coupon Usage Log</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.orders') }}" class="menu-link {{ Route::is('admin.orders*') && !Route::is('admin.reports.transactions') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.reports.transactions') }}" class="menu-link {{ Route::is('admin.reports.transactions') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Transaction Report</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.inquiries') }}" class="menu-link {{ Route::is('admin.inquiries*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span>Inquiries</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.blogs') }}" class="menu-link {{ Route::is('admin.blogs*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Blogs</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.testimonials') }}" class="menu-link {{ Route::is('admin.testimonials*') ? 'active' : '' }}">
                        <i class="fas fa-comment-dots"></i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.reviews') }}" class="menu-link {{ Route::is('admin.reviews*') ? 'active' : '' }}">
                        <i class="fas fa-star-half-alt"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.users') }}" class="menu-link {{ Route::is('admin.users*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
               
                <li class="menu-item">
                    <a href="{{ route('admin.profile') }}" class="menu-link {{ Route::is('admin.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.logout') }}" class="menu-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <div class="mobile-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="page-title">
                    <h1>@yield('page_title', 'Dashboard')</h1>
                </div>
                <a href="{{ route('admin.profile') }}" class="user-profile" style="text-decoration: none; color: inherit;">
                    <div class="user-avatar" style="overflow: hidden;">
                        @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->profile_image)
                            <img src="{{ asset(Auth::guard('admin')->user()->profile_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'AD', 0, 2)) }}
                        @endif
                    </div>
                    <div class="user-info">
                        <div style="font-size: 14px; font-weight: 600;">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Admin' }}</div>
                        <div style="font-size: 11px; color: #888;">Administrator</div>
                    </div>
                </a>
            </div>

            <div class="animate-fade">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- jQuery, Select2 and Toastr JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        @if(Session::has('success'))
            toastr.success("<i class='fas fa-check'></i> {{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("<i class='fas fa-times'></i> {{ Session::get('error') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("<i class='fas fa-info'></i> {{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("<i class='fas fa-exclamation'></i> {{ Session::get('warning') }}");
        @endif

        @if($errors->any())
            toastr.error("<i class='fas fa-exclamation-triangle'></i> {{ $errors->first() }}");
        @endif

        // Sidebar Submenu Toggle
        $(document).ready(function() {
            // Mobile Sidebar Toggle
            $('.mobile-toggle').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.sidebar-overlay').toggleClass('active');
            });
            
            $('.sidebar-overlay').on('click', function() {
                $('.sidebar').removeClass('active');
                $(this).removeClass('active');
            });

            // Sidebar Submenu Toggle
            $(document).on('click', '.has-submenu > .menu-link', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent bubbling issues
                var $parent = $(this).parent();
                
                // Close other submenus (Accordion style)
                $('.has-submenu').not($parent).removeClass('open');
                
                $parent.toggleClass('open');
            });

            // Initialize Select2 for searchable dropdowns
            function initSelect2() {
                $('.select2').each(function() {
                    var $el = $(this);
                    $el.select2({
                        width: 'resolve',
                        placeholder: $el.data('placeholder') || $el.attr('placeholder') || 'Select an option',
                        allowClear: true
                    });

                    // Add active-filter class if a value is selected to show a brand border
                    if ($el.val() && $el.val() !== '') {
                        $el.next('.select2-container').addClass('active-filter');
                    } else {
                        $el.next('.select2-container').removeClass('active-filter');
                    }
                });
            }
            initSelect2();

            // Perfect Premium Select2 Styling
            $("<style>")
                .prop("type", "text/css")
                .html(`
                    /* Standardized Filter Heights & Styles */
                    .select2-container--default .select2-selection--single {
                        height: 42px !important;
                        border-radius: 50px !important;
                        border: 1px solid #ddd !important;
                        padding: 0 15px !important;
                        outline: none !important;
                        background: #fff !important;
                        transition: all 0.3s ease !important;
                        display: flex !important;
                        align-items: center !important;
                        position: relative !important;
                    }
                    .select2-container.active-filter .select2-selection--single {
                        border-color: var(--primary) !important;
                        background: var(--luxury-green-soft) !important;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                        line-height: 40px !important;
                        color: #1a1a1a !important;
                        font-size: 13px !important;
                        font-weight: 500 !important;
                        padding-left: 0 !important;
                        padding-right: 20px !important;
                        flex: 1 !important;
                        overflow: hidden !important;
                        text-overflow: ellipsis !important;
                        white-space: nowrap !important;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__placeholder {
                        color: #999 !important;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__arrow {
                        height: 40px !important;
                        top: 0 !important;
                        right: 12px !important;
                        width: 20px !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__arrow b {
                        border-color: #999 transparent transparent transparent !important;
                        border-width: 5px 4px 0 4px !important;
                    }
                    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
                        border-color: transparent transparent var(--primary) transparent !important;
                        border-width: 0 4px 5px 4px !important;
                    }
                    .select2-dropdown {
                        border-radius: 15px !important;
                        box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;
                        border: 1px solid rgba(0,0,0,0.05) !important;
                        margin-top: 5px !important;
                        padding: 5px !important;
                        z-index: 9999 !important;
                    }
                    .select2-results__option {
                        padding: 8px 15px !important;
                        border-radius: 8px !important;
                        font-size: 13px !important;
                    }
                    .select2-results__option--highlighted[aria-selected] {
                        background: var(--icon-gradient) !important;
                    }
                    
                    /* Search Input Standardization */
                    .header-search-input {
                        height: 42px !important;
                        padding: 0 15px 0 40px !important;
                        border-radius: 50px !important;
                        border: 1px solid #ddd !important;
                        outline: none !important;
                        background: #fff !important;
                        width: 100% !important;
                        font-size: 13px !important;
                        transition: all 0.3s ease !important;
                    }
                    .header-search-input:focus {
                        border-color: var(--primary) !important;
                        box-shadow: 0 0 0 4px var(--luxury-green-soft) !important;
                    }
                    .header-search-wrap i {
                        position: absolute;
                        left: 15px;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #999;
                        font-size: 13px;
                        z-index: 1;
                    }
                    
                    /* Card Header Flex Fixes */
                    .card-header-flex {
                        display: flex !important;
                        flex-wrap: wrap !important;
                        gap: 15px !important;
                        align-items: center !important;
                        justify-content: space-between !important;
                    }
                    .card-header-actions {
                        display: flex !important;
                        gap: 12px !important;
                        align-items: center !important;
                        flex-wrap: wrap !important;
                        justify-content: flex-end !important;
                        flex: 1 !important;
                    }
                    .header-filter-form {
                        display: flex !important;
                        gap: 10px !important;
                        align-items: center !important;
                        flex-wrap: wrap !important;
                        flex: 1 !important;
                        justify-content: flex-end !important;
                    }
                    @media (max-width: 1200px) {
                        .card-header-actions { width: 100% !important; flex: none !important; }
                    }

                    /* Global Custom Validation Styles */
                    .error-message {
                        color: #dc3545;
                        font-size: 11px;
                        font-weight: 500;
                        margin-top: 5px;
                        margin-left: 2px;
                        display: block;
                        text-align: left;
                        animation: slideInDown 0.3s ease;
                    }
                    .field.has-error input, 
                    .field.has-error select,
                    .field.has-error .select2-selection {
                        border-color: #dc3545 !important;
                        background: rgba(220, 53, 69, 0.02) !important;
                    }
                    @keyframes slideInDown {
                        from { transform: translateY(-5px); opacity: 0; }
                        to { transform: translateY(0); opacity: 1; }
                    }
                `)
                .appendTo("head");

            // Global Form Validation (jQuery)
            $(document).on('submit', 'form', function(e) {
                const $form = $(this);
                // Skip validation for search/filter forms
                if ($form.attr('method') && $form.attr('method').toUpperCase() === 'GET') return true;

                let isValid = true;
                let firstErrorField = null;

                $form.find('[required]').each(function() {
                    const $input = $(this);
                    // Find the field container (handles different layouts: .field or .admin-form-group)
                    let $field = $input.closest('.field');
                    if ($field.length === 0) $field = $input.closest('.admin-form-group');
                    let val = $input.val();
                    let isValueEmpty = !val || (val === '') || (typeof val === 'string' && val.trim() === '') || (Array.isArray(val) && val.length === 0);
                    
                    if (isValueEmpty || ($input.is('select') && val === '')) {
                        isValid = false;
                        if ($field.length > 0) {
                            $field.addClass('has-error');
                            $field.find('.error-message').remove();
                            
                            // Get Label Name
                            let labelText = $field.find('label').first().text() || $field.find('.admin-form-label').first().text();
                            let labelName = labelText.replace('*', '').replace(':', '').trim();
                            
                            if (!labelName) {
                                labelName = $input.attr('placeholder') || $input.attr('name') || 'This field';
                            }
                            
                            // Format: "Category name"
                            labelName = labelName.split('(')[0].trim(); // Remove things like (Optional)
                            labelName = labelName.charAt(0).toUpperCase() + labelName.slice(1).toLowerCase();
                            
                            const errorMsg = `<span class="error-message"><i class="fas fa-exclamation-circle"></i> ${labelName} is required</span>`;
                            
                            // Smart Placement for Error Messages
                            if ($input.hasClass('select2-hidden-accessible')) {
                                // For Select2, append after the container
                                $input.next('.select2-container').after(errorMsg);
                            } else if ($input.closest('.file-upload').length > 0) {
                                // For File Uploads, append after the wrapper box
                                $input.closest('.file-upload').after(errorMsg);
                            } else {
                                // Default: append after the input
                                $input.after(errorMsg);
                            }
                            
                            if (!firstErrorField) firstErrorField = $field;
                        }
                    } else {
                        if ($field.length > 0) {
                            $field.removeClass('has-error');
                            $field.find('.error-message').remove();
                        }
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    if (firstErrorField) {
                        $('html, body').animate({
                            scrollTop: firstErrorField.offset().top - 150
                        }, 500);
                    }
                    return false;
                }
            });

            // Clear error on input/change
            $(document).on('input change', 'input, select, textarea', function() {
                const $input = $(this);
                let $field = $input.closest('.field');
                if ($field.length === 0) $field = $input.closest('.admin-form-group');
                
                let val = $input.val();
                let isValueNotEmpty = val && ((typeof val === 'string' && val.trim() !== '') || (Array.isArray(val) && val.length > 0));
                
                if ($field.length > 0 && isValueNotEmpty) {
                    $field.removeClass('has-error');
                    $field.find('.error-message').fadeOut(200, function() { $(this).remove(); });
                }
            });

            // Disable default browser validation tooltips
            $('form').attr('novalidate', 'novalidate');

            // Global Delete Confirmation
            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let itemName = $(this).data('item-name') || 'this item';
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${itemName}". This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004200',
                    cancelButtonColor: '#6b6f7a',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    background: '#ffffff',
                    color: '#333',
                    iconColor: '#d4af37',
                    borderRadius: '1.25rem',
                    customClass: {
                        popup: 'swal2-premium-popup'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Quick AJAX Filter System
            let filterTimer;
            const $contentCard = $('.content-card');

            function applyFilters(url, data = '') {
                // Ensure we don't duplicate ? or &
                let fullUrl = url;
                if (data) {
                    fullUrl += (url.includes('?') ? '&' : '?') + data;
                }
                
                $contentCard.addClass('filtering'); 

                $.ajax({
                    url: fullUrl,
                    type: 'GET',
                    success: function(response) {
                        const $newDoc = $(response);
                        let newHtml = $newDoc.find('.content-card').html();
                        
                        // If .content-card wasn't found (e.g. error page), fallback to whole body
                        if (!newHtml) {
                            window.location.href = fullUrl;
                            return;
                        }

                        $contentCard.html(newHtml);
                        $contentCard.removeClass('filtering');
                        
                        // Update URL without reload
                        window.history.pushState({path: fullUrl}, '', fullUrl);
                        
                        // Re-focus search if it was active
                        const urlParams = new URLSearchParams(data || (fullUrl.includes('?') ? fullUrl.split('?')[1] : ''));
                        const searchVal = urlParams.get('search');
                        if (searchVal !== null) {
                            const $search = $('input[name="search"]');
                            if($search.length) {
                                $search.focus().val('').val(searchVal);
                            }
                        }

                        // Re-initialize any plugins if needed
                        initSelect2();
                        if (typeof initDatePickers === 'function') {
                            initDatePickers();
                        }
                    },
                    error: function() {
                        $contentCard.removeClass('filtering');
                        // Fallback to normal load on error
                        window.location.href = fullUrl;
                    }
                });
            }

            // Handle typing in search (debounce)
            $(document).on('input', 'input[name="search"]', function() {
                const $input = $(this);
                const $form = $input.closest('form');
                const url = $form.attr('action') || window.location.href.split('?')[0];
                
                clearTimeout(filterTimer);
                
                // Add a small loading spinner icon if not present
                if (!$input.parent().find('.search-spinner').length) {
                    $input.parent().append('<i class="fas fa-circle-notch fa-spin search-spinner" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--primary); display:none; font-size: 14px;"></i>');
                    $input.css('padding-right', '40px');
                }

                const $spinner = $input.parent().find('.search-spinner');
                $spinner.show();

                filterTimer = setTimeout(() => {
                    $spinner.hide();
                    applyFilters(url, $form.serialize());
                }, 600); 
            });

            // Handle select changes (categories, etc)
            $(document).on('change', 'select[onchange="this.form.submit()"]', function(e) {
                e.preventDefault();
                const $form = $(this).closest('form');
                const url = $form.attr('action') || window.location.href.split('?')[0];
                applyFilters(url, $form.serialize());
                return false;
            });

            // Handle AJAX clicks (Clear, Pagination)
            $(document).on('click', '.pagination a, a.admin-btn', function(e) {
                const url = $(this).attr('href');
                
                // Only intercept if it's a filter/clear link or pagination
                // Check if it's a relative or same-domain link to avoid external navigation issues
                if (url && (url.includes('search=') || url.includes('category=') || url.includes('status=') || $(this).closest('.pagination').length || $(this).text().trim().toUpperCase() === 'CLEAR')) {
                    e.preventDefault();
                    applyFilters(url);
                    return false;
                }
            });

            // Handle browser back/forward buttons
            window.onpopstate = function(event) {
                if(event.state && event.state.path) {
                    applyFilters(event.state.path);
                } else {
                    window.location.reload();
                }
            };

            // Keep focus on search input after reload if it was active
            if (window.location.search.includes('search=')) {
                const urlParams = new URLSearchParams(window.location.search);
                const searchVal = urlParams.get('search');
                if (searchVal) {
                    const $searchInput = $('input[name="search"]');
                    if ($searchInput.length) {
                        $searchInput.focus().val('').val(searchVal); // Focus and move cursor to end
                    }
                }
            }
            
            // Function to Initialize Flatpickr for Date Inputs
            window.initDatePickers = function() {
                if (typeof flatpickr !== 'undefined') {
                    const fpConfig = {
                        dateFormat: "Y-m-d",
                        altInput: true,
                        altFormat: "d-m-Y",
                        allowInput: true,
                        disableMobile: "true",
                        onReady: function(selectedDates, dateStr, instance) {
                            const $altInput = $(instance.altInput);
                            $altInput.attr('placeholder', 'DD-MM-YYYY');
                            $altInput.addClass('admin-input');
                            
                            if (!$altInput.parent().hasClass('date-input-wrapper')) {
                                $altInput.wrap('<div class="date-input-wrapper" style="position: relative; width: 100%;"></div>');
                                $altInput.after('<i class="fas fa-calendar-alt" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: #ff9800; pointer-events: none; font-size: 16px;"></i>');
                                $altInput.css('padding-right', '45px');
                            }
                        }
                    };

                    $("input[type='date'], .datepicker").each(function() {
                        if (!$(this).hasClass('flatpickr-input')) {
                            $(this).flatpickr(fpConfig);
                        }
                    });
                    
                    $("input[type='datetime-local'], .datetimepicker").each(function() {
                        if (!$(this).hasClass('flatpickr-input')) {
                            $(this).flatpickr({
                                ...fpConfig,
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                altFormat: "d-m-Y H:i",
                                onReady: function(selectedDates, dateStr, instance) {
                                    const $altInput = $(instance.altInput);
                                    $altInput.attr('placeholder', 'DD-MM-YYYY HH:MM');
                                    $altInput.addClass('admin-input');
                                    
                                    if (!$altInput.parent().hasClass('date-input-wrapper')) {
                                        $altInput.wrap('<div class="date-input-wrapper" style="position: relative; width: 100%;"></div>');
                                        $altInput.after('<i class="fas fa-clock" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: #ff9800; pointer-events: none; font-size: 16px;"></i>');
                                        $altInput.css('padding-right', '45px');
                                    }
                                }
                            });
                        }
                    });
                }
            };

            // Call it on page load
            initDatePickers();

            // Global Validation Helpers
            window.checkUnique = function(table, column, value, element, ignoreId = null) {
                if (!value || value.length < 2) {
                    $(element).css('border-color', '');
                    $(element).siblings('.error-msg').remove();
                    return;
                }
                
                $.ajax({
                    url: "{{ route('admin.validate.unique') }}",
                    method: 'GET',
                    data: {
                        table: table, column: column, value: value, ignore_id: ignoreId
                    },
                    success: function(response) {
                        let $el = $(element);
                        let $error = $el.siblings('.error-msg');
                        if ($error.length === 0) {
                            $error = $('<p class="error-msg" style="color: #dc3545; font-size: 11px; margin-top: 4px; font-weight: 600;"></p>');
                            $el.after($error);
                        }

                        if (response.exists) {
                            $el.css('border-color', '#dc3545');
                            $error.text('This ' + column.replace('_', ' ') + ' already exists!').show();
                        } else {
                            $el.css('border-color', '');
                            $error.hide();
                        }
                    }
                });
            };

            window.validateFormat = function(type, value, element) {
                let regex;
                let msg;
                
                switch(type) {
                    case 'name':
                        regex = /^[A-Za-z\s]+$/;
                        msg = 'Only alphabets are allowed!';
                        break;
                    case 'phone':
                        regex = /^\d{0,10}$/; // Allow typing up to 10
                        if (value.length > 10) {
                            $(element).val(value.substring(0, 10));
                            return;
                        }
                        return; // Logic handled in input event for better UX
                    case 'zip':
                        if (value.length > 6) {
                            $(element).val(value.substring(0, 6));
                        }
                        return;
                    default:
                        return true;
                }
            };
        });
    </script>
    @yield('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FWU Incubation Center - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .logo-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .sidebar-shadow {
            box-shadow: 2px 0 10px rgba(59, 130, 246, 0.1);
        }
        .nav-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-item:hover {
            transform: translateX(4px);
        }
        .active-item {
            background: linear-gradient(90deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            transform: translateX(4px);
        }
        .submenu-item {
            position: relative;
        }
        .submenu-item::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 50%;
            width: 4px;
            height: 4px;
            background: #60a5fa;
            border-radius: 50%;
            transform: translateY(-50%);
        }
        .mobile-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-sidebar.active {
            transform: translateX(0);
        }
        .mobile-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
      @php
    $url = url()->current();                  // get current URL
    $segments = explode("/", $url);           // split URL
    $segment = isset($segments[3]) ? str_replace("1", "", $segments[3]) : "";
    @endphp

<!-- {{ $segment }} -->
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button  id="mobileMenuBtn" class="bg-blue-600 text-white p-3 rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="mobile-overlay lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

    <!-- Sidebar -->
    <div class="flex">
        <!-- Desktop Sidebar -->
        <div class="hidden lg:flex fixed h-screen flex-col justify-between bg-white sidebar-shadow border-r border-blue-100 overflow-y-auto" style="width: 280px;">
            <!-- Header Section -->
            <div class="px-6 py-6">
                <!-- Logo and Title -->
                <div class="mb-8">
                    <div class="logo-gradient h-16 w-full rounded-xl flex items-center justify-center mb-4 shadow-lg">
                        <div class="text-center">
                            <div class="text-white font-bold text-lg">FWU</div>
                            <div class="text-blue-100 text-xs font-medium">INCUBATION</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-blue-900 font-bold text-sm">Far Western University</h2>
                        <p class="text-blue-600 text-xs">Incubation Center</p>
                        <p class="text-gray-500 text-xs mt-1">Kanchanpur, Mahendranagar</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <ul class="space-y-2" id="desktopNavigationMenu">
                    <!-- Menu items will be dynamically generated here -->
                </ul>
            </div>

            <!-- Footer Section -->
            <div class="border-t border-blue-100 p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-sm">AD</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-900">Admin User</p>
                        <p class="text-xs text-blue-600">System Administrator</p>
                    </div>
                </div>
                
                <button class="nav-item w-full flex items-center rounded-xl px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </div>
        </div>

        <!-- Mobile Sidebar -->
        <div id="mobileSidebar" class="mobile-sidebar lg:hidden fixed h-screen flex-col justify-between bg-white sidebar-shadow border-r border-blue-100 overflow-y-auto z-50" style="width: 280px;">
            <!-- Close Button -->
            <div class="flex justify-end p-4">
                <button id="closeMobileMenuBtn" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Header Section -->
            <div class="px-6 py-2 flex-1">
                <!-- Logo and Title -->
                <div class="mb-8">
                    <div class="logo-gradient h-16 w-full rounded-xl flex items-center justify-center mb-4 shadow-lg">
                        <div class="text-center">
                            <div class="text-white font-bold text-lg">FWU</div>
                            <div class="text-blue-100 text-xs font-medium">INCUBATION</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-blue-900 font-bold text-sm">Far Western University</h2>
                        <p class="text-blue-600 text-xs">Incubation Center</p>
                        <p class="text-gray-500 text-xs mt-1">Kanchanpur, Mahendranagar</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <ul class="space-y-2" id="mobileNavigationMenu">
                    <!-- Menu items will be dynamically generated here -->
                </ul>
            </div>

            <!-- Footer Section -->
            <div class="border-t border-blue-100 p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-sm">AD</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-900">Admin User</p>
                        <p class="text-xs text-blue-600">System Administrator</p>
                    </div>
                </div>
                
                <button class="nav-item w-full flex items-center rounded-xl px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </div>
        </div>

      {{-- Main Content Area --}}
    </div>

    <script>
        // Navigation menu items array
        const segment='{{ $segment }}'.toLowerCase();
        const menuItems = [
            {
                id: 'dashboard',
                title: 'Dashboard',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>`,
                href: 'admin-dashboard',
                active:true,
                hasSubmenu: false
            },
            {
                id: 'news',
                title: 'News & Updates',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>`,
                href: 'news-updates',
                active: false,
                hasSubmenu: false
            },
            {
                id: 'notice',
                title: 'Notice Board',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: false
            },
            {
                id: 'applications',
                title: 'Applications',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: true,
                submenuItems: [
                    { title: 'New Applications', href: '#' },
                    { title: 'Under Review', href: '#' },
                    { title: 'Approved', href: '#' },
                    { title: 'Rejected', href: '#' }
                ]
            },
            {
                id: 'applicants',
                title: 'Applicants Database',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: false
            },
            {
                id: 'committee',
                title: 'Committee',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: false
            },
            {
                id: 'reports',
                title: 'Reports',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: false
            },
            {
                id: 'settings',
                title: 'Settings',
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>`,
                href: '#',
                active: false,
                hasSubmenu: false
            }
        ];
     
       menuItems.forEach(item => {
            
        //  console.log(item.href==segment);
         const active=item.href.toLowerCase()==segment;
         item.active=active;

        });
        // console.log(menuItems);

        // Function to generate menu items
      function generateMenuItems(containerId) {
    const navigationMenu = document.getElementById(containerId);
    navigationMenu.innerHTML = ''; // Clear existing items

    menuItems.forEach(item => {
        const li = document.createElement('li');

        if (item.hasSubmenu && item.submenuItems) {
            // Create dropdown menu item with submenu
            li.innerHTML = `
                <details class="group [&_summary::-webkit-details-marker]:hidden" ${item.active ? 'open' : ''}>
                    <summary class="${item.active ? 'active-item' : ''} nav-item flex cursor-pointer items-center justify-between rounded-xl px-4 py-3 text-blue-700 hover:bg-blue-50 hover:text-blue-800">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">${item.icon}</svg>
                            ${item.title}
                        </span>
                        <svg class="w-4 h-4 text-blue-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <ul class="mt-2 space-y-1 pl-10 text-sm text-blue-600">
                        ${item.submenuItems.map(sub => `
                            <li>
                                <a href="${sub.href}" class="submenu-item block px-3 py-1 rounded hover:bg-blue-100">
                                    ${sub.title}
                                </a>
                            </li>
                        `).join('')}
                    </ul>
                </details>
            `;
        } else {
            // Create normal menu item
            li.innerHTML = `
                <a href="${item.href}" class="${item.active ? 'active-item' : ''} nav-item flex items-center rounded-xl px-4 py-3 text-blue-700 hover:bg-blue-50 hover:text-blue-800">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">${item.icon}</svg>
                    ${item.title}
                </a>
            `;
        }

        navigationMenu.appendChild(li);
    });
}


        // Function to set active menu item
        function setActiveMenuItem(itemId) {
            menuItems.forEach(item => {
                item.active =item?.href==$segment;
            });
            
            // Regenerate both desktop and mobile menus
            generateMenuItems('desktopNavigationMenu');
            generateMenuItems('mobileNavigationMenu');
        }

        // Mobile menu toggle functions
        function toggleMobileMenu(e) {
            e.preventDefault();

            const mobileSidebar = document.getElementById('mobileSidebar');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            mobileSidebar.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
        }

        function closeMobileMenu(e) {
            e.preventDefault();
            const mobileSidebar = document.getElementById('mobileSidebar');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            mobileSidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // Generate menus for both desktop and mobile
            generateMenuItems('desktopNavigationMenu');
            generateMenuItems('mobileNavigationMenu');
            
            // Mobile menu button event listeners
            document.getElementById('mobileMenuBtn').addEventListener('click', toggleMobileMenu);
            document.getElementById('closeMobileMenuBtn').addEventListener('click', closeMobileMenu);
            document.getElementById('mobileOverlay').addEventListener('click', closeMobileMenu);
            
            // Add click event listeners to menu items
            document.addEventListener('click', function(e) {
                const menuLink = e.target.closest('a[href="#"]');
                if (menuLink && !menuLink.closest('.submenu-item')) {
                    e.preventDefault();
                    
                    // Find the menu item based on the clicked element
                    const menuText = menuLink.textContent.trim();
                    const clickedItem = menuItems.find(item => item.title === menuText);
                    
                    if (clickedItem) {
                        setActiveMenuItem(clickedItem.id);
                        console.log(`Navigated to: ${clickedItem.title}`);
                        
                        // Close mobile menu if open
                        if (window.innerWidth < 1024) {
                            closeMobileMenu();
                        }
                    }
                }
            });

            // Close mobile menu on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeMobileMenu();
                }
            });
        });
    </script>
</body>
</html>
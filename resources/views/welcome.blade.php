<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GourmetDash | Food Delivery in your city</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .pink-accent { color: #D70F64; } /* Foodpanda-inspired signature pink/red */
        .bg-pink-accent { background-color: #D70F64; }
        .category-card:hover img { transform: scale(1.1); transition: 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50">

    <nav class="sticky top-0 z-50 bg-white shadow-sm h-16 md:h-20">
        <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="text-2xl font-bold pink-accent tracking-tighter flex items-center gap-2">
                    <i class="fa-solid fa-bicycle"></i> GourmetDash
                </a>
                
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                    <i class="fa-solid fa-location-dot pink-accent"></i>
                    <span class="font-medium">Dhaka, Bangladesh</span>
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="text-gray-700 font-semibold px-4 py-2 hover:bg-gray-100 rounded-lg transition">EN</button>
                <a href="{{ route('login') }}" 
                   class="bg-pink-accent text-white px-6 py-2.5 rounded-xl font-bold shadow-md hover:bg-[#b50d55] transition flex items-center gap-2">
                    <i class="fa-regular fa-user"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <section class="relative h-[450px] md:h-[550px] bg-[#f7f7f7] flex items-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 w-full grid md:grid-cols-2 z-10">
            <div class="bg-white/90 md:bg-white p-8 md:p-12 rounded-3xl shadow-xl max-w-xl">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    It's the food you love, delivered
                </h1>
                
                <div class="flex flex-col gap-4">
                    <div class="relative group">
                        <input type="text" placeholder="Enter your full address" 
                               class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-pink-accent outline-none transition-all pr-32">
                        <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-pink-accent text-white px-6 py-2.5 rounded-lg font-bold">
                            Find Food
                        </button>
                    </div>
                    <p class="text-sm text-gray-500"><i class="fa-solid fa-bolt pink-accent mr-1"></i> Quick search: Pizza, Burger, Sushi</p>
                </div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=1000&q=80" 
             class="absolute right-0 top-0 h-full w-1/2 object-cover hidden md:block" alt="Delicious Food">
    </section>

    <main class="max-w-7xl mx-auto px-4 py-16">
        
        <div class="mb-16">
            <h2 class="text-2xl font-bold mb-8">What are you craving?</h2>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                @php
                    $cuisines = [
                        ['n' => 'Pizza', 'img' => 'https://img.icons8.com/emoji/96/pizza-emoji.png'],
                        ['n' => 'Burgers', 'img' => 'https://img.icons8.com/emoji/96/hamburger-emoji.png'],
                        ['n' => 'Desserts', 'img' => 'https://img.icons8.com/emoji/96/shortcake-emoji.png'],
                        ['n' => 'Chinese', 'img' => 'https://img.icons8.com/emoji/96/takeout-box-emoji.png'],
                        ['n' => 'Sushi', 'img' => 'https://img.icons8.com/emoji/96/sushi-emoji.png'],
                        ['n' => 'Healthy', 'img' => 'https://img.icons8.com/emoji/96/green-salad-emoji.png'],
                        ['n' => 'Tacos', 'img' => 'https://img.icons8.com/emoji/96/taco-emoji.png'],
                        ['n' => 'Drinks', 'img' => 'https://img.icons8.com/emoji/96/bubble-tea-emoji.png'],
                    ];
                @endphp
                @foreach($cuisines as $item)
                <div class="category-card flex flex-col items-center cursor-pointer">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full shadow-sm flex items-center justify-center mb-3 border border-gray-100">
                        <img src="{{ $item['img'] }}" class="w-12 h-12" alt="{{ $item['n'] }}">
                    </div>
                    <span class="text-sm font-semibold text-gray-700">{{ $item['n'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Today's Deals</h2>
                <a href="#" class="pink-accent font-bold hover:underline">See all</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-pink-accent rounded-3xl p-8 text-white flex justify-between items-center overflow-hidden h-48 relative">
                    <div class="z-10">
                        <h3 class="text-2xl font-bold mb-2">50% OFF</h3>
                        <p class="opacity-90">First 3 orders</p>
                        <button class="mt-4 bg-white text-pink-accent px-4 py-2 rounded-lg font-bold text-sm">Get Code</button>
                    </div>
                    <i class="fa-solid fa-utensils absolute -right-4 -bottom-4 text-9xl opacity-10"></i>
                </div>
                <div class="bg-orange-500 rounded-3xl p-8 text-white flex justify-between items-center overflow-hidden h-48 relative">
                    <div class="z-10">
                        <h3 class="text-2xl font-bold mb-2">Free Delivery</h3>
                        <p class="opacity-90">For new restaurants</p>
                        <button class="mt-4 bg-white text-orange-600 px-4 py-2 rounded-lg font-bold text-sm">Order Now</button>
                    </div>
                    <i class="fa-solid fa-truck-fast absolute -right-4 -bottom-4 text-9xl opacity-10"></i>
                </div>
                <div class="bg-blue-600 rounded-3xl p-8 text-white flex justify-between items-center overflow-hidden h-48 relative">
                    <div class="z-10">
                        <h3 class="text-2xl font-bold mb-2">Dine-in</h3>
                        <p class="opacity-90">Save up to 30%</p>
                        <button class="mt-4 bg-white text-blue-600 px-4 py-2 rounded-lg font-bold text-sm">Book Table</button>
                    </div>
                    <i class="fa-solid fa-shop absolute -right-4 -bottom-4 text-9xl opacity-10"></i>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white py-20 border-t border-b">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1">
                <h2 class="text-4xl font-bold mb-6">Put us in your pocket</h2>
                <p class="text-gray-600 text-lg mb-8">Download the app. It's the fastest way to order food on the go.</p>
                <div class="flex gap-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" class="h-12 cursor-pointer" alt="iOS">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-12 cursor-pointer" alt="Android">
                </div>
            </div>
            <div class="flex-1">
                <div class="bg-pink-accent/10 p-12 rounded-full">
                    <i class="fa-solid fa-mobile-screen-button text-[200px] pink-accent"></i>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#2b2b2b] text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10 mb-20">
                <div class="col-span-2 lg:col-span-1">
                    <h3 class="text-2xl font-bold pink-accent mb-6 italic">GourmetDash</h3>
                    <p class="text-gray-400 text-sm leading-loose">© 2026 GourmetDash. <br>Your neighborhood food hero.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Explore</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Cuisines</a></li>
                        <li><a href="#" class="hover:text-white">Restaurants</a></li>
                        <li><a href="#" class="hover:text-white">Offers</a></li>
                        <li><a href="#" class="hover:text-white">Dine-in</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Contact</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Help Center</a></li>
                        <li><a href="#" class="hover:text-white">Press</a></li>
                        <li><a href="#" class="hover:text-white">Refunds</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Legal</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Terms</a></li>
                        <li><a href="#" class="hover:text-white">Privacy</a></li>
                        <li><a href="#" class="hover:text-white">Cookies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Socials</h4>
                    <div class="flex gap-4">
                        <a href="#" class="hover:pink-accent"><i class="fa-brands fa-facebook text-xl"></i></a>
                        <a href="#" class="hover:pink-accent"><i class="fa-brands fa-instagram text-xl"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GourmetDash Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .pink-accent { color: #D70F64; }
        .bg-pink-accent { background-color: #D70F64; }
        
        /* Subtle animation for the background image */
        .zoom-effect {
            animation: slowZoom 20s infinite alternate ease-in-out;
        }
        @keyframes slowZoom {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }
    </style>
</head>
<body class="bg-white overflow-hidden">

    <div class="flex h-screen w-full">
        
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-black">
            <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1200&q=80" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80 zoom-effect" alt="Gourmet Dining">
            
            <div class="relative z-10 flex flex-col justify-between p-16 w-full text-white">
                <a href="/" class="text-3xl font-bold tracking-tighter flex items-center gap-2">
                    <i class="fa-solid fa-bicycle text-white"></i> GourmetDash
                </a>
                
                <div>
                    <h2 class="text-5xl font-extrabold leading-tight mb-4">The world’s best <br>flavors, one click away.</h2>
                    <p class="text-xl opacity-80 max-w-md font-light">Join over 2 million foodies enjoying premium delivery across the country.</p>
                </div>

                <div class="flex gap-8 text-sm font-medium opacity-60">
                    <span>© 2026 GourmetDash</span>
                    <a href="#" class="hover:opacity-100 transition">Privacy Policy</a>
                </div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/40"></div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16 bg-white">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden mb-12 flex justify-center">
                    <span class="text-3xl font-bold pink-accent tracking-tighter flex items-center gap-2">
                        <i class="fa-solid fa-bicycle"></i> GourmetDash
                    </span>
                </div>

                <div class="text-center lg:text-left mb-10">
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h3>
                    <p class="text-gray-500">Please enter your credentials to access your account.</p>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('login.keycloak') }}" 
                       class="flex items-center justify-center gap-3 w-full bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-black transition-all active:scale-[0.98] shadow-xl shadow-gray-200">
                        <i class="fa-solid fa-key"></i>
                        Sign in with Keycloak SSO
                    </a>

                    <div class="relative py-4 flex items-center">
                        <div class="flex-grow border-t border-gray-100"></div>
                        <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase tracking-widest font-bold">Secure Access</span>
                        <div class="flex-grow border-t border-gray-100"></div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-shield-halved text-pink-accent mt-1"></i>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Unified Authentication</h4>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                    We use Keycloak to ensure your data is encrypted and secure. You will be redirected to our secure identity server.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center lg:text-left">
                    <p class="text-sm text-gray-600">
                        New to GourmetDash? 
                        <a href="#" class="pink-accent font-bold hover:underline ml-1">Create an account</a>
                    </p>
                    <div class="mt-8 flex justify-center lg:justify-start gap-6">
                        <a href="#" class="text-gray-400 hover:text-pink-accent transition"><i class="fa-brands fa-apple text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-pink-accent transition"><i class="fa-brands fa-google text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-pink-accent transition"><i class="fa-brands fa-facebook text-xl"></i></a>
                    </div>
                </div>

                <div class="lg:hidden mt-20 text-center text-xs text-gray-400">
                    <p>© 2026 GourmetDash Technologies Inc.</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
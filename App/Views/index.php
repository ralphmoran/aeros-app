<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aeros PHP Framework</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white">
    <!-- Hero Section -->
    <header class="min-h-screen flex flex-col">
        <nav class="container mx-auto p-6">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">⚡️ Aeros</div>
                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="hover:text-purple-400 transition">Features</a>
                    <a href="#docs" class="hover:text-purple-400 transition">Documentation</a>
                    <a href="#community" class="hover:text-purple-400 transition">Community</a>
                    <a href="https://github.com/ralphmoran/aeros-app" class="hover:text-purple-400 transition">GitHub</a>
                </div>
            </div>
        </nav>

        <main class="flex-grow flex items-center">
            <div class="container mx-auto px-6 py-12 text-center">
                <h1 class="text-6xl md:text-7xl font-extrabold mb-8">
                Aeros PHP
                    <span class="block text-purple-400">Framework</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto">
                    Lightning-fast PHP framework for building modern web applications with elegant syntax and powerful features
                </p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="#docs" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-lg font-semibold transition">
                        Get Started
                    </a>
                    <a href="https://github.com/ralphmoran/aeros-app" class="border border-purple-600 hover:bg-purple-600/10 px-8 py-4 rounded-lg font-semibold transition">
                        View on GitHub
                    </a>
                </div>
            </div>
        </main>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Why Choose Aeros?</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="p-6 rounded-lg bg-gray-800 hover:bg-gray-750 transition">
                    <div class="text-purple-400 text-4xl mb-4">⚡️</div>
                    <h3 class="text-xl font-semibold mb-4">Lightning Fast</h3>
                    <p class="text-gray-400">Optimized performance with minimal overhead for blazing-fast applications</p>
                </div>
                <div class="p-6 rounded-lg bg-gray-800 hover:bg-gray-750 transition">
                    <div class="text-purple-400 text-4xl mb-4">🛠️</div>
                    <h3 class="text-xl font-semibold mb-4">Modern Tooling</h3>
                    <p class="text-gray-400">Built-in support for modern PHP features and development workflows</p>
                </div>
                <div class="p-6 rounded-lg bg-gray-800 hover:bg-gray-750 transition">
                    <div class="text-purple-400 text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold mb-4">Secure by Default</h3>
                    <p class="text-gray-400">Enterprise-grade security features and best practices out of the box</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Code Example Section -->
    <section id="docs" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Elegant Syntax</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- PHP Code Example -->
                <div class="bg-gray-900 p-8 rounded-lg overflow-x-auto">
                    <h3 class="text-xl font-semibold mb-4 text-purple-400">Controller Example</h3>
                    <pre class="code-block"><code><span class="text-blue-400">namespace</span> <span class="text-green-400">App\Controllers</span>;

<span class="text-blue-400">use</span> <span class="text-green-400">Aeros\Src\Classes\Controller</span>;

<span class="text-blue-400">class</span> <span class="text-yellow-400">WelcomeController</span> <span class="text-blue-400">extends</span> <span class="text-yellow-400">Controller</span>
{
    <span class="text-blue-400">public function</span> <span class="text-yellow-300">index</span>()<!-- : <span class="text-yellow-400">Response</span> -->
    {
        <span class="text-blue-400">return</span> <span class="text-yellow-300">view</span>(<span class="text-green-300">'welcome'</span>, [
            <span class="text-orange-300">'title'</span> => <span class="text-green-300">'Welcome to Aeros'</span>
        ]);
    }
}</code></pre>
                </div>

                <!-- CLI Example -->
                <div class="bg-gray-900 p-8 rounded-lg overflow-x-auto">
                    <h3 class="text-xl font-semibold mb-4 text-purple-400">CLI Commands</h3>
                    <pre class="code-block"><code><span class="text-gray-400">$</span> <span class="text-green-400">php</span> <span class="text-yellow-300">aeros</span> <span class="text-blue-400">run:app</span> <span class="text-purple-400">-c</span> <span class="text-purple-400">-a</span>

<span class="text-gray-300">⚡️ Aeros CLI v1.0.0</span>

<span class="text-green-400">RUNNING</span> Application server
<span class="text-blue-400">INFO</span>    Starting development server
<span class="text-blue-400">INFO</span>    Watching for changes...
<span class="text-green-400">SUCCESS</span> Server running on http://localhost:8000</code></pre>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12 text-sm">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <p>© 2024 Aeros PHP Framework. Open source and made with ⚡️</p>
        </div>
    </footer>
</body>
</html>
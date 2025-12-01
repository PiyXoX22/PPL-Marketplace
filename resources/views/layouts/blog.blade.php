<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloxBlog  |  Situs Blog Tentang Marketplace Dan Teknologi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.posts.index') }}" class="text-xl font-bold">Blox Blog</a>
            <div>
                <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-500 mr-4">Home</a>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500">Marketplace</a>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>

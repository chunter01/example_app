<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSAI Example App</title>
    {{-- ... --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- POST Check-In -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 form-title">Create Check-In</h2>
                <p class="text-gray-600">
                    <form id="check-in-form" class="space-y-4">
                        <input type="hidden" id="_method" name="_method" value="POST">
                        <input type="hidden" id="check-in-id" name="check-in-id" value="">
                        <div>
                            <label 
                                for="description" 
                                class="block text-sm font-medium text-gray-700 mb-1">
                                    Description <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="description" 
                                name="description" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <label for="description" class="text-red-500 text-sm error"></label>
                        </div>
                        
                        <div>
                            <label 
                                for="lat" 
                                class="block text-sm font-medium text-gray-700 mb-1">
                                    Latitude <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="lat" 
                                name="lat" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <label for="lat" class="text-red-500 text-sm error"></label>
                        </div>
                        
                        <div>
                            <label 
                                for="lng" 
                                class="block text-sm font-medium text-gray-700 mb-1">
                                    Longitude <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="lng" 
                                name="lng" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <label for="lng" class="text-red-500 text-sm error"></label>
                        </div>
                        
                        <div>
                            <label 
                                for="notes" 
                                class="block text-sm font-medium text-gray-700 mb-1">
                                    Notes (optional)
                            </label>
                            <textarea 
                                id="notes" 
                                name="notes" 
                                rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer submit-check-in">
                                        Submit
                                </button>
                            </div>
                            <div class="pt-4">
                                <button class="w-full bg-white hover:bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer reset-form">
                                  Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </p>
            </div>

            <!-- View Check-Ins -->
            <div class="bg-white rounded-lg shadow-md p-6 md:col-span-3">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">View Check-Ins</h2>
                <p class="text-gray-600">
                    <div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lat/Lng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 check-in-list"></tbody>
                        </table>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <div class="prev float-left px-6 mt-6"></div>
                            </div>
                            <div>
                                <div class="next float-right px-6 mt-6"></div>
                            </div>
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
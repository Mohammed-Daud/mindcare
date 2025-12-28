<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Choose a Psychiatrist</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-gray-50 text-gray-800">

<!-- Header -->
<header class="bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold text-teal-700">Our Psychiatrists</h1>
    <a href="/" class="text-sm text-gray-600 hover:text-teal-600">Back to Home</a>
  </div>
</header>

<!-- Filters -->
<section class="max-w-7xl mx-auto px-6 py-6">
  <div class="bg-white p-4 rounded-lg shadow flex flex-wrap gap-4 text-sm">

    <select class="border rounded px-3 py-2">
      <option>All Specialties</option>
      <option>Anxiety</option>
      <option>Depression</option>
      <option>Sleep Disorders</option>
    </select>

    <select class="border rounded px-3 py-2">
      <option>Availability</option>
      <option>Available Today</option>
      <option>Next 3 Days</option>
    </select>

    <select class="border rounded px-3 py-2">
      <option>Language</option>
      <option>English</option>
      <option>Hindi</option>
    </select>

  </div>
</section>

<!-- Doctor Cards -->
<section class="max-w-7xl mx-auto px-6 pb-16 grid md:grid-cols-3 gap-8">

  <!-- Doctor Card -->
  <div class="bg-white rounded-xl shadow p-6">
    <img src="https://images.unsplash.com/photo-1550831107-1553da8c8464"
         class="w-24 h-24 rounded-full object-cover mx-auto">

    <h3 class="mt-4 text-lg font-semibold text-center">
      Dr. Ananya Sharma
    </h3>

    <p class="text-sm text-center text-gray-500">
      MD Psychiatry · 8+ Years Experience
    </p>

    <p class="mt-3 text-sm text-gray-600 text-center">
      Specializes in anxiety disorders, depression, and stress-related conditions.
    </p>

    <div class="mt-4 text-xs text-center text-gray-500">
      Languages: English, Hindi
    </div>

    <div class="mt-6 flex justify-center">
      <a href="#"
         class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700">
        View Profile & Book
      </a>
    </div>
  </div>

  <!-- Duplicate cards for demo -->
  <div class="bg-white rounded-xl shadow p-6">
    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d"
         class="w-24 h-24 rounded-full object-cover mx-auto">

    <h3 class="mt-4 text-lg font-semibold text-center">
      Dr. Rohan Mehta
    </h3>

    <p class="text-sm text-center text-gray-500">
      MD Psychiatry · 12+ Years Experience
    </p>

    <p class="mt-3 text-sm text-gray-600 text-center">
      Focus on mood disorders, sleep issues, and long-term therapy.
    </p>

    <div class="mt-4 text-xs text-center text-gray-500">
      Languages: English
    </div>

    <div class="mt-6 flex justify-center">
      <a href="#"
         class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700">
        View Profile & Book
      </a>
    </div>
  </div>

</section>

</body>
</html>

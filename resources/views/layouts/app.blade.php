<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Attendify Admin Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f4f4f4;
    }
    header {
      background-color: #1976d2;
      color: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 24px;
    }
    .profile-circle {
      width: 40px;
      height: 40px;
      background-color: #eee;
      border-radius: 50%;
    }
    main {
      padding: 30px 20px;
    }
    .section-title {
      font-size: 18px;
      margin-bottom: 20px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 20px;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: 0.2s;
    }
    .card:hover {
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .icon {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .label {
      font-size: 14px;
    }
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 50px);
      gap: 10px;
      margin-bottom: 20px;
      justify-items: center;
    }
    .calendar div {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 50px;
      height: 50px;
      background-color: #e0e0e0;
      border-radius: 50%;
      cursor: pointer;
    }
    .calendar div.selected {
      background-color: #1976d2;
      color: white;
    }
  </style>
</head>
<body>
  <header>
    <div>
      <p style="margin: 0; font-size: 14px;">Good Morning,</p>
      <h1>Admin Attendify</h1>
    </div>
    <div class="profile-circle"></div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>

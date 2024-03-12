<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabbed Pages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        /* Tab bar stili */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #ccc;
        }

        /* İçerik sayfası stili */
        .tabcontent {
            display: none;
            padding: 20px;
            border-top: none;
        }
    </style>
</head>
<body>

<div class="tab">
    <button class="tablinks" onclick="openPage('vehicles')">Vehicles</button>
    <button class="tablinks" onclick="openPage('settings')">Settings</button>
</div>

<div id="settings" class="tabcontent">
    <!-- Settings sayfasının içeriği buraya gelecek -->
    @include('settings')
</div>
<div id="vehicles" class="tabcontent">
    <!-- Vehicles sayfasının içeriği buraya gelecek -->
    @include('vehicles.index')
</div>



<script>
    function openPage(pageName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(pageName).style.display = "block";
    }
</script>

</body>
</html>

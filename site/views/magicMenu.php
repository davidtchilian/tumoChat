<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CSS menu</title>
    <link rel="icon" type="image/png" href="../assets/images/logo_tuyu-sm.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body class="test">
    <div class="navigation">
        <ul>
            <li class="list active">
                <a href="#" onclick="lightMode()">
                    <span class="icon">
                        <ion-icon name="sunny-outline"></ion-icon>
                    </span>
                    <span class="text"> Day </span>
                </a>
            </li>
            <li class="list">
                <a href="#" onclick="darkMode()">
                    <span class="icon">
                        <ion-icon name="moon-outline"></ion-icon>
                    </span>
                    <span class="text"> Night </span>
                </a>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>

    <script>
        const list = document.querySelectorAll('.list');
        function activeLink() {
            list.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        list.forEach((item) => item.addEventListener('click', activeLink))

        function darkMode() {
            var element = document.body;
            element.classList.remove("light-mode");
            element.classList.add("dark-mode");
        }
        function lightMode() {
            var element = document.body;
            element.classList.remove("dark-mode");
            element.classList.add("light-mode");
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
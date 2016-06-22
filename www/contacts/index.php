<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contacts</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
    </head>
    <body id="page-contacts"> 
    <?php include '../snipps/head.php'; ?>

        <br>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-1-1 uk-text-center">
                <h1 class="uk-heading-large">Contact</h1>
                <p class="uk-text-large">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
            </div>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-4 uk-push-1-4 uk-text-center">
                 <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="250" height="250" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjUwcHgiIGhlaWdodD0iMjUwcHgiIHZpZXdCb3g9IjAgMCAyNTAgMjUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNTAgMjUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyNTAiIGhlaWdodD0iMjUwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMjI3LjgxOCwyMDcuMjQ1Yy0xLjA0NS01Ljg0Ny0yLjM2OS0xMS4yNTktMy45NjUtMTYuMjUyYy0xLjU5OC00Ljk5NC0zLjc0Mi05Ljg1OS02LjQ0MS0xNC42MDYNCgkJYy0yLjY5Ny00Ljc0LTUuNzg5LTguNzg1LTkuMjgzLTEyLjEzMWMtMy41MDEtMy4zNDMtNy43NjgtNi4wMTUtMTIuODA5LTguMDEyYy01LjA0NS0xLjk5Ni0xMC42MTEtMi45OTUtMTYuNy0yLjk5NQ0KCQljLTAuODk3LDAtMi45OTQsMS4wNzQtNi4yOTEsMy4yMTljLTMuMjk1LDIuMTUtNy4wMTcsNC41NDYtMTEuMTU4LDcuMTg4Yy00LjE0NiwyLjY0Ni05LjUzNyw1LjA0NC0xNi4xNzYsNy4xODkNCgkJYy02LjY0MiwyLjE0OC0xMy4zMDgsMy4yMjEtMTkuOTk1LDMuMjIxYy02LjY4OSwwLTEzLjM1NC0xLjA3MS0xOS45OTUtMy4yMjFjLTYuNjQzLTIuMTQ2LTEyLjAzNi00LjU0My0xNi4xNzYtNy4xODkNCgkJYy00LjE0OC0yLjY0My03Ljg2My01LjAzNy0xMS4xNTgtNy4xODhjLTMuMjk1LTIuMTQ1LTUuMzkxLTMuMjE5LTYuMjkxLTMuMjE5Yy02LjA5NSwwLTExLjY2MSwwLjk5OS0xNi43MDEsMi45OTUNCgkJYy01LjA0MSwxLjk5Ny05LjMxMyw0LjY2OS0xMi44MDMsOC4wMTJjLTMuNTAxLDMuMzQ2LTYuNTkyLDcuMzkxLTkuMjg3LDEyLjEzMWMtMi42OTYsNC43NDctNC44NDcsOS42MTItNi40NDEsMTQuNjA2DQoJCWMtMS41OTcsNC45OTMtMi45MjIsMTAuNDA1LTMuOTcxLDE2LjI1MmMtMS4wNDYsNS44MzktMS43NDgsMTEuMjgtMi4wOTYsMTYuMzIzYy0wLjM0OSw1LjA0My0wLjUyNCwxMC4yMTMtMC41MjQsMTUuNQ0KCQljMCwzLjkyNSwwLjQzMiw3LjU1LDEuMjExLDEwLjkzMmgyMDguNDY0YzAuNzgxLTMuMzgyLDEuMjEzLTcuMDA3LDEuMjEzLTEwLjkzMmMwLTUuMjg3LTAuMTc2LTEwLjQ1Ny0wLjUyNi0xNS41DQoJCUMyMjkuNTY2LDIxOC41MjUsMjI4Ljg2OSwyMTMuMDg0LDIyNy44MTgsMjA3LjI0NXoiLz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTI1LDE2Mi44MzRjMTUuODc1LDAsMjkuNDMtNS42MTcsNDAuNjY2LTE2Ljg1YzExLjIzMi0xMS4yMzUsMTYuODUtMjQuNzg5LDE2Ljg1LTQwLjY2Nw0KCQljMC0xNS44NzctNS42MTctMjkuNDI5LTE2Ljg1LTQwLjY2M0MxNTQuNDMsNTMuNDIyLDE0MC44NzUsNDcuODA0LDEyNSw0Ny44MDRzLTI5LjQzNCw1LjYxOS00MC42NjQsMTYuODUyDQoJCUM3My4xLDc1Ljg5LDY3LjQ4NCw4OS40NDEsNjcuNDg0LDEwNS4zMThjMCwxNS44NzgsNS42MTUsMjkuNDMxLDE2Ljg1Miw0MC42NjdDOTUuNTY2LDE1Ny4yMTcsMTA5LjEyNSwxNjIuODM0LDEyNSwxNjIuODM0eiIvPg0KPC9nPg0KPC9zdmc+DQo=" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>

            <div class="uk-width-medium-1-4 uk-push-1-4 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="250" height="250" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjUwcHgiIGhlaWdodD0iMjUwcHgiIHZpZXdCb3g9IjAgMCAyNTAgMjUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNTAgMjUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyNTAiIGhlaWdodD0iMjUwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMjI3LjgxOCwyMDcuMjQ1Yy0xLjA0NS01Ljg0Ny0yLjM2OS0xMS4yNTktMy45NjUtMTYuMjUyYy0xLjU5OC00Ljk5NC0zLjc0Mi05Ljg1OS02LjQ0MS0xNC42MDYNCgkJYy0yLjY5Ny00Ljc0LTUuNzg5LTguNzg1LTkuMjgzLTEyLjEzMWMtMy41MDEtMy4zNDMtNy43NjgtNi4wMTUtMTIuODA5LTguMDEyYy01LjA0NS0xLjk5Ni0xMC42MTEtMi45OTUtMTYuNy0yLjk5NQ0KCQljLTAuODk3LDAtMi45OTQsMS4wNzQtNi4yOTEsMy4yMTljLTMuMjk1LDIuMTUtNy4wMTcsNC41NDYtMTEuMTU4LDcuMTg4Yy00LjE0NiwyLjY0Ni05LjUzNyw1LjA0NC0xNi4xNzYsNy4xODkNCgkJYy02LjY0MiwyLjE0OC0xMy4zMDgsMy4yMjEtMTkuOTk1LDMuMjIxYy02LjY4OSwwLTEzLjM1NC0xLjA3MS0xOS45OTUtMy4yMjFjLTYuNjQzLTIuMTQ2LTEyLjAzNi00LjU0My0xNi4xNzYtNy4xODkNCgkJYy00LjE0OC0yLjY0My03Ljg2My01LjAzNy0xMS4xNTgtNy4xODhjLTMuMjk1LTIuMTQ1LTUuMzkxLTMuMjE5LTYuMjkxLTMuMjE5Yy02LjA5NSwwLTExLjY2MSwwLjk5OS0xNi43MDEsMi45OTUNCgkJYy01LjA0MSwxLjk5Ny05LjMxMyw0LjY2OS0xMi44MDMsOC4wMTJjLTMuNTAxLDMuMzQ2LTYuNTkyLDcuMzkxLTkuMjg3LDEyLjEzMWMtMi42OTYsNC43NDctNC44NDcsOS42MTItNi40NDEsMTQuNjA2DQoJCWMtMS41OTcsNC45OTMtMi45MjIsMTAuNDA1LTMuOTcxLDE2LjI1MmMtMS4wNDYsNS44MzktMS43NDgsMTEuMjgtMi4wOTYsMTYuMzIzYy0wLjM0OSw1LjA0My0wLjUyNCwxMC4yMTMtMC41MjQsMTUuNQ0KCQljMCwzLjkyNSwwLjQzMiw3LjU1LDEuMjExLDEwLjkzMmgyMDguNDY0YzAuNzgxLTMuMzgyLDEuMjEzLTcuMDA3LDEuMjEzLTEwLjkzMmMwLTUuMjg3LTAuMTc2LTEwLjQ1Ny0wLjUyNi0xNS41DQoJCUMyMjkuNTY2LDIxOC41MjUsMjI4Ljg2OSwyMTMuMDg0LDIyNy44MTgsMjA3LjI0NXoiLz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTI1LDE2Mi44MzRjMTUuODc1LDAsMjkuNDMtNS42MTcsNDAuNjY2LTE2Ljg1YzExLjIzMi0xMS4yMzUsMTYuODUtMjQuNzg5LDE2Ljg1LTQwLjY2Nw0KCQljMC0xNS44NzctNS42MTctMjkuNDI5LTE2Ljg1LTQwLjY2M0MxNTQuNDMsNTMuNDIyLDE0MC44NzUsNDcuODA0LDEyNSw0Ny44MDRzLTI5LjQzNCw1LjYxOS00MC42NjQsMTYuODUyDQoJCUM3My4xLDc1Ljg5LDY3LjQ4NCw4OS40NDEsNjcuNDg0LDEwNS4zMThjMCwxNS44NzgsNS42MTUsMjkuNDMxLDE2Ljg1Miw0MC42NjdDOTUuNTY2LDE1Ny4yMTcsMTA5LjEyNSwxNjIuODM0LDEyNSwxNjIuODM0eiIvPg0KPC9nPg0KPC9zdmc+DQo=" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-5 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="200" height="200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>

            <div class="uk-width-medium-1-5 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="200" height="200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>
            <div class="uk-width-medium-1-5 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="200" height="200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>

            <div class="uk-width-medium-1-5 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="200" height="200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>

            <div class="uk-width-medium-1-5 uk-text-center">
                <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                    <figure class="uk-overlay">
                        <img class="uk-border-circle" width="200" height="200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                            <div>
                                <a href="#" class="uk-icon-button uk-icon-envelope"></a>
                                <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <h2 class="uk-margin-bottom-remove">Name</h2>
                <p class="uk-text-large uk-margin-top-remove uk-text-muted">Job Description</p>
            </div>
        </div>

        <hr class="uk-grid-divider">

        <div class="uk-grid" data-uk-grid-margin>

            <div class="uk-width-medium-2-3">
                <div class="uk-panel uk-panel-header">

                    <h3 class="uk-panel-title">Get in touch</h3>

                    <form class="uk-form uk-form-stacked">

                        <div class="uk-form-row">
                            <label class="uk-form-label">Your Name</label>
                            <div class="uk-form-controls">
                                <input type="text" placeholder="" class="uk-width-1-1">
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <label class="uk-form-label">Your Email</label>
                            <div class="uk-form-controls">
                                <input type="text" placeholder="" class="uk-width-1-1">
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <label class="uk-form-label">Your Message</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-width-1-1" id="form-h-t" cols="100" rows="9"></textarea>
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <div class="uk-form-controls">
                                <button class="uk-button uk-button-primary">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <div class="uk-width-medium-1-3">
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                    <h3 class="uk-panel-title">Contact Details</h3>
                    <p>
                        <strong>Company Name</strong>
                        <br>Street, Country
                        <br>Postal Zip Code
                    </p>
                    <p>
                        <a>youremail@yourdomain.com</a>
                        <br><a>@YourTwitterAccount</a><br>
                        P+44 (0) 208 0000 000
                    </p>
                    <h3 class="uk-h4">Follow Us</h3>
                    <p>
                        <a href="#" class="uk-icon-button uk-icon-github"></a>
                        <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                        <a href="#" class="uk-icon-button uk-icon-dribbble"></a>
                        <a href="#" class="uk-icon-button uk-icon-html5"></a>
                    </p>
                </div>
            </div>
        </div>

    </div>



    <?php include '../snipps/foot.php';?>
    </body>
</html>
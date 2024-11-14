<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Content with Page Breaks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        .content2 { 
            page-break-before: always !important; 
            margin-left: 0 !important;
            width: 100% !important;
            border: 1px solid black; /* For visual testing */
            padding: 10px;
        }
        .content2:first-child { 
            page-break-before: auto !important; 
            margin-left: 0 !important;
            width: 100% !important;
        }
        .card-header, .card-title {
            display: block; /* Ensure these are block elements */
            width: 100%; /* Ensure full width */
        }
    </style>
</head>
<body>
    <div class="content2">
        <div class="card-header">Header Content</div>
        <div class="card-title">Title Content</div>
        <?php
        $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        for ($i = 0; $i < 25; $i++) {
            echo "<p>" . $lorem . "</p>";
        }
        ?>
        <!-- Add more content here to simulate overflow -->
    </div>
    <div class="content2">
        <div class="card-header">Another Header</div>
        <div class="card-title">Another Title</div>
        <p>More content that may overflow and need a new page...</p>
        <!-- Add more content here to simulate overflow -->
    </div>

    <script>
        window.matchMedia("print").addListener(function(changed) {
            if (changed.matches) {
                document.querySelectorAll('.content2').forEach(function(element) {
                    let observer = new ResizeObserver(entries => {
                        for (let entry of entries) {
                            if (entry.contentRect.height > window.innerHeight) {
                                let clone = entry.target.cloneNode(true);
                                let header = clone.querySelector('.card-header');
                                let title = clone.querySelector('.card-title');
                                let restContent = document.createElement('div');
                                
                                Array.from(entry.target.childNodes).forEach(child => {
                                    if (child !== header && child !== title) {
                                        restContent.appendChild(child.cloneNode(true));
                                    }
                                });

                                clone.innerHTML = '';
                                clone.appendChild(header.cloneNode(true));
                                clone.appendChild(title.cloneNode(true));
                                clone.appendChild(restContent);
                                entry.target.parentNode.insertBefore(clone, entry.target.nextSibling);
                            }
                        }
                    });
                    observer.observe(element);
                });
            }
        });
    </script>
</body>
</html>

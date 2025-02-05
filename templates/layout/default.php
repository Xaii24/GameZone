<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>:</title>

    <?= $this->Html->css([
        'normalize.min',
        'milligram.min',
        'fonts',
        'cake',
        'flash-messages',
    ]) ?>
    <?= $this->Html->css('create.css') ?> 

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Kanit:wght@100;200;300;400;500;600;700;800;900&family=Lacquer&display=swap" rel="stylesheet">

    <style>
        /* Add this CSS to hide the CakePHP logo */
        .cake-logo {
            display: none;
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background-color: #f9fcff;">
    <nav class="top-nav">
        <div class="top-nav-title"></div>
        <div class="top-nav-links">
            <?php if (
                $this->request->getAttribute('identity') &&
                (!isset($showLogoutButton) || $showLogoutButton !== false)
            ): ?>
                <?= $this->Html->link(
                    'Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'nav-link', 'style' => 'color: red;']
                ) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <!-- Flash Messages -->
            <div class="flash-messages">
                <?= $this->Flash->render() ?>
            </div>
            <!-- Main Content -->
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer></footer>

    <!-- JavaScript to hide flash messages after a set time -->
    <script>
        setTimeout(function() {
            var flashMessages = document.querySelector('.flash-messages');
            if (flashMessages) {
                flashMessages.style.display = 'none';
            }
        }, 5000); // 5000ms = 5 seconds
    </script>
</body>
</html>

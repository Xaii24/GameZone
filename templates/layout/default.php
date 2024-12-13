<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework'; ?>
<!DOCTYPE html>
<html>
<head>
<body style="background-color: #f9fcff;>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
    </title>

    <?= $this->Html->css([
        'normalize.min',
        'milligram.min',
        'fonts',
        'cake',
        'flash-messages',
    ]) ?>

 
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

   

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
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
        </div>
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
    <footer>
    </footer>
</body>
</html>

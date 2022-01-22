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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('jquery-3.5.0.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-2 medium-3 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if ($this->request->session()->read('Auth.Customers')){ ?>
                <li>
                    <?php
                        echo $this->Html->link(
                            'Reset Password',
                            ['controller' => 'Customers', 'action' => 'resetPassword',$this->request->session()->read('Auth.Customers.id')],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <li>
                    <?php
                        echo $this->Html->link(
                            'Logout',
                            ['controller' => 'Customers', 'action' => 'logout'],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <?php } else{ ?>
                    <li>
                    <?php
                        echo $this->Html->link(
                            'sign up',
                            ['controller' => 'Customers', 'action' => 'signup'],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <?php } ?>
                <!-- <?php if ($this->request->session()->read('Auth.Sellers')){ ?>
                <li>
                    <?php
                        echo $this->Html->link(
                            'Reset Password',
                            ['controller' => 'Sellers', 'action' => 'resetPassword',$this->request->session()->read('Auth.Sellers.id')],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <li>
                    <?php
                        echo $this->Html->link(
                            'Logout',
                            ['controller' => 'Sellers', 'action' => 'logout'],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <?php } else{ ?>
                    <li>
                    <?php
                        echo $this->Html->link(
                            'sign up',
                            ['controller' => 'Sellers', 'action' => 'signup'],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                <?php } ?> -->
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>

<div class="logo">
        <span class="navbar-brand-costem"> Logo </span>
    </div>
<nav class="left_side" id="main-nav">
    <?php
        echo $this->Html->link(
            'Admin',
            ['controller' => 'Admins', 'action' => 'index'],
            ['class' => 'dropdown-item']
        );
    ?>
    <?php
        echo $this->Html->link(
            'Customers',
            ['controller' => 'Customers', 'action' => 'index'],
            ['class' => 'dropdown-item']
        );
    ?>
    <?php
    //    echo $this->Html->link(
    //        'Sellers',
    //        ['controller' => 'Sellers', 'action' => 'index'],
    //        ['class' => 'dropdown-item']
    //    );
    //?>
    <?php
        echo $this->Html->link(
            'Product',
            ['controller' => 'Products', 'action' => 'index'],
            ['class' => 'dropdown-item']
        );
    ?>
    <div class="dropdown">
	  	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuCategorie" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    	Categorie 
	  	</button>
	  	<div class="dropdown-menu" aria-labelledby="dropdownMenuCategorie">
	    	<?php
		        echo $this->Html->link(
		            'Categorie',
		            ['controller' => 'Categories', 'action' => 'index'],
		            ['class' => 'dropdown-item']
		        );
		    ?>
		    <?php
		        echo $this->Html->link(
		            'Sub Categorie',
		            ['controller' => 'SubCategories', 'action' => 'index'],
		            ['class' => 'dropdown-item']
		        );
		    ?>
	  	</div>
	</div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuSetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Setting 
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuSetting">
            <?php
                echo $this->Html->link(
                    'Payment',
                    ['controller' => 'Settings', 'action' => 'payment'],
                    ['class' => 'dropdown-item']
                );
            ?>
        </div>
    </div>
    
</nav>
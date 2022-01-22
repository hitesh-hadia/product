<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm new_pos">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-4">
          <div class="dropdown">
            <button class="dropbtn"><?= $this->request->session()->read('Auth.Admins.name') ?></button>
            <div class="dropdown-content mr-2" style="right: 15px">
             <!-- <a class="" href="#"><?= __('Change Password') ?></a> -->
              <?php if ($this->request->session()->read('Auth.Admins')){ ?>
                
                <li>
                    <?php
                        echo $this->Html->link(
                            'Reset Password',
                            ['controller' => 'Admins', 'action' => 'resetPassword',$this->request->session()->read('Auth.Admins.id')],
                            ['class' => 'link']
                        );
                    ?>
                </li>

                <li>
                    <?php
                        echo $this->Html->link(
                            'Logout',
                            ['controller' => 'Admins', 'action' => 'logout'],
                            ['class' => 'link']
                        );
                    ?>
                </li>
                
                <?php } ?>
            </div>
          </div>    
        </ul>
    </div>
</nav>
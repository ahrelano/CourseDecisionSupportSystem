<fieldset>
    <legend><?= __('Profile') ?></legend>
    <table class="table table->bordered">
        <tr>
            <th bgcolor="slategray">Username</th>
            <td><?= $user->username ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Firstname</th>
            <td><?= $user->firstname ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Lastname</th>
            <td><?= $user->lastname ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Location</th>
            <td><?= $user->location->city ?>, Pampanga</td>
        </tr>
        <tr>
            <th bgcolor="slategray">Full Address</th>
            <td><?= $user->address ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Gender</th>
            <td><?= $user->gender ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Birthday</th>
            <td><?= ($user->birthday != '')  ? date("M d, Y", strtotime($user->birthday)) : '' ?></td>
        </tr>
        <tr>
            <th bgcolor="slategray">Age</th>
            <td><?php 
                $extract_birthday = explode('-',$user->birthday);
                if ($user->birthday != '') {
                    if (date('m') >= $extract_birthday[1] && date('d') >= $extract_birthday[2]) {
                        echo date('Y') - $extract_birthday[0];
                    }else{
                        echo (date('Y') - $extract_birthday[0]) - 1;
                    }
                }
            ?></td>
        </tr>
        <tr>
           <td colspan="2"><?= $this->Html->link('Change Password',['controller'=>'Users', 'action'=>'change-password'],['align'=>'center']) ?></td> 
        </tr>
        <tr>
            <td colspan="2"><?= $this->Html->link('Update Profile',['controller'=>'Users', 'action'=>'update-profile'],['align'=>'center']) ?></td> 
        </tr>
    </table>
</fieldset>
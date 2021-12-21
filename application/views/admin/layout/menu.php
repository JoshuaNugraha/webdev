<ul class="sidebar-menu">
    
    <?php
        $group = 'oto_'.$this->session->userdata('group_id');
        $cgroup = $this->session->userdata('group_id');
        $menu = $this->db->query("SELECT * FROM menu WHERE $group='1' and parent='0'");
        
            $no=1;
            foreach ($menu->result() as $row) {
                $parent = $this->db->query("SELECT * FROM menu WHERE $group='1' and parent='$row->id'");
                $count_parent = $parent->num_rows();
                if($row->url == null || $row->url == ''){
                    $link = '#';
                }else{
                    $link = $row->url;
                } 

                if($count_parent > 0){
                    echo '
                        <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="'.$row->icon.'"></i> <span>'.$row->nm_menu.'</span></a>
                        <ul class="dropdown-menu">';

                            foreach ($parent->result() as $row_parent) {
                                if($row_parent->url == null || $row_parent->url == ''){
                                    $link_parent = '#';
                                }else{
                                    $link_parent = $row_parent->url;
                                } 

                                if($row_parent->jns_url == '2'){
                                     echo '<li><a class="nav-link" href="javascript:void(0)" onclick="'.$link_parent.'();return false;" >'.$row_parent->nm_menu.'</a></li>';
                                }else{   
                                    echo '<li><a class="nav-link" href="'.base_url($link_parent).'">'.$row_parent->nm_menu.'</a></li>';
                                }        
                            }  
                        echo'</ul>
                        </li>';
                }else{
                    echo '<li><a class="nav-link" href="'.base_url($link).'"><i class="'.$row->icon.'"></i> <span>'.$row->nm_menu.'</span></a></li>';
                }
                $no++;
            } 
    ?>
     
</ul>
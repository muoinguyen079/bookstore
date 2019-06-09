<?php
    $linkCategory   = URL::createLink('admin', 'category', 'index');
    $linkBook       = URL::createLink('admin', 'book', 'index');
?>
<div id="submenu-box">
    <div class="m">
        <ul id="submenu">
            <li><a href=" <?php echo $linkCategory ?>">Category</a></li>
            <li><a href="#"  class="active">Book</a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
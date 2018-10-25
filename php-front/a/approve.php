<div class="panel panel-danger">
    <div class="panel-heading">Students</div>
    <div class="panel-body z-submenu">
        <ul class="nav nav-tabs" data-requester='trinket' data-fragment="approvet">
            <li class="active" data-approvet="test"><a data-toggle="tab">Test<span class="btn btn-xs btn-danger" id="pr0_count"></span></a></li>
            <li data-approvet="CS"><a data-toggle="tab">CSE<span class="btn btn-xs btn-danger" id="pr0_count"></span></a></li>
            <li data-approvet="IT"><a data-toggle="tab">IT<span class="btn btn-xs btn-danger" id="pr1_count"></span></a></li>
            <li data-approvet="ME"><a data-toggle="tab">ME<span class="btn btn-xs btn-danger" id="pr2_count"></span></a></li>
            <li data-approvet="CE"><a data-toggle="tab">CE<span class="btn btn-xs btn-danger" id="pr3_count"></span></a></li>
            <li data-approvet="EN"><a data-toggle="tab">EN<span class="btn btn-xs btn-danger" id="pr4_count"></span></a></li>
            <li data-approvet="EC"><a data-toggle="tab">EC<span class="btn btn-xs btn-danger" id="pr5_count"></span></a></li>
        </ul>
        <div id="trinket" class="tab-content">
            <?php
            $approvet='test';
            include 'approveT.php';
            ?>
        </div>
    </div>
</div>

  <script>
      $( '.z-submenu' ).fragmentLoader('trinket');
  </script>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- <li class="sidebar-search-wrapper">
                BEGIN RESPONSIVE QUICK SEARCH FORM
                DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box
                DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                END RESPONSIVE QUICK SEARCH FORM
            </li> -->
            <li class="nav-item <?php echo ((Request::routeIs('admin.dashboard'))? 'active': '') ?>">
                <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.team'))? 'active': '') ?>">
                <a href="{{ route('admin.team') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Team</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.member'))? 'active': '') ?>">
                <a href="{{ route('admin.member') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user-o"></i>
                    <span class="title">Member</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.task'))? 'active': '') ?>">
                <a href="{{ route('admin.task') }}" class="nav-link nav-toggle">
                    <i class="fas fa-thumbtack"></i>
                    <span class="title">Task</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.reviewpending'))? 'active': '') ?>">
                <a href="{{ route('admin.reviewpending') }}" class="nav-link nav-toggle">
                    <i class="fa fa-repeat"></i>
                    <span class="title">Pending Review</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <li class="nav-item <?php echo ((Request::routeIs('admin.review'))? 'active': '') ?>">
                <a href="{{ route('admin.review') }}" class="nav-link nav-toggle">
                    <i class="fa fa-calendar-check-o"></i>
                    <span class="title">Review</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.finish'))? 'active': '') ?>">
                <a href="{{ route('admin.finish') }}" class="nav-link nav-toggle">
                    <i class="fa fa-tasks"></i>
                    <span class="title">Finished Task</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.upload'))? 'active': '') ?>">
                <a href="{{ route('admin.upload') }}" class="nav-link nav-toggle">
                    <i class="fas fa-upload"></i>
                    <span class="title">Uploaded Task</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.issue'))? 'active': '') ?>">
                <a href="{{ route('admin.issue') }}" class="nav-link nav-toggle">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="title">Issue's Task</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            

           
           
           
            
            

          
            </li>
    
           
            
      
           
          
            
         
           

          
           
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard">Newsportal Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['name']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout">
                            	<i class="fa fa-fw fa-power-off"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#category">
                            <i class="fa fa-fw fa-list"></i>
                                Category Management
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="category" class="collapse">
                            <li>
                                <a href="category-add">Add Category</a>
                            </li>
                            <li>
                                <a href="category-list">List Category</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        
                        <a href="javascript:;" data-toggle="collapse" data-target="#news">
                            <i class="fa fa-fw fa-newspaper-o"></i>
                                News Management
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>

                        <ul id="news" class="collapse">
                            <li>
                                <a href="news-add">Add News</a>
                            </li>
                            <li>
                                <a href="news-list">List News</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users">
                            <i class="fa fa-fw fa-users"></i>
                                Users Management
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="user-add">Add User</a>
                            </li>
                            <li>
                                <a href="user-list">List Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#gallery">
                            <i class="fa fa-fw fa-image"></i>
                                Gallery Management
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="gallery" class="collapse">
                            <li>
                                <a href="gallery-add">Add Gallery</a>
                            </li>
                            <li>
                                <a href="gallery-list">List Gallery</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#video">
                            <i class="fa fa-fw fa-film"></i>
                                Video Management
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="video" class="collapse">
                            <li>
                                <a href="video-add">Add Video</a>
                            </li>
                            <li>
                                <a href="video-list">List Video</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
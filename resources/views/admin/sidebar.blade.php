        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="{{url('nimda')}}"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="nav-label">Users</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('nimda/users')}}">View Users</a></li>
                            </ul>
                        </li>
                        <li class="nav-label">Predictions</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Predictions<span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('nimda/tips')}}">View Tips</a></li>
								<li><a href="{{url('nimda/transactions')}}">View Transactions</a></li>
                            </ul>
                        </li>                        
						<li class="nav-label">Miscellaneous</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Other leagues<span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('nimda/other-leagues')}}">Manage other leagues</a></li>
                                <li><a href="{{url('nimda/leads')}}">Manage leads</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
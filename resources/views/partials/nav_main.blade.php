<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        
                        <li>
                            <a href="#"><i class="fa fa-area-chart"></i> Ad Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                     {!! link_to('ad/ad-campaign','1 - Campaign',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/ad-set','2 - AdSet',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/ad-media','3 - Media',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/ad-creative','4 - AdCreative',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/ad-publish','5 - Ad',['class'=>'']) !!}
                                </li>
                            </ul>
                        </li>
                        
                         <li>
                            <a href="#"><i class="fa fa-users"></i> Audience Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                     {!! link_to('ad/audience-pixel','Pixel',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/audience-custom','Custom Audience',['class'=>'']) !!}
                                </li>
                                <li>
                                    {!! link_to('ad/audience-lookalike','Lookalike Audience',['class'=>'']) !!}
                                </li>                          
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
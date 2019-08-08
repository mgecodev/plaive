@extends('layouts.Master')

@section('content')



<div id="overviews" class="section wb">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-3 col-12 right-single">
                    <div class="widget-search">
                        <div class="site-search-area">
                            <form method="get" id="site-searchform" action="#">
                                <div>
                                    <input class="input-text form-control" name="search-k" id="search-k" placeholder="Search keywords..." type="text">
                                    <input id="searchsubmit" value="Search" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="widget-categories">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                            <li><a href="#">Political Science</a></li>
                            <li><a href="#">Business Leaders Guide</a></li>
                            <li><a href="#">Become a Product Manage</a></li>
                            <li><a href="#">Language Education</a></li>
                            <li><a href="#">Micro Biology</a></li>
                            <li><a href="#">Social Media Management</a></li>
                        </ul>
                    </div>
                    <div class="widget-tags">
                        <h3 class="widget-title">Search Tags</h3>
                        <ul class="tags">
                            <li><a href="#"><b>business</b></a></li>
                            <li><a href="#"><b>jquery</b></a></li>
                            <li><a href="#">corporate</a></li>
                            <li><a href="#">portfolio</a></li>
                            <li><a href="#">css3</a></li>
                            <li><a href="#"><b>theme</b></a></li>
                            <li><a href="#"><b>html5</b></a></li>
                            <li><a href="#"><b>mysql</b></a></li>
                            <li><a href="#">multipurpose</a></li>
                            <li><a href="#">responsive</a></li>
                            <li><a href="#">premium</a></li>
                            <li><a href="#">javascript</a></li>
                            <li><a href="#"><b>Best jQuery</b></a></li>
                        </ul>
                    </div>          
                </div>
    
    
                <div class="col-lg-9">
                </div>
            </div>
        </div>
    </div>

@endsection
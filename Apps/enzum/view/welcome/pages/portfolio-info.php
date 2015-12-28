<div class="page-wrapper">
        <div class="slug-pattern"><div class="overlay"><div class="slug-cut"></div></div></div>
        <div class="header">
            <div class="nav">
            
                
                <div class="container">

                    <?php $this->renderView('templates/navbar') ?>
                    
                    <div class="mini">
                        <div class="twelve column alpha omega mini">
                            <div class="logo">
                                <a href="index"><img src="<?=TEMPLATE?>images/logoMINI.png" /></a><!-- Small Logo -->
                            </div>
                        </div>
                        
                        <div class="twelve column alpha omega navagation-wrapper">
                            <select class="navagation">
                                <option value="" selected="selected">Site Navagation</option>
                            </select>
                        </div>
                    </div>
                    <!-- Start of Mini Ends -->
                </div> 
                
            </div>
            
            <div class="shadow"></div>
            <div class="container">
                <div class="page-title">
                    <div class="rg"></div>
                    <h1>Portfolio</h1>
                </div>
            </div>
        </div>
        
        <div class="body">
            <div class="body-round"></div>
            <div class="body-wrapper">
                <div class="side-shadows"></div>
                <div class="content">
                    <div class="container callout standard">
                        
                        <div class="twelve columns">
                            <h4>Company’s Latest News</h4>
                            <p class="link-location">You are here: <a href="index">Home</a> / <a href="#">Some Link</a> / <a href="#">Current Page</a></p>
                        </div>
                        
                        <div class="four columns button-wrap">
                             <div class="wrapper search">
                                <form action="">
                                    <input type="text" class="search-box" name="" value="" placeholder='Search...' />
                                    <input type="image" src="<?=TEMPLATE?>images/design/search-icon.png" class="searchbox-submit" value=""/>
                                </form>
                            </div>	
                        </div>
                    </div>
                    <div class="callout-hr"></div>                        
                    <div class="container">
                        <div class="sixteen columns">
                        
                            <div class="filter">
                            
                                <h5>Filter Display:</h5>
                                <ul id="filters" class="options pagination">
                                    <li><a href="#" data-filter="*" class="active">All</a></li>
                                    <li><a href="#" data-filter="#construction">Construction</a></li>
                                    <li><a href="#" data-filter="#revelation">Revelation</a></li>
                                </ul>
                                <div class="clear"></div>
                                
                            </div>
                       
                            <!-- Isotope Begins -->
                            <div class="portfolio info">
                                <div id="isotope-container">
                                
                                    <div class="item" id="construction">
                                        <div class="img border">
                                            <img src="<?=TEMPLATE?>images/portfolio-target.jpg" class="scale-with-grid" />
                                            <a href="<?=TEMPLATE?>images/untouched/target.jpg" class="zoom prettyPhoto"></a>
                                        </div>
                                        <div class="content">
                                            <h5><a href="#">Portfolio Title Goes Here</a></h5>
                                            <p>Ut at purus sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer sem arcu, tempor vitae porttitor at, aliquet non dolor. Sed euismod felis eget justo sollicitudin eleifend. Praesent iaculis posuere eros sit amet aliquet. Pellentesque consectetur consectetur neque in consectetur. Nulla sed augue nisl, ac facilisis nibh. Nulla convallis euismod sapien, sit amet vehicula dui accumsan vel. Curabitur egestas vulputate velit, ac porta orci euismod et. Integer iaculis pulvinar ante, ac convallis velit venenatis in. 
                                                <div class="right"><a href="#" class="color button"><span>More</span></a></div>
                                            </p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                    <div class="item" id="revelation">
                                        <div class="border img">
                                            <img src="<?=TEMPLATE?>images/portfolio-businessman-colleages.jpg" class="scale-with-grid" />
                                            <a href="<?=TEMPLATE?>images/untouched/businessman-colleages.jpg" class="zoom prettyPhoto"></a>
                                        </div>
                                        <div class="content">
                                            <h5><a href="#">Portfolio Title Goes Here</a></h5>
                                            <p>In id odio justo, eu aliquet odio. Nunc viverra ligula eu eros egestas vulputate. Phasellus convallis risus et ipsum molestie aliquam. Donec porta bibendum risus eget aliquam. Aliquam eu urna non ipsum vulputate convallis. Fusce tempus augue quis sem commodo tempor. Etiam scelerisque dapibus lorem, a sodales nisi sodales et. Maecenas ornare consequat mattis.
                                                <div class="right"><a href="#" class="color button"><span>More</span></a></div>
                                            </p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>                                
                                </div>                            
                            </div>                        
                            <!-- Isotope Ends -->  	
                        </div>
                        <div class="clear"></div><div class="sixteen columns">
                       		<span class="hr lip-quote"></span>
                            <blockquote class="standard bottom">
                                "Making the simple complicated is commonplace; making the complicated simple, awesomely simple, that's creativity" <br />- Charles Mingus
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
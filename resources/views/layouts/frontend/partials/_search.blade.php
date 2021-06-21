<!-- Search Section start -->
<div class="banner-search-section">
    <div class="container">
        <form id="desktopSearchForm" action="" method="GET">
            <div class="row banner-search-section-area">
                <div class="col-lg-2 col-md-2 showStateFg">
                    <div class="form-group">
                        <button type="button" data-toggle="modal" data-target="#showStatesModal" id="searchStateBtn" class="btn btn-success searchLocationBtn"><i class="fa fa-map-marker"></i> All States</button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="keyword" id="jxservice" class="form-control searchInput" placeholder="What are you looking for? (e.g Barber, Plumber...)">
                        <div id="service_list" class="ajaxSearchList"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 showCatFg">
                    <div class="form-group">
                        <button type="button" data-toggle="modal" data-target="#showCategoriesModal" id="searchCategoryBtn" class="btn btn-success searchCategoryBtn"><i class="fa fa-archive"></i> All Categories</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="navbar-top-post-btn" style="margin-left: 5px">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="category" id="searchCategoryInput" value="">
            <input type="hidden" name="subcategory" id="searchSubCategoryInput" value="">
            <input type="hidden" name="state" id="searchStateInput" value="">
            <input type="hidden" name="city" id="searchLGAInput" value="">
        </form>
    </div>
</div>

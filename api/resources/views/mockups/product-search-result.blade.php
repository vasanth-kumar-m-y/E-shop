@extends('mockups.layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li> <a href="#"> Home </a> </li>
            <li class="active"> Search </li>
        </ol>
	    <div class="section-title">

   			<!-- dropdown -->

			<div class="sort dropdown">
		        <button class="btn btn-default btn-lg dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		            <span class="glyphicon glyphicon-sort" aria-hidden="true">
		            </span>
		        </button>
		        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
		            <li>
		                <a href="#">
		                    Relevance
		                </a>
		            </li>
		            <li role="separator" class="divider">
		            </li>
		            <li>
		                <a href="#">

		                    Lowest price
		                </a>
		            </li>
		            <li>
		                <a href="#">

		                   Highest price
		                </a>
		            </li>
		            <li role="separator" class="divider">
		            </li>
		            <li>
		                <a href="#">
		                    Newest
		                </a>
		            </li>
		            <li>
		                <a href="#">
		                    Oldest
		                </a>
		            </li>
		        </ul>
		    </div>
			
			<!-- end dropdown -->

	        <h1>Search Results</h1>

	    </div>
    </div>
</div>

<div  id="product-search-result" class="products-list">

    <div class="row">
    	<div class="col-sm-12 col-lg-8 col-md-9 col-md-push-2">

    		<div id="results">

    			<!-- product -->

		        <div  class="product panel panel-default">
		            <div class="panel-body">

			        	<div class="col-sm-9 col-sm-push-3">
				        	<div class="title"><a href="#">Title</a></div>
				        	<div class='subtitle'>SubTitle</div>
				        	<div class="price">$199.7</div>
			                <div class="more-info">
					           	<div class='seller hidden-xs'><strong>Started: </strong><span class="value">19/01/2016</span></div>
					           	<div class='date-start hidden-xs'><strong>End: </strong><span class="value">19/01/2016</span></div>
					           	<div class='seller '><strong>Seller: </strong><span class="value"><a href="#kkdkd">sellertop</a></span></div>
				           	</div>
			        	</div>
						<div class="col-sm-3 col-sm-pull-9 hidden-xs photoCont">
							<a href='#'>
			        			<img src="https://farm6.static.flickr.com/5697/23965829792_1a501bc8b4_s.jpg" class="img-responsive photo" alt="Responsive image">
			        		</a>
			        	</div>
			        	<div class="actions">
			        		<button type="button" class="btn btn-favourite">
		                    	<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"> </span>
		                	</button>
			        	</div>
		            </div>
		        </div>

		        <!-- end product -->

		    </div>

		    <!-- end results -->

			<nav>
			  <ul class="pagination pagination-lg">
			    <li>
			      <a href="#" aria-label="Previous">
			        <span aria-hidden="true">&laquo;</span>
			      </a>
			    </li>
			    <li class="active"><a href="#">1</a></li>
			    <li><a href="#">2</a></li>
			    <li><a href="#">3</a></li>
			    <li><a href="#">4</a></li>
			    <li><a href="#">5</a></li>
			    <li>
			      <a href="#" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>

    	</div>
    </div>
</div>
@endsection